<?php 
/* 
 * PayPal and database configuration 
 */ 
  
// PayPal configuration 
define('PAYPAL_ID', 'payment@webmasterdriver.net'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = explode( 'with-paypal' , $actual_link );
$actual_link = $actual_link[0].'/with-paypal/';
 
define('PAYPAL_RETURN_URL', $actual_link.'success.php'); 
define('PAYPAL_CANCEL_URL', $actual_link.'cancel.html'); 
define('PAYPAL_NOTIFY_URL', $actual_link.'paypal/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");