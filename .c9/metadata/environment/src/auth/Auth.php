{"changed":true,"filter":false,"title":"Auth.php","tooltip":"/src/auth/Auth.php","value":"<?php\n\n// Add Composer\nrequire_once \"../../vendor/autoload.php\";\n\n// CORS\nrequire_once \"../config/cors.php\";\n\n// Add BD Connect\nrequire_once \"../config/conn.php\";\n\n// Import library json\nuse \\Firebase\\JWT\\JWT;\n\n// Recibe variable\n$f = $_GET['f'];\n\n// Recoge por POST los datos\n$post = json_decode(file_get_contents(\"php://input\"), true);\n\n// Filtro de la funcion a ejecutar\nif ($f == 'login'){\n    $Auth = new Auth();\n    echo $Auth->Login();\n}\n\nif ($f == 'check'){\n    $Auth = new Auth();\n    echo $Auth->Check();\n}\n\n\nclass Auth\n{\n    public function Check(){\n        global $conn, $post;\n        $token = $post['token'];\n        $key = 'my_secret_key';\n        // eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1ODUyNDIzNDEsImV4cCI6MTU4NTI0NTk0MSwiZGF0YSI6eyJpZCI6MSwibmFtZSI6IkVkdWFyZG8ifX0.E50C4ugU4GTfXNZGxG_P-H_p0i4jstnUsrV4Kn11U_4\n        $data = JWT::decode($token, $key, array('HS256'));\n        \n        // if($data->aud !== null){\n        //     return 'Invalid user logged in.';    \n        // }else{\n        //     return 'valid';\n        // }\n        \n        return json_encode($data);\n        \n        \n    }\n    \n    public function Login(){\n        global $conn, $post;\n\n        // Consulta dato Bd\n        $queryUser = $conn->query(\"select count(id) cantidad from users where email = '{$post['login']['email']}' and\n                                            password = '{$post['login']['password']}'\")->fetch_array(MYSQLI_ASSOC);\n\n        // Si solo hay un usuario existe\n        if ($queryUser['cantidad'] == 1){\n            $user = $conn->query(\"select * from users where email = '{$post['login']['email']}' and\n                                            password = '{$post['login']['password']}'\")->fetch_array(MYSQLI_ASSOC);\n            // print_r($user);\n            $time = time();\n            $key = 'my_secret_key';\n            $token = array(\n                'iat' => $time, // Tiempo que inició el token\n                'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)\n                'data' => [ // información del usuario\n                    'id' => 1,\n                    'name' => 'Eduardo'\n                ]\n            );\n            $jwt = JWT::encode($token, $key);\n            $auth = 'ok';\n            $error = '';\n        }else{\n            $jwt = '';\n            $auth = 'no';\n            $error = 'El usuario o contrasenia no son correctos';\n        }\n\n\n        $array = [\n            'token' =>  $jwt,\n            'auth'  =>  $auth,\n            'error' =>  $error\n        ];\n\n        return json_encode($array);\n    }\n}","undoManager":{"mark":99,"position":100,"stack":[[{"start":{"row":35,"column":4},"end":{"row":35,"column":8},"action":"insert","lines":["    "],"id":130}],[{"start":{"row":35,"column":12},"end":{"row":35,"column":32},"action":"insert","lines":["global $conn, $post;"],"id":131}],[{"start":{"row":35,"column":8},"end":{"row":35,"column":12},"action":"remove","lines":["    "],"id":132}],[{"start":{"row":35,"column":28},"end":{"row":36,"column":0},"action":"insert","lines":["",""],"id":133},{"start":{"row":36,"column":0},"end":{"row":36,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":35,"column":28},"end":{"row":36,"column":0},"action":"insert","lines":["",""],"id":134},{"start":{"row":36,"column":0},"end":{"row":36,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":36,"column":8},"end":{"row":36,"column":9},"action":"insert","lines":["$"],"id":135},{"start":{"row":36,"column":9},"end":{"row":36,"column":10},"action":"insert","lines":["t"]},{"start":{"row":36,"column":10},"end":{"row":36,"column":11},"action":"insert","lines":["o"]},{"start":{"row":36,"column":11},"end":{"row":36,"column":12},"action":"insert","lines":["k"]},{"start":{"row":36,"column":12},"end":{"row":36,"column":13},"action":"insert","lines":["e"]},{"start":{"row":36,"column":13},"end":{"row":36,"column":14},"action":"insert","lines":["n"]}],[{"start":{"row":36,"column":14},"end":{"row":36,"column":15},"action":"insert","lines":[" "],"id":136},{"start":{"row":36,"column":15},"end":{"row":36,"column":16},"action":"insert","lines":["="]}],[{"start":{"row":36,"column":16},"end":{"row":36,"column":17},"action":"insert","lines":[" "],"id":137}],[{"start":{"row":36,"column":17},"end":{"row":36,"column":18},"action":"insert","lines":["$"],"id":138},{"start":{"row":36,"column":18},"end":{"row":36,"column":19},"action":"insert","lines":["p"]},{"start":{"row":36,"column":19},"end":{"row":36,"column":20},"action":"insert","lines":["o"]},{"start":{"row":36,"column":20},"end":{"row":36,"column":21},"action":"insert","lines":["s"]},{"start":{"row":36,"column":21},"end":{"row":36,"column":22},"action":"insert","lines":["t"]}],[{"start":{"row":36,"column":22},"end":{"row":36,"column":24},"action":"insert","lines":["[]"],"id":139}],[{"start":{"row":36,"column":23},"end":{"row":36,"column":25},"action":"insert","lines":["''"],"id":140}],[{"start":{"row":36,"column":24},"end":{"row":36,"column":25},"action":"insert","lines":["t"],"id":141},{"start":{"row":36,"column":25},"end":{"row":36,"column":26},"action":"insert","lines":["o"]},{"start":{"row":36,"column":26},"end":{"row":36,"column":27},"action":"insert","lines":["k"]},{"start":{"row":36,"column":27},"end":{"row":36,"column":28},"action":"insert","lines":["e"]},{"start":{"row":36,"column":28},"end":{"row":36,"column":29},"action":"insert","lines":["n"]}],[{"start":{"row":36,"column":29},"end":{"row":36,"column":30},"action":"remove","lines":["'"],"id":142}],[{"start":{"row":36,"column":29},"end":{"row":36,"column":30},"action":"insert","lines":["'"],"id":143}],[{"start":{"row":36,"column":31},"end":{"row":36,"column":32},"action":"insert","lines":[";"],"id":144}],[{"start":{"row":36,"column":32},"end":{"row":37,"column":0},"action":"insert","lines":["",""],"id":145},{"start":{"row":37,"column":0},"end":{"row":37,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":37,"column":8},"end":{"row":37,"column":180},"action":"insert","lines":["eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1ODUyNDIzNDEsImV4cCI6MTU4NTI0NTk0MSwiZGF0YSI6eyJpZCI6MSwibmFtZSI6IkVkdWFyZG8ifX0.E50C4ugU4GTfXNZGxG_P-H_p0i4jstnUsrV4Kn11U_4"],"id":146}],[{"start":{"row":37,"column":180},"end":{"row":38,"column":0},"action":"insert","lines":["",""],"id":147},{"start":{"row":38,"column":0},"end":{"row":38,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":38,"column":8},"end":{"row":38,"column":56},"action":"insert","lines":["$data = JWT::decode($jwt, $key, array('HS256'));"],"id":148}],[{"start":{"row":36,"column":32},"end":{"row":37,"column":0},"action":"insert","lines":["",""],"id":149},{"start":{"row":37,"column":0},"end":{"row":37,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":37,"column":8},"end":{"row":37,"column":31},"action":"insert","lines":["$key = 'my_secret_key';"],"id":150}],[{"start":{"row":38,"column":8},"end":{"row":38,"column":11},"action":"insert","lines":["// "],"id":151}],[{"start":{"row":39,"column":31},"end":{"row":39,"column":32},"action":"remove","lines":["t"],"id":152},{"start":{"row":39,"column":30},"end":{"row":39,"column":31},"action":"remove","lines":["w"]},{"start":{"row":39,"column":29},"end":{"row":39,"column":30},"action":"remove","lines":["j"]}],[{"start":{"row":39,"column":29},"end":{"row":39,"column":30},"action":"insert","lines":["t"],"id":153},{"start":{"row":39,"column":30},"end":{"row":39,"column":31},"action":"insert","lines":["o"]},{"start":{"row":39,"column":31},"end":{"row":39,"column":32},"action":"insert","lines":["k"]},{"start":{"row":39,"column":32},"end":{"row":39,"column":33},"action":"insert","lines":["e"]},{"start":{"row":39,"column":33},"end":{"row":39,"column":34},"action":"insert","lines":["n"]}],[{"start":{"row":39,"column":58},"end":{"row":40,"column":0},"action":"insert","lines":["",""],"id":154},{"start":{"row":40,"column":0},"end":{"row":40,"column":8},"action":"insert","lines":["        "]},{"start":{"row":40,"column":8},"end":{"row":40,"column":9},"action":"insert","lines":["r"]},{"start":{"row":40,"column":9},"end":{"row":40,"column":10},"action":"insert","lines":["e"]},{"start":{"row":40,"column":10},"end":{"row":40,"column":11},"action":"insert","lines":["t"]},{"start":{"row":40,"column":11},"end":{"row":40,"column":12},"action":"insert","lines":["u"]},{"start":{"row":40,"column":12},"end":{"row":40,"column":13},"action":"insert","lines":["r"]}],[{"start":{"row":40,"column":13},"end":{"row":40,"column":14},"action":"insert","lines":["n"],"id":155}],[{"start":{"row":40,"column":14},"end":{"row":40,"column":15},"action":"insert","lines":[" "],"id":156},{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"insert","lines":["$"]},{"start":{"row":40,"column":16},"end":{"row":40,"column":17},"action":"insert","lines":["d"]},{"start":{"row":40,"column":17},"end":{"row":40,"column":18},"action":"insert","lines":["a"]},{"start":{"row":40,"column":18},"end":{"row":40,"column":19},"action":"insert","lines":["t"]},{"start":{"row":40,"column":19},"end":{"row":40,"column":20},"action":"insert","lines":["a"]}],[{"start":{"row":40,"column":20},"end":{"row":40,"column":21},"action":"insert","lines":[";"],"id":157}],[{"start":{"row":39,"column":36},"end":{"row":39,"column":40},"action":"remove","lines":["$key"],"id":158},{"start":{"row":39,"column":36},"end":{"row":39,"column":37},"action":"insert","lines":[":"]}],[{"start":{"row":39,"column":36},"end":{"row":39,"column":37},"action":"remove","lines":[":"],"id":159}],[{"start":{"row":39,"column":36},"end":{"row":39,"column":38},"action":"insert","lines":["\"\""],"id":160}],[{"start":{"row":39,"column":37},"end":{"row":39,"column":38},"action":"insert","lines":["o"],"id":161},{"start":{"row":39,"column":38},"end":{"row":39,"column":39},"action":"insert","lines":["t"]},{"start":{"row":39,"column":39},"end":{"row":39,"column":40},"action":"insert","lines":["r"]},{"start":{"row":39,"column":40},"end":{"row":39,"column":41},"action":"insert","lines":["o"]}],[{"start":{"row":39,"column":55},"end":{"row":39,"column":56},"action":"insert","lines":["Ω"],"id":162},{"start":{"row":39,"column":56},"end":{"row":39,"column":57},"action":"insert","lines":["Ω"]},{"start":{"row":39,"column":57},"end":{"row":39,"column":58},"action":"insert","lines":["Ω"]}],[{"start":{"row":39,"column":57},"end":{"row":39,"column":58},"action":"remove","lines":["Ω"],"id":163},{"start":{"row":39,"column":56},"end":{"row":39,"column":57},"action":"remove","lines":["Ω"]},{"start":{"row":39,"column":55},"end":{"row":39,"column":56},"action":"remove","lines":["Ω"]}],[{"start":{"row":39,"column":36},"end":{"row":39,"column":42},"action":"remove","lines":["\"otro\""],"id":164},{"start":{"row":39,"column":36},"end":{"row":39,"column":40},"action":"insert","lines":["$key"]}],[{"start":{"row":37,"column":8},"end":{"row":37,"column":11},"action":"insert","lines":["// "],"id":165}],[{"start":{"row":39,"column":8},"end":{"row":39,"column":11},"action":"insert","lines":["// "],"id":166}],[{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"remove","lines":["$"],"id":167},{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"remove","lines":["d"]},{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"remove","lines":["a"]},{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"remove","lines":["t"]},{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"remove","lines":["a"]}],[{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"insert","lines":["$"],"id":168},{"start":{"row":40,"column":16},"end":{"row":40,"column":17},"action":"insert","lines":["t"]},{"start":{"row":40,"column":17},"end":{"row":40,"column":18},"action":"insert","lines":["o"]},{"start":{"row":40,"column":18},"end":{"row":40,"column":19},"action":"insert","lines":["k"]},{"start":{"row":40,"column":19},"end":{"row":40,"column":20},"action":"insert","lines":["e"]},{"start":{"row":40,"column":20},"end":{"row":40,"column":21},"action":"insert","lines":["n"]}],[{"start":{"row":39,"column":8},"end":{"row":39,"column":11},"action":"remove","lines":["// "],"id":169}],[{"start":{"row":39,"column":58},"end":{"row":40,"column":0},"action":"insert","lines":["",""],"id":170},{"start":{"row":40,"column":0},"end":{"row":40,"column":8},"action":"insert","lines":["        "]},{"start":{"row":40,"column":8},"end":{"row":40,"column":9},"action":"insert","lines":["i"]},{"start":{"row":40,"column":9},"end":{"row":40,"column":10},"action":"insert","lines":["f"]}],[{"start":{"row":40,"column":10},"end":{"row":40,"column":12},"action":"insert","lines":["()"],"id":171}],[{"start":{"row":40,"column":11},"end":{"row":40,"column":12},"action":"insert","lines":["$"],"id":172},{"start":{"row":40,"column":12},"end":{"row":40,"column":13},"action":"insert","lines":["d"]},{"start":{"row":40,"column":13},"end":{"row":40,"column":14},"action":"insert","lines":["a"]},{"start":{"row":40,"column":14},"end":{"row":40,"column":15},"action":"insert","lines":["t"]},{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"insert","lines":["a"]},{"start":{"row":40,"column":16},"end":{"row":40,"column":17},"action":"insert","lines":["-"]}],[{"start":{"row":40,"column":17},"end":{"row":40,"column":22},"action":"insert","lines":["->aud"],"id":173}],[{"start":{"row":40,"column":17},"end":{"row":40,"column":18},"action":"remove","lines":["-"],"id":174}],[{"start":{"row":40,"column":21},"end":{"row":40,"column":22},"action":"insert","lines":[" "],"id":175},{"start":{"row":40,"column":22},"end":{"row":40,"column":23},"action":"insert","lines":["!"]},{"start":{"row":40,"column":23},"end":{"row":40,"column":24},"action":"insert","lines":["="]},{"start":{"row":40,"column":24},"end":{"row":40,"column":25},"action":"insert","lines":["="]}],[{"start":{"row":40,"column":25},"end":{"row":40,"column":26},"action":"insert","lines":[" "],"id":176},{"start":{"row":40,"column":26},"end":{"row":40,"column":27},"action":"insert","lines":["n"]},{"start":{"row":40,"column":27},"end":{"row":40,"column":28},"action":"insert","lines":["u"]},{"start":{"row":40,"column":28},"end":{"row":40,"column":29},"action":"insert","lines":["l"]},{"start":{"row":40,"column":29},"end":{"row":40,"column":30},"action":"insert","lines":["l"]}],[{"start":{"row":40,"column":31},"end":{"row":40,"column":32},"action":"insert","lines":["{"],"id":177},{"start":{"row":40,"column":32},"end":{"row":40,"column":33},"action":"insert","lines":["}"]}],[{"start":{"row":40,"column":32},"end":{"row":42,"column":8},"action":"insert","lines":["","            ","        "],"id":178}],[{"start":{"row":39,"column":58},"end":{"row":40,"column":0},"action":"insert","lines":["",""],"id":179},{"start":{"row":40,"column":0},"end":{"row":40,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":43,"column":9},"end":{"row":43,"column":10},"action":"insert","lines":["e"],"id":180},{"start":{"row":43,"column":10},"end":{"row":43,"column":11},"action":"insert","lines":["l"]},{"start":{"row":43,"column":11},"end":{"row":43,"column":12},"action":"insert","lines":["s"]},{"start":{"row":43,"column":12},"end":{"row":43,"column":13},"action":"insert","lines":["e"]},{"start":{"row":43,"column":13},"end":{"row":43,"column":14},"action":"insert","lines":["{"]},{"start":{"row":43,"column":14},"end":{"row":43,"column":15},"action":"insert","lines":["}"]}],[{"start":{"row":43,"column":14},"end":{"row":45,"column":8},"action":"insert","lines":["","            ","        "],"id":181}],[{"start":{"row":46,"column":8},"end":{"row":46,"column":22},"action":"remove","lines":["return $token;"],"id":182}],[{"start":{"row":42,"column":8},"end":{"row":42,"column":12},"action":"insert","lines":["    "],"id":183}],[{"start":{"row":42,"column":12},"end":{"row":42,"column":26},"action":"insert","lines":["return $token;"],"id":184}],[{"start":{"row":42,"column":19},"end":{"row":42,"column":25},"action":"remove","lines":["$token"],"id":185}],[{"start":{"row":42,"column":19},"end":{"row":42,"column":21},"action":"insert","lines":["''"],"id":186}],[{"start":{"row":42,"column":20},"end":{"row":42,"column":43},"action":"insert","lines":["Invalid user logged in."],"id":187}],[{"start":{"row":44,"column":12},"end":{"row":44,"column":13},"action":"insert","lines":["e"],"id":188},{"start":{"row":44,"column":13},"end":{"row":44,"column":14},"action":"insert","lines":["r"]}],[{"start":{"row":44,"column":13},"end":{"row":44,"column":14},"action":"remove","lines":["r"],"id":189},{"start":{"row":44,"column":12},"end":{"row":44,"column":13},"action":"remove","lines":["e"]}],[{"start":{"row":44,"column":12},"end":{"row":44,"column":13},"action":"insert","lines":["r"],"id":190},{"start":{"row":44,"column":13},"end":{"row":44,"column":14},"action":"insert","lines":["e"]},{"start":{"row":44,"column":14},"end":{"row":44,"column":15},"action":"insert","lines":["t"]},{"start":{"row":44,"column":15},"end":{"row":44,"column":16},"action":"insert","lines":["u"]},{"start":{"row":44,"column":16},"end":{"row":44,"column":17},"action":"insert","lines":["r"]},{"start":{"row":44,"column":17},"end":{"row":44,"column":18},"action":"insert","lines":["n"]}],[{"start":{"row":44,"column":18},"end":{"row":44,"column":19},"action":"insert","lines":[" "],"id":191}],[{"start":{"row":44,"column":19},"end":{"row":44,"column":21},"action":"insert","lines":["''"],"id":192}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":43},"action":"insert","lines":["Invalid user logged in."],"id":193}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":27},"action":"remove","lines":["Invalid"],"id":194}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":21},"action":"remove","lines":[" "],"id":195}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":24},"action":"remove","lines":["user"],"id":196}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":21},"action":"remove","lines":[" "],"id":197}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":26},"action":"remove","lines":["logged"],"id":198}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":21},"action":"remove","lines":[" "],"id":199}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":22},"action":"remove","lines":["in"],"id":200}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":21},"action":"remove","lines":["."],"id":201}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":21},"action":"insert","lines":["v"],"id":202},{"start":{"row":44,"column":21},"end":{"row":44,"column":22},"action":"insert","lines":["a"]},{"start":{"row":44,"column":22},"end":{"row":44,"column":23},"action":"insert","lines":["l"]},{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"insert","lines":["i"]},{"start":{"row":44,"column":24},"end":{"row":44,"column":25},"action":"insert","lines":["d"]}],[{"start":{"row":44,"column":26},"end":{"row":44,"column":27},"action":"insert","lines":[";"],"id":203}],[{"start":{"row":45,"column":9},"end":{"row":46,"column":0},"action":"insert","lines":["",""],"id":204},{"start":{"row":46,"column":0},"end":{"row":46,"column":8},"action":"insert","lines":["        "]},{"start":{"row":46,"column":8},"end":{"row":47,"column":0},"action":"insert","lines":["",""]},{"start":{"row":47,"column":0},"end":{"row":47,"column":8},"action":"insert","lines":["        "]},{"start":{"row":47,"column":8},"end":{"row":47,"column":9},"action":"insert","lines":["r"]},{"start":{"row":47,"column":9},"end":{"row":47,"column":10},"action":"insert","lines":["e"]},{"start":{"row":47,"column":10},"end":{"row":47,"column":11},"action":"insert","lines":["t"]},{"start":{"row":47,"column":11},"end":{"row":47,"column":12},"action":"insert","lines":["u"]},{"start":{"row":47,"column":12},"end":{"row":47,"column":13},"action":"insert","lines":["r"]},{"start":{"row":47,"column":13},"end":{"row":47,"column":14},"action":"insert","lines":["n"]}],[{"start":{"row":47,"column":14},"end":{"row":47,"column":15},"action":"insert","lines":[" "],"id":205},{"start":{"row":47,"column":15},"end":{"row":47,"column":16},"action":"insert","lines":["t"]},{"start":{"row":47,"column":16},"end":{"row":47,"column":17},"action":"insert","lines":["o"]},{"start":{"row":47,"column":17},"end":{"row":47,"column":18},"action":"insert","lines":["k"]},{"start":{"row":47,"column":18},"end":{"row":47,"column":19},"action":"insert","lines":["e"]}],[{"start":{"row":47,"column":18},"end":{"row":47,"column":19},"action":"remove","lines":["e"],"id":206},{"start":{"row":47,"column":17},"end":{"row":47,"column":18},"action":"remove","lines":["k"]},{"start":{"row":47,"column":16},"end":{"row":47,"column":17},"action":"remove","lines":["o"]},{"start":{"row":47,"column":15},"end":{"row":47,"column":16},"action":"remove","lines":["t"]}],[{"start":{"row":47,"column":15},"end":{"row":47,"column":16},"action":"insert","lines":["$"],"id":207},{"start":{"row":47,"column":16},"end":{"row":47,"column":17},"action":"insert","lines":["t"]},{"start":{"row":47,"column":17},"end":{"row":47,"column":18},"action":"insert","lines":["o"]},{"start":{"row":47,"column":18},"end":{"row":47,"column":19},"action":"insert","lines":["k"]},{"start":{"row":47,"column":19},"end":{"row":47,"column":20},"action":"insert","lines":["e"]},{"start":{"row":47,"column":20},"end":{"row":47,"column":21},"action":"insert","lines":["n"]},{"start":{"row":47,"column":21},"end":{"row":47,"column":22},"action":"insert","lines":[";"]}],[{"start":{"row":39,"column":8},"end":{"row":39,"column":11},"action":"insert","lines":["// "],"id":208},{"start":{"row":41,"column":8},"end":{"row":41,"column":11},"action":"insert","lines":["// "]},{"start":{"row":42,"column":8},"end":{"row":42,"column":11},"action":"insert","lines":["// "]},{"start":{"row":43,"column":8},"end":{"row":43,"column":11},"action":"insert","lines":["// "]},{"start":{"row":44,"column":8},"end":{"row":44,"column":11},"action":"insert","lines":["// "]},{"start":{"row":45,"column":8},"end":{"row":45,"column":11},"action":"insert","lines":["// "]}],[{"start":{"row":39,"column":8},"end":{"row":39,"column":11},"action":"remove","lines":["// "],"id":209},{"start":{"row":41,"column":8},"end":{"row":41,"column":11},"action":"remove","lines":["// "]},{"start":{"row":42,"column":8},"end":{"row":42,"column":11},"action":"remove","lines":["// "]},{"start":{"row":43,"column":8},"end":{"row":43,"column":11},"action":"remove","lines":["// "]},{"start":{"row":44,"column":8},"end":{"row":44,"column":11},"action":"remove","lines":["// "]},{"start":{"row":45,"column":8},"end":{"row":45,"column":11},"action":"remove","lines":["// "]}],[{"start":{"row":37,"column":8},"end":{"row":37,"column":11},"action":"remove","lines":["// "],"id":210}],[{"start":{"row":47,"column":15},"end":{"row":47,"column":21},"action":"remove","lines":["$token"],"id":211},{"start":{"row":47,"column":15},"end":{"row":47,"column":16},"action":"insert","lines":["$"]},{"start":{"row":47,"column":16},"end":{"row":47,"column":17},"action":"insert","lines":["d"]},{"start":{"row":47,"column":17},"end":{"row":47,"column":18},"action":"insert","lines":["a"]},{"start":{"row":47,"column":18},"end":{"row":47,"column":19},"action":"insert","lines":["t"]},{"start":{"row":47,"column":19},"end":{"row":47,"column":20},"action":"insert","lines":["a"]}],[{"start":{"row":41,"column":8},"end":{"row":41,"column":11},"action":"insert","lines":["// "],"id":212},{"start":{"row":42,"column":8},"end":{"row":42,"column":11},"action":"insert","lines":["// "]},{"start":{"row":43,"column":8},"end":{"row":43,"column":11},"action":"insert","lines":["// "]},{"start":{"row":44,"column":8},"end":{"row":44,"column":11},"action":"insert","lines":["// "]},{"start":{"row":45,"column":8},"end":{"row":45,"column":11},"action":"insert","lines":["// "]}],[{"start":{"row":41,"column":8},"end":{"row":41,"column":11},"action":"remove","lines":["// "],"id":213},{"start":{"row":42,"column":8},"end":{"row":42,"column":11},"action":"remove","lines":["// "]},{"start":{"row":43,"column":8},"end":{"row":43,"column":11},"action":"remove","lines":["// "]},{"start":{"row":44,"column":8},"end":{"row":44,"column":11},"action":"remove","lines":["// "]},{"start":{"row":45,"column":8},"end":{"row":45,"column":11},"action":"remove","lines":["// "]}],[{"start":{"row":47,"column":8},"end":{"row":47,"column":11},"action":"insert","lines":["// "],"id":214}],[{"start":{"row":47,"column":8},"end":{"row":47,"column":24},"action":"remove","lines":["// return $data;"],"id":215}],[{"start":{"row":47,"column":8},"end":{"row":47,"column":9},"action":"insert","lines":["Ω"],"id":216}],[{"start":{"row":47,"column":8},"end":{"row":47,"column":9},"action":"remove","lines":["Ω"],"id":217}],[{"start":{"row":47,"column":8},"end":{"row":47,"column":9},"action":"insert","lines":["r"],"id":218},{"start":{"row":47,"column":9},"end":{"row":47,"column":10},"action":"insert","lines":["e"]},{"start":{"row":47,"column":10},"end":{"row":47,"column":11},"action":"insert","lines":["t"]},{"start":{"row":47,"column":11},"end":{"row":47,"column":12},"action":"insert","lines":["u"]},{"start":{"row":47,"column":12},"end":{"row":47,"column":13},"action":"insert","lines":["r"]},{"start":{"row":47,"column":13},"end":{"row":47,"column":14},"action":"insert","lines":["b"]},{"start":{"row":47,"column":14},"end":{"row":47,"column":15},"action":"insert","lines":["n"]}],[{"start":{"row":47,"column":14},"end":{"row":47,"column":15},"action":"remove","lines":["n"],"id":219},{"start":{"row":47,"column":13},"end":{"row":47,"column":14},"action":"remove","lines":["b"]}],[{"start":{"row":47,"column":13},"end":{"row":47,"column":14},"action":"insert","lines":["n"],"id":220}],[{"start":{"row":47,"column":14},"end":{"row":47,"column":15},"action":"insert","lines":[" "],"id":221},{"start":{"row":47,"column":15},"end":{"row":47,"column":16},"action":"insert","lines":["j"]},{"start":{"row":47,"column":16},"end":{"row":47,"column":17},"action":"insert","lines":["s"]},{"start":{"row":47,"column":17},"end":{"row":47,"column":18},"action":"insert","lines":["o"]},{"start":{"row":47,"column":18},"end":{"row":47,"column":19},"action":"insert","lines":["n"]},{"start":{"row":47,"column":19},"end":{"row":47,"column":20},"action":"insert","lines":["_"]},{"start":{"row":47,"column":20},"end":{"row":47,"column":21},"action":"insert","lines":["e"]},{"start":{"row":47,"column":21},"end":{"row":47,"column":22},"action":"insert","lines":["n"]}],[{"start":{"row":47,"column":22},"end":{"row":47,"column":23},"action":"insert","lines":["c"],"id":222},{"start":{"row":47,"column":23},"end":{"row":47,"column":24},"action":"insert","lines":["o"]},{"start":{"row":47,"column":24},"end":{"row":47,"column":25},"action":"insert","lines":["d"]},{"start":{"row":47,"column":25},"end":{"row":47,"column":26},"action":"insert","lines":["e"]}],[{"start":{"row":47,"column":26},"end":{"row":47,"column":28},"action":"insert","lines":["()"],"id":223}],[{"start":{"row":47,"column":27},"end":{"row":47,"column":28},"action":"insert","lines":["$"],"id":224},{"start":{"row":47,"column":28},"end":{"row":47,"column":29},"action":"insert","lines":["d"]},{"start":{"row":47,"column":29},"end":{"row":47,"column":30},"action":"insert","lines":["a"]},{"start":{"row":47,"column":30},"end":{"row":47,"column":31},"action":"insert","lines":["t"]},{"start":{"row":47,"column":31},"end":{"row":47,"column":32},"action":"insert","lines":["a"]}],[{"start":{"row":41,"column":8},"end":{"row":41,"column":11},"action":"insert","lines":["// "],"id":225},{"start":{"row":42,"column":8},"end":{"row":42,"column":11},"action":"insert","lines":["// "]},{"start":{"row":43,"column":8},"end":{"row":43,"column":11},"action":"insert","lines":["// "]},{"start":{"row":44,"column":8},"end":{"row":44,"column":11},"action":"insert","lines":["// "]},{"start":{"row":45,"column":8},"end":{"row":45,"column":11},"action":"insert","lines":["// "]}],[{"start":{"row":41,"column":8},"end":{"row":41,"column":11},"action":"remove","lines":["// "],"id":226},{"start":{"row":42,"column":8},"end":{"row":42,"column":11},"action":"remove","lines":["// "]},{"start":{"row":43,"column":8},"end":{"row":43,"column":11},"action":"remove","lines":["// "]},{"start":{"row":44,"column":8},"end":{"row":44,"column":11},"action":"remove","lines":["// "]},{"start":{"row":45,"column":8},"end":{"row":45,"column":11},"action":"remove","lines":["// "]}],[{"start":{"row":41,"column":8},"end":{"row":41,"column":11},"action":"insert","lines":["// "],"id":227},{"start":{"row":42,"column":8},"end":{"row":42,"column":11},"action":"insert","lines":["// "]},{"start":{"row":43,"column":8},"end":{"row":43,"column":11},"action":"insert","lines":["// "]},{"start":{"row":44,"column":8},"end":{"row":44,"column":11},"action":"insert","lines":["// "]},{"start":{"row":45,"column":8},"end":{"row":45,"column":11},"action":"insert","lines":["// "]}],[{"start":{"row":47,"column":33},"end":{"row":47,"column":35},"action":"insert","lines":["''"],"id":228}],[{"start":{"row":47,"column":33},"end":{"row":47,"column":35},"action":"remove","lines":["''"],"id":229}],[{"start":{"row":47,"column":33},"end":{"row":47,"column":34},"action":"insert","lines":[";"],"id":230}]]},"ace":{"folds":[],"scrolltop":480,"scrollleft":0,"selection":{"start":{"row":47,"column":34},"end":{"row":47,"column":34},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":29,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1585245995870}