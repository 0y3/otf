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
        $this->request      = service('request');
        $this->session      = service('session'); # or \Config\Services::session();
        $this->encrypter      = service('encrypter');
        $this->biz         = model('BizModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->bizMenus     = model('BizMenuModel');
        $this->bizMenusAddupCate     = model('BizMenuAddupCategoryModel');

        
        
    }
    public function index()
    {$data = [
        'title' => "OTF :- Home",
        'currentMenu'   => 'home',
    ];
        return view('main/index',$data);
    }
}
