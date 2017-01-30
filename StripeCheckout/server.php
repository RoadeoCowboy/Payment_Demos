<?php

require_once('vendor/autoload.php');
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
\Stripe\Stripe::setApiKey("sk_test_WX68phXgrdc8IZ8etwVdVVEN");
// Stripe::setApiKey("sk_test_WX68phXgrdc8IZ8etwVdVVEN");

// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];

// Create a charge: this will charge the user's card
try {
  $charge = \Stripe\Charge::create(array(
    "amount" => 1000, // Amount in cents
    "currency" => "usd",
    "source" => $token,
    "description" => "Example charge"
    ));
 	echo '<h1>Successfully charged $10.00!</h1>';
} catch(\Stripe\Error\Card $e) {
  // The card has been declined
}

?>