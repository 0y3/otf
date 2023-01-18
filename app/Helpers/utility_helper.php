<?php

use Config\Services;

/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $request = Services::request();
        $agent = $request->getUserAgent();

        $currentAgent = '';

        if ($agent->isBrowser()) {
            $currentAgent = $agent->getPlatform() .' '.$agent->getBrowser() . '/' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        
        return $currentAgent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $email = Services::email();
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['SMTPHost'] = SMTP_HOST;
        $config['SMTPUser'] = SMTP_USER;
        $config['SMTPPass'] = SMTP_PASS;
        $config['SMTPPort'] = SMTP_PORT;
        $config['mailType'] = "html";
        $config['wordWrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['SMTPCrypto'] = 'ssl'; //FIXED
        
        $email->initialize($config);
        
        return $email;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $email = Services::email();

        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['SMTPHost'] = SMTP_HOST;
        $config['SMTPUser'] = SMTP_USER;
        $config['SMTPPass'] = SMTP_PASS;
        $config['SMTPPort'] = SMTP_PORT;
        $config['mailType'] = "html";
        $config['newline'] = "\r\n";
        $config['wordWrap'] = TRUE;

        $email->initialize($config);
        return $email;
    }
}

if(!function_exists('TestingEmail'))
{
    function TestingEmail($detail)
    {
        if(!empty($detail))
        {
            $data["data"] = $detail;
            //pre($detail);die;
            $email = Services::email();
            $email = setProtocol();        
            
            //$CI->email->from($detail["email"], $detail['name']);
            $email->setFrom(EMAIL_FROM, FROM_NAME);
            $email->setSubject('Testing Email Server | OTF Online');
            $email->setMessage($detail["message"]);
            $email->setTo($detail["emailTo"]);
            // $email->setCC(EMAIL_CC);//CC
            $email->setBCC(EMAIL_BCC);// and BCC
            if($detail["filename"]){$email->attach($detail["filename"]);}
            $email->send();
            $status = $email->printDebugger(['headers']);
            return $status;
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('WelcomeEmail'))
{
    function WelcomeEmail($detail)
    {
        if(!empty($detail))
        {
            $data["data"] = $detail;
            //pre($detail);die;
            $email = Services::email();
            $email = setProtocol();        
            
            //$CI->email->from($detail["email"], $detail['name']);
            $email->setFrom(EMAIL_FROM, FROM_NAME);
            $email->setSubject('Thank you for registering with OTF');
            $email->setMessage(view('email/welcomeemail', $data, ['saveData' => true]));
            $email->setTo($detail["emailTo"]);
            $email->send();
            
            $status = $email->printDebugger(['headers']);
            
            return $status;
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);die;
        $email = Services::email();
        $email = setProtocol();        
        
        $email->setFrom(EMAIL_FROM, FROM_NAME);
        $email->setSubject("Reset Password");
        $email->setMessage(view('email/resetpasswordemail', $data, ['saveData' => true]));
        $email->setTo($detail["emailTo"]);
        $email->send();
        
        $status = $email->printDebugger(['headers']);
        
        return $status;
    }
}

if(!function_exists('activationEmail'))
{
    function activationEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;
        $email = Services::email();
        $email = setProtocol();        
        
        $email->setFrom(EMAIL_FROM, FROM_NAME);
        $email->setSubject("Activate & Set Password Email");
        $email->setMessage(view('email/resetPassword', $data, ['saveData' => TRUE]));
        $email->setTo($detail["email"]);
        $status = $email->send();
        
        return $status;
    }
}

if(!function_exists('contactusEmail'))
{
    function contactusEmail($detail)
    {
        if(!empty($detail))
        {
            $data["data"] = $detail;
            //pre($detail);die;

            $email = Services::email();
            $email = setProtocol();        
            
            //$CI->email->from($detail["email"], $detail['name']);
            $email->setFrom(EMAIL_FROM, FROM_NAME);
            $email->setSubject('ContactUs:- '.$detail['subject']);
            $email->setMessage(view('email/contactEmail', $data, ['saveData' => TRUE]));
            $email->setTo($detail["emailTo"]);
            $email->setBCC(EMAIL_BCC);
            $status = $email->send();
            
            return $status;
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('PaymentMadeEmail'))
{
    function PaymentMadeEmail($detail)
    {
        if(!empty($detail))
        {
            $data["data"] = $detail;
            //pre($detail);die;
            $email = Services::email();
            $email = setProtocol();        
            
            //$CI->email->from($detail["email"], $detail['name']);
            $email->setFrom(EMAIL_FROM, FROM_NAME);
            $email->setSubject('Order Payment Invoice with OTF');
            $email->setMessage(view('email/PaymentMadeEmail', $data, ['saveData' => TRUE]));
            $email->setTo($detail["emailTo"]);
            $email->setBCC(EMAIL_BCC);
            $status = $email->send();
            
            return $status;
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        session()->setflashdata($status, $flashMsg);
    }
}

if(!function_exists('setBackUrl'))
{
    function setBackUrl($backUrl)
    {
        $session = Services::session();
        $session->setTempdata('back_url', $backUrl, 60); 
        return redirect()->to('login');
    }
}

if(!function_exists('getDeliveryLocationTemp'))
{
    // Function created by 0y3 to get User Delivery Location
    function getDeliveryLocationTemp()
    {
        $session = Services::session();
        if($session->getTempdata('delivery_location_data')){
            $data = $session->getTempdata('delivery_location_data');
            return $data;
        }
        else{return false;}
    }
}


if(!function_exists('setDeliveryLocationTemp'))
{
    // Function created by 0y3 to set User Delivery Location temp for 20min (60sec x 30min = 1800)
    function setDeliveryLocationTemp($id)
    {
        $session          = Services::session();
        $deliveryLocate   = model('DeliveryLocationsModel');

        $data = $deliveryLocate
                ->select('delivery_locations.*, state_cities.city_name, states.state_name')
                ->join('state_cities', 'delivery_locations.city_id = state_cities.id', 'left')
                ->join('states', 'delivery_locations.state_id = states.id', 'left')
                ->where(['delivery_locations.id' => $id, 'delivery_locations.status' => 1, 'delivery_locations.isdeleted' => 0])
                ->first();
        if($data)
        {
            $locationArray = [
                    'deliveryLocate'        => base64_encode(service('encrypter')->encrypt($data['fee'])),
                    'deliveryLocateId'      => base64_encode(service('encrypter')->encrypt($id)),
                    'deliveryLocateState'   => $data['state_name'],
                    'deliveryLocateCity'    => $data['city_name']
            ];
            
        $session->setTempdata('delivery_location_data', $locationArray, 1800); 
        return true;
        }
        else{return false;}
    }
}

if(!function_exists('getBackUrl'))
{
    function getBackUrl()
    {
        $session = Services::session();
        if($session->getTempdata('back_url')){
            $backUrl = $session->getTempdata('back_url');
            return redirect()->to($backUrl);
        }
        else{return false;}
    }
}

if(!function_exists('generate_random_string'))
{
    // Function created by Segun to generate a random string of specified length
    function generate_random_string($length)
    {
        $characters = '0123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $randomString = '';
        for($i = 0; $i < $length; $i++){
            $randomString .= $characters[random_int(0,strlen($characters) - 1 )];
        }
        return $randomString;
        //echo $randomString;
    }
}

if (! function_exists('randomToken'))
{
    /**
	 * Generate a random token
	 * Inspired from http://php.net/manual/en/function.random-bytes.php#118932
	 *
	 * @param integer $resultLength Result lenght
	 *
	 * @return string
	 */
    function randomToken(int $resultLength=32): string
	{
		if ($resultLength <= 8)
		{
			$resultLength = 32;
		}

		// Try random_bytes: PHP 7
		if (function_exists('random_bytes'))
		{
			return bin2hex(random_bytes($resultLength / 2));
		}

		// No luck!
		throw new \Exception('Unable to generate a random token');
	}
}

if (! function_exists('formatNumber'))
{
    function formatNumber($number)
    {
        if(substr($number,0,4) == '+234')
            $number = substr($number, 3);
        else if(substr($number,0,3) == '234')
            $number = substr($number, 2);
        else if(substr($number,0,1) == '0')
            $number = $number;
        else 
            $number = '0'.$number;
        
        return $number;
    }
}

if (! function_exists('mk_dir_vendor'))
{
    function mk_dir_vendor($file_path)
    {
        if(!file_exists($file_path)){
            // Create a new file or direcotry
            mkdir($file_path, 0777, true); 
            return true;
        }
        else{return false;}
    }
}

if (! function_exists('uniqueRef'))
{
    function uniqueRef( $length = 15, $capsMix = 5 )
    {
        // uniqid gives 15 chars, but you could adjust it to your needs.
        if ( function_exists( "random_bytes" ) ) {
            $bytes = random_bytes( ceil( $length / 2 ) );
        } elseif ( function_exists( "openssl_random_pseudo_bytes" ) ) {
            $bytes = openssl_random_pseudo_bytes( ceil( $length / 2 ) );
        } else {
            throw new \Exception( "No cryptographically secure random function available" );
        }

        if ( $capsMix > 10 ) {
            throw new \Exception( 'capsMix can not be greater than 10' );
        }
        $caps = substr( str_shuffle( 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' ), 1, $capsMix );

        return str_shuffle( substr( bin2hex( $bytes ), 0, $length ) . $caps );
    }
}
if (! function_exists('asteriskMiddle'))
{
    function asteriskMiddle($data){
        // $data = substr_replace($data, str_repeat("*", strlen($data)-2), 1,strlen($data)-2);
        $data = substr_replace($data, str_repeat("*", strlen($data)-4), 4,-3);
        return $data;
    }
}
if (! function_exists('callAPI'))
{
    function callAPI($data=null, $url=null, $method =null, $headers = false){
        $method = $method ?: 'POST';
        $apiurl ="https://api.flutterwave.com/v3/";
		$curl = curl_init();
		switch ($url){
		   case "payments":
            curl_setopt($curl, CURLOPT_URL, $apiurl.$url);   
			  break;
		}
        switch ($method){
            case "POST":
               curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
               if ($data)
                  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
               break;
            case "PUT":
               curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
               if ($data)
                  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));			 					
               break;
            case "GET":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($curl, CURLOPT_URL, $apiurl.$url);			 					
                break;
         }
		// OPTIONS:
		if(!$headers){
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			   'Authorization: Bearer '.getenv('FLW_TEST_SECRET_KEY'),
			   'Content-Type: application/json',
               'User-Agent:'.getBrowserAgent(),
			));
		}else{
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.getenv('FLW_TEST_SECRET_KEY'),
			    'Content-Type: application/json',
			    $headers
			));
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_ENCODING,"");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10000); // 10 sec.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		// EXECUTE:
		$result = curl_exec($curl);
		if(!$result){die(curl_error($curl));}
		curl_close($curl);
		return json_decode($result);
    }
}

