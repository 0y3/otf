<?php

namespace App\Controllers\Web\Superadmin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class AuthenticationController extends BaseController
{
    use ResponseTrait;

    protected $request;
    
    function __construct()
    {
        $this->request          = service('request');
        $this->session          = service('session'); # or \Config\Services::session();
        $this->encrypter        = service('encrypter');
        $this->biz              = model('BizModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->cityModel        = model('StateCityModel');
        $this->deliveryLocate   = model('DeliveryLocationsModel');
        
    }
    public function index()
    {
        
    }
    public function checkbizname()
    {
        $data = ['valid' => true];
        $name = $this->request->getVar('name');
        $biz = $this->biz->where(['name' => $name,'isdeleted' => 0])->first();
        if($biz){$data = ['valid' => false];}
        return $this->respond($data); 
    }
}
