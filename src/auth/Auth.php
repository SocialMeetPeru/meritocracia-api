<?php

// Add Composer
require_once "../../vendor/autoload.php";

// CORS
require_once "../config/cors.php";

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

if ($f == 'check'){
    $Auth = new Auth();
    echo $Auth->Check();
}


class Auth
{
    public function Check(){
        global $conn, $post;
        $token = $post['token'];
        $key = 'my_secret_key';
        // eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1ODUyNDIzNDEsImV4cCI6MTU4NTI0NTk0MSwiZGF0YSI6eyJpZCI6MSwibmFtZSI6IkVkdWFyZG8ifX0.E50C4ugU4GTfXNZGxG_P-H_p0i4jstnUsrV4Kn11U_4
        $data = JWT::decode($token, $key, array('HS256'));
        
        // if($data->aud !== null){
        //     return 'Invalid user logged in.';    
        // }else{
        //     return 'valid';
        // }
        
        return json_encode($data);
        
        
    }
    
    public function Login(){
        global $conn, $post;

        // Consulta dato Bd
        $queryUser = $conn->query("select count(id) cantidad from users where email = '{$post['login']['email']}' and
                                            password = '{$post['login']['password']}'")->fetch_array(MYSQLI_ASSOC);

        // Si solo hay un usuario existe
        if ($queryUser['cantidad'] == 1){
            $user = $conn->query("select * from users where email = '{$post['login']['email']}' and
                                            password = '{$post['login']['password']}'")->fetch_array(MYSQLI_ASSOC);
            // print_r($user);
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
            $auth = 'ok';
            $error = '';
        }else{
            $jwt = '';
            $auth = 'no';
            $error = 'El usuario o contrasenia no son correctos';
        }


        $array = [
            'token' =>  $jwt,
            'auth'  =>  $auth,
            'error' =>  $error
        ];

        return json_encode($array);
    }
}