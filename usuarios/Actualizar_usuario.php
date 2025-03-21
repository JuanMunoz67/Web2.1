<?php
session_start();
include_once 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['txtId'];
    $campo = $_POST['campo'];
    $valor = $_POST['txtValor'];

    if (!is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
        exit;
    }

    $allowedFields = ["nombres", "correo", "contrasena"];
    if (!in_array($campo, $allowedFields)) {
        echo json_encode(['success' => false, 'message' => 'Campo no permitido.']);
        exit;
    }

    if ($campo === 'contrasena') {
        $valor = password_hash($valor, PASSWORD_DEFAULT);
    }

    $usuario = new Usuario();
    $usuario->id = $id;

    if ($usuario->actualizar($campo, $valor)) {
        echo json_encode(['success' => true, 'message' => 'Usuario actualizado con éxito.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario.']);
    }
}
?>
