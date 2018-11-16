<html>

<head>
	<script src="https://js.braintreegateway.com/web/3.26.0/js/client.min.js"></script>
	<script src="https://js.braintreegateway.com/web/3.26.0/js/payment-request.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<title>Braintree Payment Request API</title>

<body>
	<div>
		<!-- <form id="payment-form">  -->
			<input type="hidden" id="payment-method-nonce" name="payment-method-nonce"/>
			Purchase Amount: <input type="text" name="amt" id="amt"/>
			<input type="submit" value="Buy Now" id="payment-request-button"/>
		<!-- </form> -->
	</div>

	<?php
		require 'braintree-php-3.26.0/lib/Braintree.php';

		Braintree_Configuration::environment('sandbox');
		Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
		Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
		Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');
		
		$clientToken = Braintree_ClientToken::generate();
	?>

	<script type="text/javascript">
		
		 braintree.client.create({
			authorization: "<?php echo $clientToken; ?>"
		}, function (err, clientInstance){

		if (window.PaymentRequest) {
		  // This browser supports Payment Request
		  // Display your Payment Request button

		  var button = document.querySelector('#payment-request-button');
		  var amount = document.getElementById('amt');
		  
			braintree.paymentRequest.create({
			  client: clientInstance,
			  enabledPaymentMethods: {
    				payWithGoogle: false,
    				basicCard: true
  				}
			}, function (err, instance) {
			  if (err) {
			    // Handle errors from creating payment request instance
			    alert('Error creating Payment Request Instance.');
			  }

			  button.addEventListener('click', function (event) {
			    
			    instance.tokenize({
			      details: {
			        total: {
			          label: 'Total',
			          amount: {
			            currency: 'USD',
			            value: amount.value
			          }
			        }
			      }
			    }, function (err, payload) {
			      if (err) {
			        // Handle errors from processing payment request
			        alert('Error processing payment request.');
			      }
			      // Send payload.nonce to your server
			      else {
		      			console.log('Got nonce:', payload.nonce);
		      		  	// examine the raw response (with card details removed for security) from the payment request
  						console.log(payload.details.rawPaymentResponse);
			      }	//end else

			      document.querySelector('input[name="payment-method-nonce"]').value = payload.nonce;
			      
        				$.ajax({
				        	url: './merchantserver.php',
				        	type: 'POST',
				        	data: { 'payment-method-nonce' : payload.nonce, 'amt' : amount.value},
				        	success: function(data) {
				        		alert('Data sent Successfully.');
				        		window.location.replace('./../');
				        	},
				        	error: function(data) {
				        		alert('Payment Request Failed.');
				        	}
				        });

			    });		//end payload
			  });	//end buttonListener
			});	//end 
		}	//end window.PaymentRequest 
	
		else {
		  // Browser does not support Payment Request
		  // Set up Hosted Fields, etc.
		}
	})	//end braintree.client.create
	</script>

</body>

</html>