<?php

require 'braintree-php-3.20.0/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');

$nonce = $_POST["nonceToServer"];
// $firstName = $_POST["first_name"];
// $lastName = $_POST["last_name"];

error_log("nonce is: " . print_r($nonce));   

$vaultResult = Braintree_Customer::create(array(
    'firstName' => "David",
    'lastName' => "Chen",
    'company' => "company",
    'paymentMethodNonce' => $nonce
));

//Using Vault Customer id to create the transaction.
$transactionResult = Braintree_Transaction::sale(
  array(
    'customerId' => $vaultResult->customer->id,
    'amount' => 10,
    'options' => [
        'submitForSettlement' => True
  	]
  )
);

if($result->success){
	$transaction = $result->transaction;
	error_log("transaction statusss is: " . $transaction->status);
	error_log("transaction ID: " . $transaction->id);
	// echo($result->success)
}


?>