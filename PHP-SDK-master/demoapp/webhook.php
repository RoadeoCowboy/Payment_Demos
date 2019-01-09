<?php

/**
 * Put your API credentials here:
 * Get these from your API app details screen
 * https://stage.wepay.com/app
 */
$client_id = "98172";
$client_secret = "780f9630a5";
$access_token = "STAGE_2aa3573311fcd3e92512ad11b785f38146069da979e8075f73925d758aed944d";

/** 
 * Initialize the WePay SDK object 
 */
require '../wepay.php';
Wepay::useStaging($client_id, $client_secret);
$wepay = new WePay($access_token);

// # Get JSON as a string
// $json_str = file_get_contents('php://input');

// error_log($json_str);
// error_log("Hello World");

echo "Hello World!";

if(isset($_POST['checkout_id'])){
	$responseIPN = $wepay->request('checkout', array(
	// 'checkout_id'	=> $response->checkout_id
	'checkout_id' => $_POST['checkout_id']
));

error_log(print_r($responseIPN, true));

} 

else if(isset($_POST['account_id'])){

}

else{

}

// file_put_contents("/tmp/webhook.log", $responseIPN, FILE_APPEND);

header("HTTP/1.1 200 OK");

// $json_str = $_POST['object_id'];

// error_log($json_str);
# Get as an object
// $json_obj = json_decode($json_str);

// $responseJSON = json_encode($json_str);

// echo $responseJSON;



?>