<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_jhhU3kVsIRRb81QiOyBvTYzY",
  "publishable_key" => "pk_test_4qYg9CwD7gbCGyPPjYrwJSuJ",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>