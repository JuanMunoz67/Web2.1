<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agendadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"));

$nombres = $data->nombres;
$correo = $data->correo;
$contrasena = password_hash($data->contrasena, PASSWORD_DEFAULT); // Hash the password
$role = $data->role;

// crea el id para los usuarios
$id = 0;

if ($role == 'admin') {
    // si es admin, se le asigna un numero del 1 al 10
    $result = $conn->query("SELECT id FROM usuario WHERE id BETWEEN 1 AND 10 ORDER BY id DESC LIMIT 1");
    if ($result->num_rows > 0) {
        $lastAdmin = $result->fetch_assoc();
        $id = $lastAdmin['id'] + 1;
    } else {
        $id = 1;
    }
} else {
    // usuarios de consulta comienzan en 100
    $result = $conn->query("SELECT id FROM usuario WHERE id >= 100 ORDER BY id DESC LIMIT 1");
    if ($result->num_rows > 0) {
        $lastUser = $result->fetch_assoc();
        $id = $lastUser['id'] + 1;
    } else {
        $id = 100;
    }
}

$sql = "INSERT INTO usuario (id, nombres, correo, contrasena) VALUES ('$id', '$nombres', '$correo', '$contrasena')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Registro exitoso"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al registrar: " . $conn->error]);
}

$conn->close();
?>
