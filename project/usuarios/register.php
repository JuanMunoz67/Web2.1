<?php
include 'Usuario.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['nombres']) || !isset($data['correo']) || !isset($data['contrasena']) || !isset($data['role'])) {
    echo json_encode(["error" => true, "message" => "Datos incompletos"]);
    exit;
}

$nombres = $data['nombres'];
$correo = $data['correo'];
$contrasena = password_hash($data['contrasena'], PASSWORD_DEFAULT);
$role = $data['role'];

$usuario = new Usuario();

// Verificar si el correo ya existe
$sql_check = "SELECT COUNT(*) FROM usuario WHERE correo = :correo";
$stmt_check = $usuario->conn->prepare($sql_check);
$stmt_check->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt_check->execute();

if ($stmt_check->fetchColumn() > 0) {
    echo json_encode(["error" => true, "message" => "El correo ya está registrado"]);
    exit;
}

// Validar clave de admin
if ($role == "admin") {
    if (!isset($data['adminKey']) || $data['adminKey'] !== "1234") {
        echo json_encode(["error" => true, "message" => "Clave de administrador incorrecta"]);
        exit;
    }
    $id_range = "BETWEEN 1 AND 10"; // IDs para administradores
} else {
    $id_range = ">= 100"; // IDs para usuarios comunes
}

$sql = "INSERT INTO usuario (id, nombres, correo, contrasena) 
        SELECT COALESCE(MAX(id), 0) + 1, :nombres, :correo, :contrasena 
        FROM usuario WHERE id $id_range";

$stmt = $usuario->conn->prepare($sql);
$stmt->bindParam(':nombres', $nombres, PDO::PARAM_STR);
$stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registro exitoso"]);
} else {
    echo json_encode(["error" => true, "message" => "Error al registrar"]);
}
?>