<?php
require '../wepay.php';
Wepay::useStaging('98172', '780f9630a5');
header('Content-Type: text/html; charset=utf-8');
session_start();
