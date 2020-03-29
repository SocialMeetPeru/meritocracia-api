<?php

// CORS
require_once "../config/cors.php";


// Recibe variable
$f = $_GET['f'];


if ($f == 'retorna') {
  $Auth = new Demo();
  $Auth->Retorna();
}


class Demo
{
  public function Retorna(){
//    $headers = apache_request_headers();
//    echo $headers['Authorization'];
    try {
//      echo $_SERVER['HTTP_AUTHORIZATION'];
    } catch (Exception $e){

    }

  }
}

?>
