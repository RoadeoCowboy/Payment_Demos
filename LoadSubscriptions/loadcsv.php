<?php

require 'braintree-php-3.20.0/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');

ini_set('auto_detect_line_endings', TRUE);

/* Map Rows and Loop Through Them */
    // $rows   = array_map('str_getcsv', file('data.csv'));
    // error_log(print_r($rows, true), 0);
    // $header = array_shift($rows);
    // error_log(print_r($header, true), 0);
    // $csv[]    = array();
    
    // foreach($rows as $row) {
    //     $csv = array_combine($header, $row);
    // }
    // error_log(print_r($csv), 0);



$csv = array_map('str_getcsv', file('data.csv'));
    
array_walk($csv, function(&$a) use ($csv) {
	$a = array_combine($csv[0], $a);
});
    
array_shift($csv); # remove column header

// error_log(print_r($csv, true), 0);

foreach($csv as $row){

	$result = Braintree_Subscription::create([
		'paymentMethodToken' => $row['Payment_Method_Token'],
		'planId' => $row['Plan_ID']
	]);

	// error_log(print_r($result, true), 0);

	if($result->success){
		$subscription = $result->subscription;

		error_log('Subscription Created', 0);
		error_log(print_r($subscription->id, true), 0);

		echo ('Subscription Created! <br/>');
		echo ('Subscription Id: ' . $subscription->id . '<br/>');
	}
}



?>