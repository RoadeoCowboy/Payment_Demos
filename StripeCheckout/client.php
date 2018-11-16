<!DOCTYPE html>
<html>
<head>

</head>

<body>
<?php require_once('./config.php'); ?>

<form action="server.php" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['publishable_key']; ?>"
    data-amount="999"
    data-name="David's Payment Shack"
    data-description="Widget"
    data-zip-code="true"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto">
  </script>
</form>

</body>

<script>

</script>

</html>