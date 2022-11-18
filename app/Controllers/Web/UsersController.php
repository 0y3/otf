<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class UsersController extends BaseController
{
    use ResponseTrait;
    const filter = [
        'status'        => 1,
        'isdeleted'     =>0
    ];
    
    protected $request;
    
    function __construct()
    {
        $this->request          = service('request');
        $this->session          = service('session'); # or \Config\Services::session();
        $this->encrypter        = service('encrypter');
        $this->user             = model('UserModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->biz              = model('BizModel');
        $this->order            = model('OrderModel');
        $this->orderDetail      = model('OrderDetailModel');
        $this->stateModel       = model('StateModel');
        $this->cityModel        = model('StateCityModel');
        $this->userAddress      = model('UserAddressModel');
        $this->deliveryLocate   = model('DeliveryLocationsModel');
        $this->cart             = cart();
        
    }

    public function index()
    {
        print("<pre>".print_r('data',true)."</pre>");die;
    }
    public function order(){
        $this->data = [
            'title' => "OTF Vendors:- Order",
            'currentMenu'   => 'order'
        ];
        $order = $this->order
                      ->where(self::filter)
                      ->where('user_id',$_SESSION['userId'])
                      ->orderBy('created_at DESC','id')
                      ->paginate(24);

        $this->data['order'] = $order;

       
        // $this->order->pager->setPath('api/bizs'); //customiz pagination url

        // print("<pre>".print_r($this->data,true)."</pre>");die;
        return view('user/orders', $this->data);
    }

    public function orderDetails($ref)
    {
        $this->data = [
            'title' => "OTF Vendors:- Order",
            'currentMenu'   => 'order'
        ];
        $order = $this->order
                      ->where(self::filter)
                      ->where(['user_id' => $_SESSION['userId'],'pi_reference' => $ref])
                      ->first();
        if($order)
        {
            $this->data['order'] = $order;
            return view('user/orderdetails', $this->data);
        }
        else{return redirect()->back();}
    }

    public function address_()
    {    

        $bizloc = $this->request->getVar('delivery');
        $deliveryloc = $this->deliveryLocate->where('id',$bizloc)->first();

        $data = [
            'user_id'   => $_SESSION['userId'],
            'address'   => $this->request->getVar('address'),
            'phone'     => $this->request->getVar('phone'),
            'city_id'   => (int)$deliveryloc['city_id'],
            'state_id'  => (int)$deliveryloc['state_id'],
        ];
        
        $data_ = $this->userAddress->insert($data);
        
        // return print("<pre>".print_r($data_,true)."</pre>");die;
        return $this->respond($data_); //json
        // Redirect to the cart page
    }

    public function makePayment()
    {
        if(empty($this->cart->contents()) ){ return redirect()->back();}
        
        $this->session->push('cart_adds', ['user_address_id'=> $this->request->getVar('address_id'),]);

        $GrandTotal = (float)$_SESSION['cart_adds']['delivery_fee'] + (float)$this->cart->total();
        // print("<pre>".print_r($_SESSION,true)."</pre>");die;
        $data = 
        [
            'tx_ref'        => uniqueRef(),
            'amount'        => $GrandTotal,
            'currency'      => 'NGN',
            'redirect_url'  => site_url('user/verifypayment'), //site_url($biz->biz_type.'/'.$biz->slug.'/checkout'),
            'payment_options' => 'card, ussd, account',
            'customer'      => [
                    'email'         => $_SESSION['userEmail'],
                    'phonenumber'   => asteriskMiddle($_SESSION['userPhone']),//'080****4528',
                    'name'          => $_SESSION['userSurname'].' '.$_SESSION['userFirstname'],
            ],
            'customizations' => [
                    'title'         => 'OTF User Order Payments',
                    'description'   => 'You are about to for a product you order',
                    'logo'          => base_url('img/logo.png'),
            ],
        ];

        $response = callAPI($data,'payments');

        if($response->status === 'success')
        { $this->response->redirect($response->data->link); }
        else
        {
            // print("<pre>".print_r($response,true)."</pre>");
            $this->session->setFlashdata('error', 'error');
            $this->session->setFlashdata('message', $response);
            return redirect()->back();
        }
        // print("<pre>".print_r($response,true)."</pre>");die;
    }

    public function verifyPayment()
    {
        $bizId = null;
        foreach ($this->cart->contents() as $key => $val) {
            $bizId = $val['vendor_id'];break;
            
        }
        $biz = $this->biz->where('id', $bizId)->first();

        $reference = isset($_GET['tx_ref']) ? $_GET['tx_ref'] : '';
        
        if(!$reference){
            // die('No reference supplied');
            $this->session->setFlashdata('error', 'error');
            $this->session->setFlashdata('message', 'Transaction Not Successfull');
            return redirect()->to($biz->biz_type.'/'.$biz->slug.'/checkout');
        }
        
        if($_GET['status'] === 'successful')
        {
            if(empty($this->cart->contents()) ){ return redirect()->to('user/order');}
            $GrandTotal = (float)$_SESSION['cart_adds']['delivery_fee'] + (float)$this->cart->total();

            $url = 'transactions/'.$this->request->getVar('transaction_id').'/verify';
            $response = callAPI('',$url,'GET');

            //check order db if it exist
            $checkOrder = $this->order->where('pi_id', $_GET['transaction_id'])->first();
            
            // print("<pre>".print_r($GrandTotal,true)."</pre>");die;
            if($checkOrder)
            {
                $this->session->setFlashdata('info', 'info');
                $this->session->setFlashdata('message', 'Transaction Order Exist: '.$_GET['transaction_id']);
                return redirect()->to('user/order');
            }
            if($response->status === 'success' && $response->data->amount == $GrandTotal)
            {
                $ps_data = [
                    "user_id"       =>  $_SESSION['userId'],
                    "pi_id"         =>  $response->data->id,
                    "pi_reference"  =>  $response->data->tx_ref,
                    "pi_paid_at"    =>  $response->data->created_at,
                    "pi_channel"    =>  $response->data->payment_type,
                    "pi_authorization_code" =>  $response->data->flw_ref,
                    "biz_id"        =>  $bizId,
                    "user_address_id"   =>  $_SESSION['cart_adds']['user_address_id'],
                    "total_order"   =>  $this->cart->total(),
                    "delivery_fee"  =>  $_SESSION['cart_adds']['delivery_fee'],
                    "grand_total"   =>  $response->data->amount,
                    "order_status"  =>  "Pending",
                    "status"        =>  1,
                ];
                if($response->data->payment_type === "card")
                {
                    $ps_data["pi_last4"]      =  $response->data->card->last_4digits;
                    $ps_data["pi_card_type"]  =  $response->data->card->type;
                    $ps_data["payment_type"]  =  "card";
                }
                // print("<pre>".print_r($ps_data,true)."</pre>");die;
                $newOrderId = $this->order->insert($ps_data);

                /* save to order detail */
                $order_data=[];
                foreach ($this->cart->contents() as $val) {
                    $o_menu = [
                        'order_code'    => 'ORD-'.generate_random_string(10),
                        'order_id'      => $newOrderId,
                        'biz_id'        => $val['vendor_id'], 
                        'biz_menu_id'   => $val['menu_id'],
                        'name'          => $val['name'],
                        'price'         => $val['price'],
                        'quantity'      => $val['qty'],
                        'grant_total'   => $val['total'],
                    ]; 
                    if(!empty($val['addups'])){$o_menu['addup_menu'] = json_encode($val['addups']);}
                    $this->orderDetail->insert($o_menu);
                    $order_data[] = $o_menu;
                }
                // print("<pre>".print_r($order_data,true)."</pre>");die;
                // $newOrderId = $this->orderDetail->insertBatch($order_data);

                /* send to order emails */
            

                $this->cart->destroy(); $this->session->remove('cart_adds');

                $this->session->setFlashdata('success', 'success');
                $this->session->setFlashdata('message', 'Transaction Order Successful: '.$_GET['transaction_id']);
                return redirect()->to('user/order');
            }
            else{
                $this->session->setFlashdata('error', 'error');
                $this->session->setFlashdata('message', 'No Transaction Found with this Transaction ID: '.$_GET['transaction_id']);
                return redirect()->to($biz->biz_type.'/'.$biz->slug.'/checkout');
            }
            
        }
        else{
            $this->session->setFlashdata('error', 'error');
            $this->session->setFlashdata('message', 'Transaction Not Successfull - '.$_GET['status']);
            return redirect()->to($biz->biz_type.'/'.$biz->slug.'/checkout');
        };
    }
}