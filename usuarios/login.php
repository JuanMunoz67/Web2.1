<?php
include_once 'Usuario.php';

$data = json_decode(file_get_contents("php://input"), true);
$correo = $data['correo'];
$contrasena = $data['contrasena'];

$usuario = new Usuario();
$sql = "SELECT * FROM usuario WHERE correo = :correo";
$stmt = $usuario->conn->prepare($sql);
$stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    if (password_verify($contrasena, $row['contrasena'])) {
        // redirigir a la página correcta
        $redirect = ($row['id'] <= 10) ? "alta.html" : "alta2.html";
        echo json_encode(["success" => true, "redirect" => $redirect]);
    } else {
        echo json_encode(["success" => false, "message" => "Contraseña incorrecta"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
}
?>
