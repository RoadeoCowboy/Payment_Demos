<?php

require 'braintree-php-3.20.0/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');

$nonce = $_POST["payment-method-nonce"];

error_log("nonce is: " . $nonce);   

$result = Braintree_Transaction::sale([
  'amount' => 2000,
  'paymentMethodNonce' => $nonce,
  'options' => [
    'submitForSettlement' => True
  ]
]);

error_log(print_r($result, true));

error_log("Result Message is: " . print_r($result->message, true));

if($result->success){
	$transaction = $result->transaction;
	error_log("transaction statusss is: " . $transaction->status);
	error_log("transaction ID: " . $transaction->id);
	// echo($result->success)
}


?>

