<?php

// Add Composer
require_once "../../vendor/autoload.php";

// Add BD Connect
require_once "../config/conn.php";

// Import library json
use \Firebase\JWT\JWT;

// Recibe variable
$f = $_GET['f'];

// Recoge por POST los datos
$post = json_decode(file_get_contents("php://input"), true);

// Filtro de la funcion a ejecutar
if ($f == 'login'){
    $Auth = new Auth();
    echo $Auth->Login();
}


class Auth
{
    public function Login(){
        global $conn, $post;

        // Consulta dato Bd
        $queryUser = $conn->query("select count(id) cantidad from users")->fetch_array(MYSQLI_ASSOC);

        // Si solo hay un usuario existe
        if ($queryUser['cantidad'] == 1){
            $user = $conn->query("select * from users where email = '{$post['login']['email']}' and
                                            password = '{$post['login']['password']}'")->fetch_array(MYSQLI_ASSOC);
            $time = time();
            $key = 'my_secret_key';
            $token = array(
                'iat' => $time, // Tiempo que inició el token
                'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
                'data' => [ // información del usuario
                    'id' => 1,
                    'name' => 'Eduardo'
                ]
            );
            $jwt = JWT::encode($token, $key);
        }else{
            $jwt = '';
        }


        $array = [
            'token' =>  $jwt,
        ];

        return json_encode($array);
    }
}
