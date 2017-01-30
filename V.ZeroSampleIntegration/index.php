
<html>

<head>

<title>Braintree Test Page</title>

</head>

 <!-- <script src="https://js.braintreegateway.com/v2/braintree.js"></script> -->
 <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->

<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> -->

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

<body>

<!-- <div class="jumbotron"> -->
	<form id="checkout" method="post" action="checkout.php">
	  <div id="dropin-container"></div>
	  Charge Amount: $<input type="text" name="amount"><br>
	  First Name: <input type="text" name="firstName"><br>
	  Last Name: <input type="text" name="lastName"><br>
	  Company: <input type="text" name="company"><br>
	  <input type="submit" value="Submit">
	</form>
<!-- </div> -->


<?php
require 'braintree-php-2.28.0/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');

$clientToken = Braintree_ClientToken::generate();
error_log($clientToken);
?>

<script type="application/javascript" >
	braintree.setup("<?php echo $clientToken; ?>", 'dropin', {
	  container: 'dropin-container'
	});
</script> 



</body>

</html>
