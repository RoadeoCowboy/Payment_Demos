<?php

require_once('./config.php');
// foreach (glob("*.php") as $filename) {
//     require_once $filename;
// }
// function __autoload($class){
// 	global $debug;
//  	if ($debug == 1) {
//  		error_log("__autoload is being called for " . $class);
//  	}
//  	@include('./stripe-php-4.1.0/lib/' . $class . '.php');
// }
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
//\Stripe\Stripe::setApiKey("sk_test_jhhU3kVsIRRb81QiOyBvTYzY");


// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];
error_log($token);

// Create a charge: this will charge the user's card
try {
  $charge = \Stripe\Charge::create(array(
    "amount" => 999, // Amount in cents
    "currency" => "usd",
    "source" => $token,
    "description" => "Example charge",
    "destination" => array("account" => "acct_1APydMLTnwCHzdq6")
    ));
 	echo '<h1>Successfully charged $9.99!</h1>';
} catch(\Stripe\Error\Card $e) {
  // The card has been declined
}

?>


