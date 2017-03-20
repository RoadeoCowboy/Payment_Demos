<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://test.adyen.com/hpp/cse/js/8214884821962225.shtml"></script>
</head>

<title>David's Adyen Checkout</title>

<body>


	<form method="POST" action="adyenserver.php" id="adyen-encrypted-form">
    <input type="text" size="20" autocomplete="off" data-encrypted-name="number" />
    <input type="text" size="20" autocomplete="off" data-encrypted-name="holderName" />
    <input type="text" size="2" maxlength="2" autocomplete="off" data-encrypted-name="expiryMonth" />
    <input type="text" size="4" maxlength="4" autocomplete="off" data-encrypted-name="expiryYear" />
    <input type="text" size="4" maxlength="4" autocomplete="off" data-encrypted-name="cvc" />
    <input type="hidden" value="generate-this-server-side" data-encrypted-name="generationtime" />
    <input type="submit" value="Pay" />
</form>

<script type="text/javascript">
// The form element to encrypt.
var form = document.getElementById('adyen-encrypted-form');

// Form and encryption options. See adyen.encrypt.simple.html for details.
var options = {};

// Create the form.
// Note that the method is on the adyen object, not the adyen.encrypt object.
adyen.createEncryptedForm(form, options); 
</script>

</body>

</html>