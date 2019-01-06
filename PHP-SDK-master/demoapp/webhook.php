<?php

/**
 * Put your API credentials here:
 * Get these from your API app details screen
 * https://stage.wepay.com/app
 */
$client_id = "98172";
$client_secret = "780f9630a5";
$access_token = "STAGE_3475f804a9048c535f895487f41b69232988b78eb4c80092f6779897821a3cff";

/** 
 * Initialize the WePay SDK object 
 */
require '../wepay.php';
Wepay::useStaging($client_id, $client_secret);
$wepay = new WePay($access_token);

# Get JSON as a string
$json_str = file_get_contents('php://input');

error_log($json_str);
error_log("Hello World");
# Get as an object
$json_obj = json_decode($json_str);

// $responseJSON = json_encode($json_str);

// echo $responseJSON;

	$responseIPN = $wepay->request('checkout', array(
		// 'checkout_id'	=> $response->checkout_id
		'checkout_id' 	=> $json_obj->checkout_id
	));

	error_log(print_r($responseIPN, true));

?>