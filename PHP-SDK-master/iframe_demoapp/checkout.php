<?php
/**
 * This PHP script helps you do the iframe checkout
 *
 */


/**
 * Put your API credentials here:
 * Get these from your API app details screen
 * https://stage.wepay.com/app
 */
$client_id = "98172";
$client_secret = "780f9630a5";
$access_token = "STAGE_2aa3573311fcd3e92512ad11b785f38146069da979e8075f73925d758aed944d";
$account_id = "2085344274"; // you can find your account ID via list_accounts.php which users the /account/find call

/** 
 * Initialize the WePay SDK object 
 */
require '../wepay.php';
Wepay::useStaging($client_id, $client_secret);
$wepay = new WePay($access_token);

/**
 * Make the API request to get the checkout_uri
 * 
 */
try {
	$checkout = $wepay->request('/checkout/create', array(
			'account_id' => $account_id, // ID of the account that you want the money to go to
			'amount' => 100, // dollar amount you want to charge the user
			'currency' => "USD", // the currency used
			'short_description' => "this is a test payment", // a short description of what the payment is for
			'type' => "goods", // the type of the payment - choose from 'goods', 'service', 'donation', 'event', or 'personal'
			'hosted_checkout' => ['mode' => "iframe"], // user 'hosted_checkout' parameter if you want the checkout to be in an iframe, use 'payment_method' parameter instead if you want to use payment information your platform has previously aquired
			'callback_uri' => "https://aqueous-taiga-51771.herokuapp.com/PHP-SDK-master/demoapp/webhook.php"
		)
	);
} catch (WePayException $e) { // if the API call returns an error, get the error message for display later
	$error = $e->getMessage();
}

$responseIPN = $wepay->request('checkout', array(
		'checkout_id'	=> $checkout->checkout_id
		// 'checkout_id' 	=> '1768820240'
	));

	error_log(print_r($responseIPN, true));

?>

<html>
	<head>
	</head>
	
	<body>
		
		<h1>Checkout:</h1>
		
		<p>The user will checkout here:</p>
		
		<?php if (isset($error)): ?>
			<h2 style="color:red">ERROR: <?php echo htmlspecialchars($error); ?></h2>
		<?php else: ?>
			<div id="checkout_div"></div>
		
			<script type="text/javascript" src="https://stage.wepay.com/js/iframe.wepay.js">
			</script>
			
			<script type="text/javascript">
			WePay.iframe_checkout("checkout_div", "<?php echo $checkout->hosted_checkout->checkout_uri ?>");
			</script>
		<?php endif; ?>
	
	</body>
	
</html>
