<?php
require_once "method.php";
$obj = new Mahasiswa();
$method = $_SERVER["REQUEST_METHOD"];

switch($method) {
    case 'GET':
        $id = $_GET['id'] ?? 0;
        $obj->get_mahasiswa($id);
        break;

    case 'POST':
        if (!empty($_GET['id'])) {
            $obj->update_mahasiswa($_GET['id']);
        } else {
            $obj->insert_mahasiswa();
        }
        break;

    case 'DELETE':
        $obj->delete_mahasiswa($_GET['id']);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
?>
