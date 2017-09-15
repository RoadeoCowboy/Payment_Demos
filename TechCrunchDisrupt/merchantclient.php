<!DOCTYPE html>
<html>
<head>
<!-- Load the required client component. -->
	<script src="https://js.braintreegateway.com/web/3.0.2/js/client.min.js"></script>

	<!-- Load additional components if desired. -->
	<script src="https://js.braintreegateway.com/web/3.0.2/js/hosted-fields.min.js"></script>
	<script src="https://js.braintreegateway.com/web/3.0.2/js/paypal.min.js"></script>
	<script src="https://js.braintreegateway.com/web/3.0.2/js/data-collector.min.js"></script>
	<link rel="stylesheet" href="//codepen.io/braintree/pen/oLxqjd.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<title>David's Awesome Shop</title>

<body>

<div style="position:absolute; top:200px; left:200px;">
<div class="card-form">

  <div class="card-form__inner cf">
    <div class="card-form__element" data-input-text="Credit Card Number">
      <ul class="card-form__layers">
        <li class="card-form__layer">
          <form action="">
            <div id="cc-num" class="card-form__input card-form__hosted-field" /></form>
        </li>
      </ul>
    </div>
    <div class="card-form__element half" data-input-text="CVV">
      <ul class="card-form__layers">
        <li class="card-form__layer">
          <form action="">
            <div id="cc-cvv" class="card-form__input card-form__hosted-field"/>
          </form>
        </li>
      </ul>
    </div>
    <div class="card-form__element half" data-input-text="MM/YY">
      <ul class="card-form__layers">
        <li class="card-form__layer">
          <form action="">
            <div id="cc-expiration-date" class="card-form__input card-form__hosted-field" />
          </form>
        </li>
      </ul>
    </div>
    <input type="hidden" id ="payment-method-nonce" name="payment-method-nonce">
    <button disabled value="submit" id="submit" class=""><div>Pay</div></button>
  </div>
</div>
</div>
  <?php
		require 'braintree-php-3.20.0/lib/Braintree.php';

		Braintree_Configuration::environment('sandbox');
		Braintree_Configuration::merchantId('k8cqxzf43pkmt3vk');
		Braintree_Configuration::publicKey('d5nfy46p5m5rj2jj');
		Braintree_Configuration::privateKey('ec98ec5d3511ca20d14414882f25eac5');
		
		$clientToken = Braintree_ClientToken::generate();
	?>

	<script>
	alert("<?php echo $clientToken; ?>");

var form = document.querySelector('#checkout-form');
var submitBtn = document.querySelector('#submit');

braintree.client.create({
  authorization: "<?php echo $clientToken; ?>"
}, function (err, clientInstance) {
  braintree.hostedFields.create({
    client: clientInstance,
    fields: {
      number: {
        selector: '#cc-num',
        placeholder: 'Credit Card Number'
      },
      cvv: {
        selector: '#cc-cvv',
        placeholder: 'CVV'
      },
      expirationDate: {
        selector: '#cc-expiration-date',
        placeholder: 'MM/YY'
      }
    },
    styles: {
      input: {
        'font-size': '16px',
        '-webkit-font-smoothing': 'antialiased'
      }
    }
  }, function (err, hostedFieldsInstance) {
    
    hostedFieldsInstance.on('validityChange', function (event) {
      var allValid = true;
      var field, key;
      
      for (key in event.fields) {
        if (event.fields[key].isValid === false) {
          allValid = false;
          break;
        }
      }
      
      if (allValid) {
        submitBtn.removeAttribute('disabled');
      } else {
        submitBtn.setAttribute('disabled', 'disabled');
      }
    });
    
    submitBtn.addEventListener('click', function () {
      if (err) {
        console.error(err);
        return;
      }

       hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
        if (tokenizeErr) {
          // Handle error in Hosted Fields tokenization
          switch (tokenizeErr.code) {
	  			case 'HOSTED_FIELDS_FIELDS_EMPTY':
		        	console.error('All fields are empty! Please fill out the form.');
		        break;
		      	case 'HOSTED_FIELDS_FIELDS_INVALID':
		        	console.error('Some fields are invalid:', tokenizeErr.details.invalidFieldKeys);
		        break;
		      	case 'HOSTED_FIELDS_FAILED_TOKENIZATION':
		        	console.error('Tokenization failed server side. Is the card valid?');
		        	break;
		      case 'HOSTED_FIELDS_TOKENIZATION_NETWORK_ERROR':
		        	console.error('Network error occurred when tokenizing.');
		        	break;
		      default:
		        	console.error('Something bad happened!', tokenizeErr);
    		}
          return;
        }	//end if
        else {
		    console.log('Got nonce:', payload.nonce);
	  }	//end else
 	document.querySelector('input[name="payment-method-nonce"]').value = payload.nonce;
        // form.submit();
        $.ajax({
        	url: './MerchantServer.php',
        	type: 'POST',
        	data: { 'payment-method-nonce' : payload.nonce},
        	success: function(data) {
        		alert('Data sent Successfully');
        	}
        });
      });	//end tokenize
   }, false);
   
  });
});
	</script>

</body>

</html>
