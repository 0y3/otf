<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use \App\Libraries\Oauth2;
use App\Models\UserModel;
use \OAuth2\Request;


class UserController extends ResourceController
{
    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    function __construct()
    {
        helper(['form', 'url','email','session','cookie']);
        $this->session = service('session'); # or \Config\Services::session();
        $this->users = model('UserModel');  # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
    }
    public function index(){
        set_cookie('location', 'jos');
        $response = [
            'status'    => 200,
            'error'     => false,
            'code'      => 'Successfully_Signup_User',
            'message'   => 'User added successfully',
            'data'      => [
                'location' => get_cookie('location'),
                'has cook' => has_Cookie('location'),
            ]
        ];
        
        return $this->respondCreated($response);
    }
    public function login(){

        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('posts/create', [
                'validation' => $this->validator
            ]);
        }

		$oauth = new Oauth2();
		$request = new Request();
		$respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
		$code = $respond->getStatusCode();
		$body = $respond->getResponseBody();
		return $this->respond(json_decode($body), $code);
	}
}
