<?php

$response = json_decode($_POST['json'], true);

error_log("Response is: " . print_r($response, true));

$secret = 'QQJXpMmdgHNW2v3k5$yqAbLvy}IGM1OLlFeZhO0P';
// $opts = getopt("k:d:");
// $rawPayload = decryptPayload($secret, $opts["k"], $opts["d"]);

$rawPayload = decryptPayload($secret, $response['encKey'], $response['encPaymentData']);

error_log("rawPayload is: " . $rawPayload);

echo json_encode($rawPayload, 128);

function decryptPayload($key, $wrappedKey, $payload) {
  //print "Secret: " . $key . "\n";
  error_log("Secret: " . $key);
  //print "encKey: " . $wrappedKey . "\n";
  error_log("encKey: " . $wrappedKey);
  //print "encPaymentData: " . $payload . "\n";  
  error_log("encPaymentData: " . $payload); 
  $unwrappedKey = decrypt($key, $wrappedKey);   
  //print "Unwrapped Key: " . $unwrappedKey . "\n";
  return decrypt($unwrappedKey, $payload);  
}   

function decrypt($key, $data) {    
  $decodedData = base64_decode($data);  
   // TODO: Check that data is at least bigger than HMAC + IV length    
   error_log("key in Decrypt is: " . $key);
   $hmac = substr($decodedData, 0, 32);
   error_log("hmac in Decrypt is: " . $hmac);  
   $iv = substr($decodedData, 32, 16);  
   error_log("iv in Decrypt is: " . $iv); 
   $data = substr($decodedData, 48);
   error_log("data in Decrypt is: " . $data);    
   if ($hmac != hmac($key, $iv . $data)) {    
     // TODO: Handle HMAC validation failure      
     return 0;   
   }    
   //echo "no error";
   return openssl_decrypt($data, 'aes-256-cbc', hashKey($key), true, $iv); 
}
  
function hashKey($data) {   
  $hasher = hash_init('sha256');    
  hash_update($hasher, $data);    
  return hash_final($hasher, true); 
}   
 
function hmac($key, $data) {    
  return hash_hmac('sha256', $data, $key, true);  
}   

?> 