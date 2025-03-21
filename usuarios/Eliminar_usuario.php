<?php
session_start();
include_once 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['txtId'];

    if (!is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
        exit;
    }

    $usuario = new Usuario();
    $usuario->id = $id;

    if ($usuario->eliminar()) {
        echo json_encode(['success' => true, 'message' => 'Usuario eliminado con éxito.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Hubo un error al eliminar el usuario.']);
    }
}
?>
