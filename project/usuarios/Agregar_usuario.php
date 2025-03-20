<?php
session_start();
include_once 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['txtNombres'];
    $correo = $_POST['txtCorreo'];
    $contrasena = password_hash($_POST['txtContrasena'], PASSWORD_DEFAULT);

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'El correo ingresado no es válido.']);
        exit;
    }

    $usuario = new Usuario();
    $usuario->nombres = $nombres;
    $usuario->correo = $correo;
    $usuario->contrasena = $contrasena;

    if ($usuario->alta()) {
        echo json_encode(['success' => true, 'message' => 'Usuario agregado con éxito.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Hubo un error al agregar el usuario.']);
    }
}
?>
