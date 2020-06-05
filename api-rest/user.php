<?php

function methodNotAllowed()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    return array('msj' => 'Method not allowed');
}


$data = [
    array('id' => 1, 'username' => "user1",),
    array('id' => 2, 'username' => "user2",),
    array('id' => 3, 'username' => "user3",)
];

$response = [];

header("Content-Type: application/json; charset=UTF-8");

$requestMethod = $_SERVER["REQUEST_METHOD"];

$id = null;

switch ($requestMethod) {
    case 'GET':
        $arrayUri = explode('/', $_SERVER['REQUEST_URI']);
        // search uri id
        if (is_numeric(end($arrayUri))) {
            $found =  false;
            $id = array_pop($arrayUri);
            // search $id into list
            foreach ($data as $d) {
                if ($d['id'] == $id) {
                    $response = $d;
                    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK", true, 200);
                    $found = true;
                    break;
                }
            }
            // $id not found into list
            if (!$found) {
                $response = array('msg' => 'elemento no encontado');
                header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
            }
        }
        // return list
        else {
            $response = $data;
        }
        break;
    case 'POST':
        if (isset($_POST['username'])) {
            $response = array('id' => 4, 'username' => $_POST['username']);
            header($_SERVER["SERVER_PROTOCOL"] . " 201 Created", true, 201);
        } else {
            $response = array('username' => 'Este campo es obligatorio');
            header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
        }
        break;
    case 'PUT':
        $response = methodNotAllowed();
        break;
    case 'PATCH':
        $response = methodNotAllowed();
        break;
    case 'DELETE':
        $response = methodNotAllowed();
        break;
    default:
        break;
}

echo json_encode($response);
