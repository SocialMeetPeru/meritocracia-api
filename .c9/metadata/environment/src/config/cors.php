{"changed":true,"filter":false,"title":"cors.php","tooltip":"/src/config/cors.php","value":"<?php\n\nheader('Access-Control-Allow-Origin: *');\nheader(\"Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method\");\nheader(\"Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE\");\nheader(\"Allow: GET, POST, OPTIONS, PUT, DELETE\");\n$method = $_SERVER['REQUEST_METHOD'];\nif($method == \"OPTIONS\") {\n  die();\n}\n\n?>","undoManager":{"mark":-2,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":11,"column":2},"action":"insert","lines":["<?php","","header('Access-Control-Allow-Origin: *');","header(\"Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method\");","header(\"Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE\");","header(\"Allow: GET, POST, OPTIONS, PUT, DELETE\");","$method = $_SERVER['REQUEST_METHOD'];","if($method == \"OPTIONS\") {","  die();","}","","?>"],"id":1}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":5,"column":49},"end":{"row":5,"column":49},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1585023537836}