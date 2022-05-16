<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use \App\Libraries\Oauth2;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use \OAuth2\Request;

class AuthenticationController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    function __construct()
    {
        helper(['form', 'url']);
        //$this->session = service('session'); // or \Config\Services::session();
        $this->validation =  service('validation'); // or\Config\Services::validation();
        $this->users = model('UserModel'); 
    }
    public function signup()
    {
        // $rules = [
		// 	"email" => "required|valid_email|is_unique[users.email]|min_length[6]",
		// 	"pwd" => "required|min_length[6]",
		// ];

		// $messages = [
		// 	"name" => [
		// 		"required" => "Name is required"
		// 	],
		// 	"email" => [
		// 		"required" => "Email required",
		// 		"valid_email" => "Email address is not in format",
		// 		"is_unique" => "Email address already exists"
		// 	],
		// 	"phone_no" => [
		// 		"required" => "Phone Number is required"
		// 	],
		// ];
        // if (!$this->validate($rules, $messages)) {
        if($this->request->getMethod() != 'post'){
            $response = [
				'status'    => 500,
				'error'     => true,
                'code'      => 'Request_Error', 
                'message'   => 'Only post request is allowed',
				'data'      => [
                ]
			];
        }

        $this->validation->setRules([
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email|is_unique[users.email,id,{id}]|min_length[6]',
                'errors' => [
                    'required' => 'All accounts must have {field} provided',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required|min_length[6]', //trim|required|min_length[6]|max_length[20]|regex_match[/^((?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})$/]',
                'errors' => [
                    'min_length' => 'Your {field} is too short. You want to get hacked?',
                ],
            ],
            'passconf' => [
                'label'  => 'Password Confirm',
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'min_length' => 'Your {field} must match with Password Input',
                ],
            ]
        ]);

        if (!$this->validation->run()) {

			$response = [
				'status'    => 500,
				'error'     => true,
                'code'      => 'Form_Validation_Error', 
                'message'   => 'Some Fields are required',
				'data'      => [
                    $this->validation->getErrors() //getErrorMessage()
                ]
			];
		} 
        else {
            
            $data = [
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            //save data to users table
            $user = $this->users->insert($data);
            $response = [
                'status'    => 200,
                'error'     => false,
                'code'      => 'Successfully_Signup_User',
                'message'   => 'User added successfully',
				'data'      => []
            ];
        }
        return $this->respondCreated($response);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function login()
    {
        if($this->request->getMethod() != 'post'){
            $response = [
				'status'    => 500,
				'error'     => true,
                'code'      => 'Request_Error', 
                'message'   => 'Only post request is allowed',
				'data'      => [
                ]
			];
        }

        $this->validation->setRules([
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email|is_unique[users.email,id,{id}]|min_length[6]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
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

        if (!$this->validation->run()) {

            $response = [
                'status'    => 500,
                'error'     => true,
                'code'      => 'Form_Validation_Error', 
                'message'   => 'Some Fields are required',
                'data'      => [
                    $this->validation->getErrors() //getErrorMessage()
                ]
            ];
        } 
        
        $email  = $this->request->getVar('email');
        $password = $this->request->getVar('password');
          
        $user = $this->users->where('email', $email)->first();
  
        if($user){
            $pwd_verify = password_verify($password, $user['password']);
            if($pwd_verify){

                $privateKey   = file_get_contents(ROOTPATH  . '/privkey.pem');
                $publicKey    = file_get_contents(ROOTPATH  . 'pubkey.pem');

                $iat = time(); // current timestamp value
                $exp = $iat + 3600;
        
                $payload = array(
                    "iss" => "Issuer of the Localhost",
                    "aud" => "Audience that the Localhost",
                    "sub" => "Subject of the JWT",
                    "iat" => $iat, //Time the JWT issued at
                    "exp" => $exp, // Expiration time of token
                    "data" => [
                        'user_id'   => $user['id'],
                        'user_name' => $user['name'],
                        'user_email'=> $user['email'],
                    ]
                );

                $token =  JWT::encode($payload, $privateKey,'RS256');

                $decoded = JWT::decode($token, new Key($publicKey, 'RS256'));
                
                $response = [
                    'status'    => 200,
                    'error'     => false,
                    'token'     => $token,
                    'code'      => 'Successfully_Login_User', 
                    'message'   => 'Login Succesful',
                    'decoded'   => $decoded
                ];
            }
            else{
                $response = [
                    'status'    => 500,
                    'error'     => true,
                    'code'      => 'Auth_Validation_Error', 
                    'message'   => 'Invalid Email or Password.',
                    'data'      => []
                ];
            }
            
        }
        return $this->respondCreated($response);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
