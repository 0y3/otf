<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class AuthenticationController extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        //$this->session = service('session'); // or \Config\Services::session();
        $this->validation   = service('validation'); // or\Config\Services::validation();
        $this->session      = service('session'); # or \Config\Services::session();
        $this->encrypter    = service('encrypter');
        $this->users        = model('UserModel');
        $this->stateModel   = model('StateModel');
        $this->cityModel    = model('StateCityModel');
    }
    public function signup()
    {
        if($this->session->get('isLoggedIn')){
            return redirect()->to(previous_url());
        }
        $this->data = [
            'title' => "OTF Vendors:- Signup",
            'currentMenu'   => 'login'
        ];

        //return view('layout', $data);
        //print("<pre>".print_r($data,true)."</pre>");die;
        return view('main/signup_user', $this->data);
    }
    public function signup_()
    {
        $this->validation->setRules([
            'surname' => [
                'label'  => 'Surname',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided',
                ],
            ],
            'firstname' => [
                'label'  => 'Firstname',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'All accounts must have {field} provided',
                ],
            ],
            'phone' => [
                'label'  => 'Phone',
                'rules'  => 'required|numeric|min_length[7]|max_length[14]',
                'errors' => [
                    'required' => 'All accounts must have {field} Number ',
                    'numeric'  => '{field} Number must be Numeric',
                    'min_length' => 'Number is too short for a phone number',
                    'max_length' => 'Number is too long for a phone number',
                ],
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email|is_unique[users.email]|min_length[6]',
                'errors' => [
                    'required' => 'All accounts must have {field} provided',
                    'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                    'is_unique' => 'Email already taken',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[6]', //trim|required|min_length[6]|max_length[20]|regex_match[/^((?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})$/]',
                'errors' => [
                    'required' => '{field} is Required',
                    'min_length' => '{field} is too short, must have at least {param} characters. You want to get hacked?',
                ],
            ],
            'passconf' => [
                'label'  => 'ConfirmPassword',
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} is Requied',
                    'matches' => 'Your {field} must match with Password Input',
                ],
            ]
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            $this->data = [
                'title' => "OTF Vendors:- Signup",
                'currentMenu'   => 'Signup',
                'validation'    => $this->validation, //getErrorMessage()
            ];
            
            //print("<pre>".print_r($this->session,true)."</pre>");die;
            return view('main/signup_user', $this->data);
		} 
        else {
            
            $getSurname     = $this->request->getVar('surname',FILTER_SANITIZE_STRING);
            $getFirstname   = $this->request->getVar('firstname',FILTER_SANITIZE_STRING);
            $getPhone       = $this->request->getVar('phone',FILTER_SANITIZE_NUMBER_INT);
            $getEmail       = $this->request->getVar('email',FILTER_SANITIZE_EMAIL);
            $getPassword    = getHashedPassword($this->request->getVar('password'));
            $activation_code = randomToken(128);
            $data = [
                'surname'   => $getSurname,
                'firstname' => $getFirstname,
                'phone'     => $getPhone,
                'email'     => $getEmail,
                'password'  => $getPassword,
                'activation_code' => $activation_code
            ];
            
            // print("<pre>".print_r($data,true)."</pre>");die;
            // save data to users table
            $user = $this->users->save($data);
            if($user){
                
                $encoded_email = urlencode($this->request->getVar('email',FILTER_SANITIZE_EMAIL));

                $dataemail['reset_link'] = site_url() . "authentication/activationemail/".$activation_code."/".$encoded_email;
                $dataemail["name"] = $getSurname." ".$getFirstname;
                $dataemail["email"] = $getEmail;
                $dataemail["message"] = "Reset Your Password";
                
                $sendStatus = resetPasswordEmail($dataemail);
                if($sendStatus){
                    $status = "send";
                    // setFlashData($status, "Activaion link sent successfully, please check mails.");
                    $this->session->setFlashdata('success', 'success');
                    $this->session->setFlashdata('message', '<h4><b>Activation link sent successfully, <small>please check mails.</small></b></h4>');
                } else {
                    $status = $sendStatus;//"notsend";
                    // setFlashData($status, "Email has been failed, try again.");
                    $this->session->setFlashdata('warning', 'warning');
                    $this->session->setFlashdata('message', '<h4>Sending Email failed Error!!!</h4> New User Added, But Confirmation Email failed to sent to the provided Email, <a href="'.$dataemail['reset_link'].'" class="alert-link">Click here Activate Link... </a>');
                }
                //print("<pre>".print_r($data,true)."</pre>");die;
                  
            }
            else{
                $this->session->setFlashdata('error', 'error');
                $this->session->setFlashdata('message', '<h1>Error!!!</h1> Unable to add User');
            }
            return redirect()->to('signup');
        }
    }

    public function login()
    {
        
        if($this->session->get('isLoggedIn')){
            if(previous_url() == site_url('login')){ 
                return redirect()->to('user/order');}
            else{
            return redirect()->to(previous_url());}
        }
        $this->data = [
            'title' => "OTF Vendors:- login",
            'currentMenu'   => 'login'
        ];

        //return view('layout', $data);
        //print("<pre>".print_r($data,true)."</pre>");die;
        return view('main/login_user', $this->data);
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
                'title' => "OTF Vendors:- login",
                'currentMenu'   => 'login',
                'validation'    => $this->validation, //getErrorMessage()
            ];
            
            return view('main/login_user', $this->data);
        } 
        else{
            $email  = $this->request->getVar('email',FILTER_SANITIZE_EMAIL);
            $password = $this->request->getVar('password');
            
            $user = $this->users->where('email', $email)->first();
    
            if($user){
                $pwd_verify = verifyHashedPassword($password, $user['password']);
                if($pwd_verify){
                    $sessionArray = [
                            'userId'        => $user['id'],
                            'userSurname'   => $user['surname'],
                            'userFirstname' => $user['firstname'],
                            'userEmail'     => $user['email'],
                            'userPhone'     => $user['phone'],
                            'isLoggedIn'    => TRUE,
                            'isAdmin'       => FALSE
                    ];

                    $this->session->set($sessionArray);
                    return (getBackUrl()) ? getBackUrl() : redirect()->to('user/order');
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
            return redirect()->to('login');
        }
    }
    // This function used to reset the password 
    public function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $data_check = array(  
                                 'email'  =>  $email,
                                 'activation_code' =>  $activation_id
                                 );
        $check_data =  $this->users->where($data_check)->first();;
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        //print("<pre>".print_r($check_data,true)."</pre>");die;
        if ($check_data)
        {
            $this->load->view('admin/newPassword', $data);
        }
        else
        {
            redirect('admin/authentication/login');
        }
    }

    // This function used to activate the password 
    function activateConfirmUser($activation_id, $get_email)
    {
        $this->data = [
            'title' => "OTF Vendors:- Activate Email",
            'currentMenu'   => 'Signin',
        ];

        // Get email and activation code from URL values at index 3-4
         $email = urldecode($get_email);
        
        // print("<pre>".print_r(urlencode('admin@otf.com.ng'),true)."</pre>");die;

        // Check activation id in database
        $data_check = array(  
                                 'email'  =>  $email,
                                 'activation_code' =>  $activation_id
                                 );
        $check_data =  $this->users->where($data_check)->first();
        
        if ($check_data)
        {
            $update_data = [  
                'status'  =>  1,
                'activation_code' => ''
            ];
            $activate_data = $this->users->update($check_data['id'],$update_data); 

            $this->session->setFlashdata('success', 'success');
            $this->session->setFlashdata('message', '<h4>User Activated</h4> Login in');
        }
        else{
            $this->session->setFlashdata('error', 'error');
            $this->session->setFlashdata('message', '<h4>User Activation Error!!</h4>');
        }
        return redirect()->to('login');
    }

    public function logout()
    {   
        $log_session = ['userId', 'userSurname','userFirstname','userEmail','userPhone','isLoggedIn','isAdmin','back_url'];
        $this->session->remove($log_session);
        return redirect()->to('login');
    }
}
