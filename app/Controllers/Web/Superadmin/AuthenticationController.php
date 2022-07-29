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
        $this->validation       = service('validation'); // or\Config\Services::validation();
        $this->session          = service('session'); # or \Config\Services::session();
        $this->encrypter        = service('encrypter');
        $this->biz              = model('BizModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->cityModel        = model('StateCityModel');
        $this->deliveryLocate   = model('DeliveryLocationsModel');
        $this->admins           = model('AdminModel');
        $this->roles            = model('RoleModel');
        
    }
    public function login()
    {
        //print("<pre>".print_r($_SESSION ,true)."</pre>");die;
        if($this->session->get('isLoggedInAdmin')){
            if(previous_url() == site_url('otfadmin')){ 
                return redirect()->to(site_url('otfadmin/dashboard'));}
            else{
                return redirect()->to(previous_url());}
        }
        $this->data = [
            'title' => "OTF SuperAdmin:- login",
            'currentMenu'   => 'login'
        ];

        //return view('layout', $data);
        //print("<pre>".print_r($data,true)."</pre>");die;
        return view('superadmin/login', $this->data);
    }

    public function login_()
    {
        $this->validation->setRules([
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email|min_length[6]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                    ],
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[6]', //trim|required|min_length[6]|max_length[20]|regex_match[/^((?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})$/]',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?',
                    ],
                ]
            ]
        );

        if (!$this->validation->withRequest($this->request)->run()) {
            $this->data = [
                'title' => "OTF SuperAdmin:- login",
                'currentMenu'   => 'login',
                'validation'    => $this->validation, //getErrorMessage()
            ];
            
            return view('superadmin/login', $this->data);
        } 
        else{
            $email  = $this->request->getVar('email',FILTER_SANITIZE_EMAIL);
            $password = $this->request->getVar('password');
            
            $user = $this->admins->where('email', $email)->first();
            if($user){
                $pwd_verify = verifyHashedPassword($password, $user['password']);
                if($pwd_verify){
                    $sessionArray = [
                            'userId'        => $user['id'],
                            'userSurname'   => $user['surname'],
                            'userFirstname' => $user['firstname'],
                            'userEmail'     => $user['email'],
                            'userPhone'     => $user['phone'],
                            'isLoggedInAdmin'    => TRUE,
                    ];

                    $this->session->set($sessionArray);
                    return (getBackUrl()) ? getBackUrl() : redirect()->to('otfadmin/dashboard');
                }
                else{
                    $this->session->setFlashdata('error', 'error');
                    $this->session->setFlashdata('message', 'Password is incorrect. ');
                }
            }
            else{
                $this->session->setFlashdata('error', 'error');
                $this->session->setFlashdata('message', 'Email does not exist. ');
            }
            return redirect()->to('otfadmin');
        }
    }
    public function checkbizname()
    {
        $data = ['valid' => true];
        $name = $this->request->getVar('name');
        $biz = $this->biz->where(['name' => $name,'isdeleted' => 0])->first();
        if($biz){$data = ['valid' => false];}
        return $this->respond($data); 
    }

    public function logout()
    {   
        $log_session = ['userId', 'userSurname','userFirstname','userEmail','userPhone','isLoggedInAdmin'];
        $this->session->remove($log_session);
        return redirect()->to(site_url('otfadmin/login'));
    }
}
