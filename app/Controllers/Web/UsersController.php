<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class UsersController extends BaseController
{
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
        $this->orderDetails     = model('OrderDetailModel');
        $this->stateModel       = model('StateModel');
        $this->cityModel        = model('StateCityModel');
        
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
