<?php
	// WePay PHP SDK - http://git.io/mY7iQQ
	require_once 'vendor/autoload.php';
	require 'vendor/wepay/php-sdk/wepay.php';
	// oauth2 parameters
	$code = $_POST['code']; // the code parameter from step 2
	error_log("Code is: " . $code, 0);
	$redirect_uri = "http://localhost:8888/Payment_Demos/WePay/Account_Connected.html"; // this is the redirect_uri you used in step 1
	// application settings
	$client_id = 98172;
	$client_secret = "780f9630a5";
	// change to useProduction for live environments
	Wepay::useStaging($client_id, $client_secret);
	$wepay = new WePay(NULL); // we don't have an access_token yet so we can pass NULL here
	// create an account for a user
	$response = WePay::getToken($code, $redirect_uri);
	// display the response
	// print_r($response);
	$access_token = $response->access_token;
	error_log("Access Token is: " . $access_token);

	$wepay = new WePay($access_token);
    // create an account for a user
    $response = $wepay->request('account/create/', array(
        'name'          => 'My New Account',
        'description'   => 'This is a test Connected Account.'
    ));

    $account_id = $response->account_id;
    error_log("Account_ID is: " . $account_id);

	// $responseJSON = json_encode($response);

	 // create the checkout
    $response = $wepay->request('checkout/create', array(
        'account_id'        => $account_id,
        'amount'            => '59.95',
        'short_description' => 'Services rendered by freelancer',
        'type'              => 'service',
        'currency'          => 'USD',
        'hosted_checkout' => ['mode' => "iframe"],
        'callback_uri' => 'http://aqueous-taiga-51771.herokuapp.com/PHP-SDK-master/demoapp/webhook.php'
    ));

    $responseJSON = json_encode($response);

	echo $responseJSON;

	$responseIPN = $wepay->request('checkout', array(
		'checkout_id'	=> $response->checkout_id
		// 'checkout_id' 	=> '1768820240'
	));

	error_log(print_r($responseIPN, true));

?>