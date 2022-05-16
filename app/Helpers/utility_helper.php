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
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
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
        
        //$config['protocol'] = 'mail'; //FIXED
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['smtp_crypto'] = 'ssl'; //FIXED
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
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
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
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
            $email->setMessage(view('email/welcomeEmail', $data, ['saveData' => true]));
            $email->setTo($detail["emailTo"]);
            $status = $email->send();
            
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
        // pre($detail);
        // die;
        $email = Services::email();
        $email = setProtocol();        
        
        $email->setFrom(EMAIL_FROM, FROM_NAME);
        $email->setSubject("Reset Password");
        $email->setMessage('cool');
        $email->setTo($detail["email"]);
        $status = $email->send();
        
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
            $email->setBCC(EMAIL_BCC_C);
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
