<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "agendadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// lee el Json
$data = json_decode(file_get_contents("php://input"));

$correo = $data->correo;
$contrasena = $data->contrasena;

$sql = "SELECT * FROM usuario WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verifica contraseña
    if (password_verify($contrasena, $user['contrasena'])) {
        // revisa si es admin
        if ($user['id'] >= 1 && $user['id'] <= 10) {
            echo json_encode(["success" => true, "redirect" => "alta.html"]);
        } else {
            echo json_encode(["success" => true, "redirect" => "alta2.html"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Contraseña incorrecta"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
}

$conn->close();
?>
