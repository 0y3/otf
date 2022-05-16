<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


//Site Categories
define('VENDOR_REST',            'restaurant'); // Restorant Vendor Id
define('VENDOR_GROC',               'grocery'); // Party Vendor Id
define('VENDOR_PART',                 'party'); // Grocery Vendor Id

//Order Status
define('ORDER_PEN',            'Pending'); // Pending Order
define('ORDER_PRO',            'Processing'); // Processing Order
define('ORDER_DIS',            'Dispatched'); // Dispatched Order
define('ORDER_DEL',            'Delivered'); // Delivered Order
define('ORDER_CAN',            'Canceled'); // Canceled Order

/************************** EMAIL CONSTANTS *****************************/

define('EMAIL_FROM',                            'noreply@vdoc.com.ng');		// e.g. email@example.com
define('EMAIL_BCC_C',                           'trivin98@gmail.com, info@afritech.com.ng,info@vdoc.com.ng,e.gabriel@afritech.com.ng,
												j.blessing@afritech.com.ng,a.kolawole@afritech.com.ng,m.fatima@afritech.com.ng
												sa.mohammed@afritech.com.ng,o.john@afritech.com.ng,o.priscilla@afritech.com.ng
												l.bintu@afritech.com.ng,ministergabi@gmail.com');		// e.g. email@example.com
define('EMAIL_BCC',                           	'info@afritech.com.ng, info@vdoc.com.ng, m.fatima@afritech.com.ng, o.john@afritech.com.ng,
												o.priscilla@afritech.com.ng');	
define('FROM_NAME',                             'Vdoc Vehicle Services Admin System');	// Your system name
define('EMAIL_PASS',                            'Your email password');	// Your email password
define('PROTOCOL',                             	'sendmail');				// mail, sendmail, smtp
define('SMTP_HOST',                             'vdoc.com.ng');		// your smtp host e.g. smtp.gmail.com
define('SMTP_PORT',                             '25');					// your smtp port e.g. 25, 587
define('SMTP_USER',                             '_mainaccount@vdoc.com.ng');		// your smtp user
define('SMTP_PASS',                             'NewP@$$w0rd');//'Afritechnew1$$@1');	// your smtp password
define('MAIL_PATH',                             '/usr/sbin/sendmail');

