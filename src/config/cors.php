<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
$dirname =  substr($_SERVER['SCRIPT_FILENAME'],0,-1*strlen($_SERVER['SCRIPT_NAME']));
require_once $dirname . '/vendor/autoload.php';

// Import library json
use \Firebase\JWT\JWT;

try {
  $key = 'my_secret_key';
  $data = JWT::decode($_SERVER['HTTP_AUTHORIZATION'], $key, array('HS256'));
} catch (Exception $e) {
  echo "error";
}

?>
