<?php

namespace App\Controllers\Web\Superadmin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class CustomersController extends BaseController
{
    use ResponseTrait;
    
    const filter = [
        'isdeleted'     =>0
    ];
    
    protected $request;
    
    function __construct()
    {
        $this->request          = service('request');
        $this->encrypter        = service('encrypter');
        $this->user             = model('UserModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->biz              = model('BizModel');
        $this->order            = model('OrderModel');
        $this->orderDetails     = model('OrderDetailModel');
        $this->stateModel       = model('StateModel');
        $this->cityModel        = model('StateCityModel');
        $this->userAddress      = model('UserAddressModel');
        $this->deliveryLocate   = model('DeliveryLocationsModel');
        
    }

    public function index()
    {
        $users = $this->user->UserAndOrder_();

        $breadcrumb =   ' <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                <li class="breadcrumb-item text-dark">Customers</li>';

        $this->data = [
            'encrypter'     => $this->encrypter,
            'title'         => "OTF Superadmin:- Customers",
            'parentMenu'    => "customers",
            'currentMenu'   => 'customer',
            'breadcrumb'    => $breadcrumb,
            'user'         => $users,
        ];

        //return view('layout', $data);
        // print("<pre>".print_r(json_encode($users,JSON_PRETTY_PRINT),true)."</pre>");die;
        return view('superadmin/customers', $this->data);
    }

    public function overview($id = null)
    {
        $user = $this->user->where(self::filter)->where('id',$id)->first();
                //->paginate(50);
        if($user){

            $breadcrumb =   '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.site_url('otfadmin/customer').'" class="text-muted text-hover-primary">Customers</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-dark">'.$user->surname.' '.$user->firstname.'</li>';

            $this->data = [
                'encrypter'     => $this->encrypter,
                'title'         => "OTF Superadmin:- Customers: ".$user->surname.' '.$user->firstname,
                'parentMenu'    => "customers",
                'currentMenu'   => 'overview',
                'breadcrumb'    => $breadcrumb,
                'user'          => $user,
                'deliveryloc'   => $this->deliveryLocate->getDeliveryLocate(),
                // 'menuByCategory'  => $biz->NestedCategories(),
            ];

            //return view('layout', $data);
            // print("<pre>".print_r($user->all_orders,true)."</pre>");die;
            return view('superadmin/customers_overview', $this->data);
        }
        else{ return redirect()->back(); }
    }

    public function address_($id=null)
    {    
        // print("<pre>".print_r($this->request->getPostGet(),true)."</pre>");die;

        $bizloc = $this->request->getVar('delivery');
        $deliveryloc = $this->deliveryLocate->where('id',$bizloc)->first();

        $data = [
            'user_id'   => $id,
            'address'   => $this->request->getVar('address'),
            'phone'     => $this->request->getVar('phone'),
            'city_id'   => (int)$deliveryloc['city_id'],
            'state_id'  => (int)$deliveryloc['state_id'],
        ];
        $data_ = $this->userAddress->insert($data);
        
        //  return print("<pre>".print_r($data,true)."</pre>");die;
         return $this->respond($data_); //json
        // Redirect to the cart page
    }

    public function addressEdit($id=null)
    {    
        // $postData = $this->request->getPost();
        // $postData['address'];

        // $id_ = base64_decode($this->encrypter->decrypt($id));
        $id_ = base64_decode($id);
        $bizloc = $this->request->getVar('delivery');
        $deliveryloc = $this->deliveryLocate->where('id',$bizloc)->first();

        $data = [
            'address'   => $this->request->getVar('address'),
            'phone'     => $this->request->getVar('phone'),
            'city_id'   => (int)$deliveryloc['city_id'],
            'state_id'  => (int)$deliveryloc['state_id'],
        ];

        $data_ = $this->userAddress->update($id_,$data);
        
        // print("<pre>".print_r($data,true)."</pre>");die;
        return $this->respond($data_); //json
        // Redirect to the cart page
    }

    public function addressDelete($id=null)
    {    
        $data = $this->userAddress->delete($id);
        
        //  return print("<pre>".print_r($data,true)."</pre>");die;
         return $this->respond($data); //json
        // Redirect to the cart page
    }
}
