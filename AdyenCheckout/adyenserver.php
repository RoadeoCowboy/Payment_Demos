<?php

 
 if(isset($_POST['adyen-encrypted-data'])){
 	// echo ("Server Data Received! <br>");

 		 /**
	  * The payment can be submitted by sending a PaymentRequest 
	  * to the authorise action of the web service, the request should 
	  * contain the following variables:
	  * - action: Specifies the action on the web service.
	  * - merchantAccount: The merchant account the payment was processed with.
	  * - amount: The amount of the payment
	  * 	- currency: the currency of the payment
	  * 	- amount: the amount of the payment
	  * - reference: Your reference
	  * - shopperIP: The IP address of the shopper (optional/recommended)
	  * - shopperEmail: The e-mail address of the shopper 
	  * - shopperReference: The shopper reference, i.e. the shopper ID
	  * - fraudOffset: Numeric value that will be added to the fraud score (optional)
	  * - paymentRequest.additionalData.card.encrypted.json: The encrypted card caught by the POST variables.
	  */
	$request = array(
		"merchantAccount" => "BraintreeCOM178",    
		"amount" => array(
				"value"=>10000,
				"currency"=>"USD"),
		"reference" => "TEST-PAYMENT-" . date("Y-m-d-H:i:s"),
		"shopperIP" => "ShopperIPAddress",
		"shopperEmail" => "TheShopperEmailAddress",
		"shopperReference" => "YourReference", 
		"fraudOffset" => "0",
    		"additionalData"=>array(
    			"card.encrypted.json" => $_POST['adyen-encrypted-data']
    		),
		"browserInfo"=>array(
			"acceptHeader"=>$_SERVER['HTTP_USER_AGENT'],
			"userAgent"=>$_SERVER['HTTP_ACCEPT']
	)		
	 );
	 
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_URL, "https://pal-test.adyen.com/pal/servlet/Payment/v25/authorise");
	 curl_setopt($ch, CURLOPT_HEADER, false); 
	 curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC  );
	 curl_setopt($ch, CURLOPT_USERPWD, "ws@Company.Braintree710:[wHi]dwIAehP<9da7pyu5T(v@");   
	 curl_setopt($ch, CURLOPT_POST,count(json_encode($request)));
	 curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($request));
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  	 curl_setopt($ch, CURLOPT_HTTPHEADER,array("Content-type: application/json")); 
   
	  
	 $result = curl_exec($ch);
	 
	 if($result === false)
		echo "Error: " . curl_error($ch);
	 else{
		/**
		 * If the payment passes validation a risk analysis will be done and, depending on the
		 * outcome, an authorisation will be attempted. You receive a
		 * payment response with the following fields:
		 * - pspReference: The reference we assigned to the payment;
		 * - resultCode: The result of the payment. One of Authorised, Refused or Error;
		 * - authCode: An authorisation code if the payment was successful, or blank otherwise;
		 * - refusalReason: If the payment was refused, the refusal reason.
		 */ 
		error_log($result);
		$outputArray = json_decode($result, true);
		// print_r(json_decode($result));
	
		if($outputArray['resultCode'] == "Authorised"){
			echo "Payment Success! </br>";
			echo "</br>";
			echo "Your authCode: " . $outputArray['authCode'];
		}
		else if ($outputArray['resultCode'] == "Refused"){
			echo "Payment Refused! </br>";
			echo "</br>";
			echo "Your resultReason: " . $outputArray['refusalReason'];
		}
		else {
			echo "You Have Some Other Error!";
		}
	 }
	 
	 curl_close($ch);
 }

?>