<html>
<!-- <pre> -->
<head>

<!-- Visa Checkout JavaScript function -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
function onVisaCheckoutReady() {


  V.init( {
    apikey: "42TD3SKIK62N6C89LDSD13W2kI9qtngtWRF6IWeQme5yvNpuQ",
  
    settings: {
      logoUrl: "http://demo.visacheckout.com/presidio/wp-content/uploads/2014/09/logo.png"
    },
      paymentRequest:{
      currencyCode: "USD",
      total: "10.00"
    }
  });
  V.on("payment.success", function(payment) {
    // document.write(JSON.stringify(payment));

    $.ajax({
        type: 'POST',
        url: 'Decrypt.php',
        data: {json: JSON.stringify(payment)},
        dataType: 'json',
        success: function(data){
          // var response = JSON.stringify(data);
          document.write(data);
          alert("Successful callback");
        },
        error: function() {
          console.log('Cannot retrieve data.');
      }
    })
  
    });

  V.on("payment.cancel", function(payment)
  {alert(JSON.stringify(payment)); });
  V.on("payment.error", function(payment, error)
  {alert(JSON.stringify(error)); });
}	


</script>

</head>
<!-- </pre> -->
<body>
<!-- Visa Checkout button img tag -->
<img class="v-button" role="button" tabindex="0" src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png" alt="Visa Checkout" />
<!-- Visa Checkout SDK -->
<script src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js" type="text/javascript"></script>
</body>
</html>



