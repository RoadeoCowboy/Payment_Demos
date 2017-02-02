<?php
require 'braintree-php-3.10.0/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');

$clientToken = Braintree_ClientToken::generate();

echo ($clientToken);

$nonce = $_POST["payment_method_nonce"];

error_log("nonce is: " . $nonce);   

$result = Braintree_Transaction::sale([
  'amount' => $_POST["amount"],
  'paymentMethodNonce' => $nonce,
  'options' => [
    'submitForSettlement' => True
  ]
]);

if($result->success){
	$transaction = $result->transaction;
	error_log("transaction status is: " . $transaction->status);
	// echo($result->success)
}

// $ldap = "ldap://localhost:8888";
// $ds = ldap_connect($ldap, 389);  
// // ldap_connect("ldap://host.domain", 389)
// $ldapbind = false;
   
// if(ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
//   if(ldap_set_option($ds, LDAP_OPT_REFERRALS, 0))  {
//      if(ldap_start_tls($ds)) {
// 		// error_log("Client Token is: " . $clientToken);
// 		error_log("TLS Successful!", 0);
//      }
//   }
// }

// ldap_close($ds);



?>