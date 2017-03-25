<!DOCTYPE html>
<html>
<head>
	<!-- Load the required client component. -->
	<script src="https://js.braintreegateway.com/web/3.9.0/js/client.min.js"></script>
	<!-- Load additional components if desired. -->
	<script src="https://js.braintreegateway.com/web/3.9.0/js/visa-checkout.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<title>Braintree's Visa Checkout</title>

<body>
	<?php
		require 'braintree-php-3.20.0/lib/Braintree.php';

		Braintree_Configuration::environment('sandbox');
		Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
		Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
		Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');
		
		$clientToken = Braintree_ClientToken::generate([]
        'customerId' => 33001552
      ]);
	?>

	<script>
		alert("<?php echo $clientToken; ?>");

		// Create a client.
		braintree.client.create({
			authorization: "<?php echo $clientToken; ?>"
		}, function (clientErr, clientInstance) {

  		// Stop if there was a problem creating the client.
  		// This could happen if there is a network error or if the authorization
  		// is invalid.
  		if (clientErr) {
    		console.error('Error creating client:', clientErr);
    		return;
  		}

  // Create a Visa Checkout component.
  braintree.visaCheckout.create({
    client: clientInstance
  }, function (visaCheckoutErr, visaCheckoutInstance) {

    // Stop if there was a problem creating Visa Checkout.
    // This could happen if there was a network error or if it's incorrectly
    // configured.
    if (visaCheckoutErr) {
      console.error('Error creating VisaCheckout:', visaCheckoutErr);
      return;
    }

    visaCheckoutInitialized(visaCheckoutInstance);
  });
});

function visaCheckoutInitialized(visaCheckoutInstance) {
  alert('V VisaCheckout ready!')
   var baseInitOptions = {
    paymentRequest: {
      currencyCode: "USD",
      subtotal: "10.00"
    }
  };

  // Populate init options with options Braintree requires.
 var initOptions = visaCheckoutInstance.createInitOptions(baseInitOptions);
  V.init(initOptions);

  // Ready to start Visa Checkout.
    V.on("payment.success", function (payment) {
    visaCheckoutInstance.tokenize(payment, function (tokenizeErr, tokenizePayload) {
      if (tokenizeErr) {
        console.error('Error during Visa Checkout tokenization', tokenizeErr);
      } else {
        // Send this to your server, and create a transaction there.
        $.post("visaserver.php",
        {
          nonceToServer: tokenizePayload.nonce
        },
        function(data, status) {
          if(status == "success") {
            alert("Transaction with Visa Checkout Successful!");
          }
        }
        );
        console.log('tokenizePayload', tokenizePayload);
      }
    });
  });
}
	</script>
	<!-- Visa Checkout button img tag -->
	<img class="v-button" role="button" tabindex="0" src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png" alt="Visa Checkout" />
	<!-- Visa Checkout SDK -->
	<script src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js" type="text/javascript"></script>
</body>

</html>