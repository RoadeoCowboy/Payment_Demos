<!DOCTYPE html>
<html lang="en">
  <head>
    <title>David's Adyen Payment</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="css/cse-example-form.css" type="text/css" />
  </head>
  <!-- <script src="https://test.adyen.com/hpp/cse/js/8214884821962225/ui.shtml?theme=dark" async></script> -->
  <body>
    <script type="text/javascript" src="https://test.adyen.com/hpp/cse/js/8214884821962225/ui.shtml?theme=dark"></script>

    <?php
        $time = $_SERVER['REQUEST_TIME'];
    ?>

    <legend>Hosted Payment Page</legend>
        <form method="POST" action="adyenserver.php" id="adyen-encrypted-form">
            <input type="text" size="20" value="Card Number"data-encrypted-name="number"/>
            <input type="text" size="20" value="Card Holder Name" data-encrypted-name="holderName"/>
            <input type="text" size="2" value="MM" data-encrypted-name="expiryMonth"/>
            <input type="text" size="4" value="YYYY" data-encrypted-name="expiryYear"/>
            <input type="text" size="4" value="CVC" data-encrypted-name="cvc"/>
            <input type="hidden" value="<?php echo $time; ?>" data-encrypted-name="generationtime"/>
            <input type="submit" value="Pay"/>
        </form>
<script>
// The form element to encrypt.
var form = document.getElementById('adyen-encrypted-form');
// See https://github.com/Adyen/CSE-JS/blob/master/Options.md for details on the options to use.
var options = {};
// Bind encryption options to the form.
adyen.createEncryptedForm(form, options);
</script> 
    <form method="POST" action="adyenserver.php" id="adyen-encrypted-form">
        <fieldset>
            <legend>Client Side Encryption</legend>
            <div class="field">
                <label for="adyen-encrypted-form-number">
                    <span>Card Number</span>
                    <input type="text" id="adyen-encrypted-form-number" value="4111111111111111" size="20" autocomplete="off" data-encrypted-name="number" />
                </label>
                <span id="cardType"></span>
            </div>

            <div class="field">
                <label for="adyen-encrypted-form-cvc">
                    <span>CVC</span>
                    <input type="text" id="adyen-encrypted-form-cvc" value="737" size="4" maxlength="4" autocomplete="off" data-encrypted-name="cvc" />
                </label>
            </div>
            
            <div class="field">
                <label for="adyen-encrypted-form-holder-name">
                    <span>Card Holder Name</span>
                    <input type="text" id="adyen-encrypted-form-holder-name" value="Test User" size="20" autocomplete="off" data-encrypted-name="holderName" />
                </label>
            </div>
            
            <div class="field">
                <label for="adyen-encrypted-form-expiry-month">
                    <span>Expiration (MM/YYYY)</span>
                    <input type="text" value="08"   id="adyen-encrypted-form-expiry-month" maxlength="2" size="2" autocomplete="off" data-encrypted-name="expiryMonth" /> / 
                </label>
                <!-- Do not use two input elements inside a single label. This will cause focus issues on the seoncd and latter fields using the mouse in various browsers -->
                <input type="text" value="2018" id="adyen-encrypted-form-expiry-year" maxlength="4" size="4" autocomplete="off" data-encrypted-name="expiryYear" />
            </div>

            <input type="hidden" id="adyen-encrypted-form-expiry-generationtime" value="generate-this-server-side" data-encrypted-name="generationtime" />
            <input type="submit" value="Submit" />
        </fieldset>
    </form>
        

        <!-- How to use the Adyen encryption client-side JS library -->
        <!-- N.B. Make sure the library is *NOT* loaded in the "head" of the HTML document -->
        <script type="text/javascript" src="js/adyen.encrypt.min.js?0_1_18"></script>
        <!-- <script type="text/javascript" src="js/addOns/adyen.cardtype.min.js?0_1_18"></script>--> 
        
        <script type="text/javascript">
            
            // generate time client side for testing only... Don't deploy on a
            // real integration!!!
            document.getElementById('adyen-encrypted-form-expiry-generationtime').value = new Date().toISOString();
        
            // the form element to encrypt
            var form    = document.getElementById('adyen-encrypted-form');
            
            // the public key
            var key     =   "10001|9DED9E0DF79B72406450C5830681F47806838D99FCCFB9ABC6AFC8A25D71C2598F9BCF2B033D006DE5450299EE5A5949C4B22F41383BAC46D3DA7202BE3E5849B5FF44DC4314F1550C423B32A390AA76478476E2C0162A2B5BDBC0FB0AF12C232B2C76805A8DE70A56913A8F6A19D038D459C9709B57E9389783167EDDFD81E8B20B9373F8A7583A468E872656BC8CBF2446110A93538DB222BA6A5043F8F9262D7E8B91FAE818572FDB217E4E139B01029C319F2EDBB118EC0718ED1290BF5134056485D684B27177DA9BFEB5886E1F5B455543AA246D06D33E81CAAE7173B024CEB35F7967EC0303609D8A12739BAF24BCA22CC4682847BD1FD614659095E3"; 
 
            var options = {};
            
            // Enable basic field validation (default is true)
            // The submit button will be disabled when fields
            // proof to be invalid. The form submission will be
            // prevented as well.
            // options.enableValidations = true;
            
            
            // Always have the submit button enabled (default is false)
            // Leave the submit button enabled, even in case
            // of validation errors.
            // options.submitButtonAlwaysEnabled = false;
            
            // Ignore non-numeric characters in the card number field (default
            // is true)
            // The payment handling ignores non-numeric characters for the card
            // field.
            // By default non-numeric characters will also be ignored while
            // validating
            // the card number field. This can be disabled for UX reasons.
            // options.numberIgnoreNonNumeric = true;
            
            // Ignore CVC validations for certain bins. Supply a comma separated
            // list.
            // options.cvcIgnoreBins = '6703'; // Ignore CVC for BCMC
            
            // Use 4digit cvc for certain bins. Supply a comma separated list.
            // options.fourDigitCvcForBins = '34,37'; // Set 4 digit CVC for Amex
            
            
            // Use a different attribute to identify adyen fields
            // Note that the attributes needs to start with data-.
            // options.fieldNameAttribute = 'data-encrypted-name';
            
            // Set a element that should display the card type
            options.cardTypeElement = document.getElementById('cardType');
            
            // the form will be encrypted before it is submitted
            var encryptedForm = adyen.encrypt.createEncryptedForm( form, key, options);
            
            // encryptedForm.addCardTypeDetection(options.cardTypeElement)
            
            
        </script>
    </body>
</html>