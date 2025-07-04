<?php
require 'vendor/autoload.php';

use YuF1Dev\OrderKuota;

$email = 'emailkamu@domain.com';      // ← Ganti ini
$password = 'passwordmu';             // ← Ganti ini

$api = new OrderKuota();
$response = $api->loginRequest($email, $password);

echo $response;
