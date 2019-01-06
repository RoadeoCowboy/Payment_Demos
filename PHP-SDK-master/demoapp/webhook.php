<?php

# Get JSON as a string
$json_str = file_get_contents('php://input');

error_log($json_str);

# Get as an object
$json_obj = json_decode($json_str);

?>