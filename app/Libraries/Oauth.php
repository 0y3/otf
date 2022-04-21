<?php namespace App\Libraries;

use \OAuth2\GrantType\GrantTypeInterface;
use \OAuth2\GrantType\ClientCredentials;
use \OAuth2\GrantType\AuthorizationCode;
use \OAuth2\GrantType\UserCredentials;
use \OAuth2\GrantType\RefreshToken;
use \OAuth2\GrantType\JwtBearer;
use \OAuth2\Storage\Pdo;
use \OAuth2\Server;

class Oauth2{

    var $storage;
    var $server;
    private $dsn = getenv('database.default.DSN');
    private $username = getenv('database.default.username');
    private $password = getenv('database.default.password');

    function __construct()
    {
        $this->set_config($grantType = null);
    }

    public function set_config($grantType = null)
	{

        // db storage
        $dbConectStorage = new Pdo(['dsn' => $this->dsn, 'username' => $this->username, 'password' => $this->password]); 
        $server = new Server($dbConectStorage);

        //Ade Grant Type
        if($grantType == null)
        {
            $grantType = new UserCredentials($dbConectStorage);
        }
        else if($grantType == 'grantAuth')
        {
            $grantType = new AuthorizationCode($dbConectStorage);
        }
        else if($grantType == 'grantClient')
        {
            $grantType = new ClientCredentials($dbConectStorage);
        }
        $server->addGrantType($grantType); 
        // or $server->addGrantType(new AuthorizationCode($storage)); 
    }
}