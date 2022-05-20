<?php

namespace App\Controllers\Web;
use App\Controllers\BaseController;

class Home extends BaseController
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
        $this->deliveryLocate     = model('DeliveryLocationsModel');
        $this->encrypter        = service('encrypter');
        // $this->biz              = model('BizModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        // $this->bizMenus         = model('BizMenuModel');
        // $this->bizMenusAddupCate     = model('BizMenuAddupCategoryModel');

        
        
    }
    public function index()
    {
        $this->data = [
            'title' => "OTF :- Home",
            'currentMenu'   => 'home',
            'encrypter'     => $this->encrypter,
            'deliveryloc'   => $this->deliveryLocate->getDeliveryLocate(),
        ];
        //print("<pre>".print_r($deliveryloc,true)."</pre>");die;
        return view('main/index',$this->data);
    }
}
