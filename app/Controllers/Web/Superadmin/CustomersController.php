<?php

namespace App\Controllers\Web\Superadmin;

use App\Controllers\BaseController;

class CustomersController extends BaseController
{
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
        
    }

    public function index()
    {
        $users = $this->user
                ->select('users.*,count(orders.id) as user_orders',)
                ->join('orders', 'users.id = orders.user_id', 'left')
                ->where(['users.isdeleted' => 0 ,'orders.status' => 1 ,'orders.isdeleted' => 0])
                ->orderBy('users.created_at','DESC')->findAll();

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
                'user'          => $user
                // 'menuByCategory'  => $biz->NestedCategories(),
            ];

            //return view('layout', $data);
            // print("<pre>".print_r($user->all_orders,true)."</pre>");die;
            return view('superadmin/customers_overview', $this->data);
        }
        else{ return redirect()->back(); }
    }

    public function order(){
        $this->data = [
            'title' => "OTF Vendors:- Order",
            'currentMenu'   => 'order'
        ];
        $order = $this->order
                      ->where(self::filter)
                      ->where('user_id',$_SESSION['userId'])
                      ->orderBy('id')
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
                      ->where(['user_id' => $_SESSION['userId'],'reference' => $ref])
                      ->first();
        if($order)
        {
            $this->data['order'] = $order;
            return view('user/orderdetails', $this->data);
        }
        else{return redirect()->back();}
    }
}
