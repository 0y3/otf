<?php

namespace App\Controllers\Web\Superadmin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    function __construct()
    {
        $this->request          = service('request');
        $this->deliveryLocate   = model('DeliveryLocationsModel');
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
        return view('superadmin/dashboard',$this->data);
    }
}
