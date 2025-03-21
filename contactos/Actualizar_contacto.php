<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["txtId"];
    $campo = $_POST["campo"];
    $valor = $_POST["txtValor"];

    include_once("contacto.php");

    $contacto = new Contacto();
    $contacto->id = $id;

    if ($contacto->actualizar($campo, $valor)) {
        // Devolvemos una respuesta JSON de éxito
        echo json_encode([
            "success" => true,
            "message" => "El campo '$campo' se actualizó correctamente."
        ]);
    } else {
        // Devolvemos una respuesta JSON de error
        echo json_encode([
            "success" => false,
            "message" => "Error al actualizar el campo."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Acceso no permitido."
    ]);
}
?>
