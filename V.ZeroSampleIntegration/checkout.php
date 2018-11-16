<?php
require 'braintree-php-2.28.0/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');

$nonce = $_POST["payment_method_nonce"];
error_log("Payment nonce is: " . $nonce, 0);

//Creating a Vault customer from HTML form  
$vaultResult = Braintree_Customer::create(array(
    'firstName' => $_POST["firstName"],
    'lastName' => $_POST["lastName"],
    'company' => $_POST["company"],
    'paymentMethodNonce' => $nonce,

));
if ($vaultResult->success) {
    echo($vaultResult->customer->id);
    $message = $vaultResult->customer->id;
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo($vaultResult->customer->creditCards[0]->token);
} else {
    foreach($vaultResult->errors->deepAll() AS $error) {
        echo($error->code . ": " . $error->message . "\n");
    }
}

//Using Vault Customer id to create the transaction.
$transactionResult = Braintree_Transaction::sale(
  array(
    'customerId' => $vaultResult->customer->id,
    'amount' => $_POST["amount"],
    'options' => [
        'submitForSettlement' => True
  ]
  )
);

echo "Transaction Result is: " . $transactionResult;

?>

<!-- 5b3e669e-1485-438a-b235-b55c746c8274 -->