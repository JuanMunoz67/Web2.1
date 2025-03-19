<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["txtId"];
    $campo = $_POST["campo"];
    $valor = $_POST["txtValor"];

    include_once("contacto.php");

    $contacto = new Contacto();
    $contacto->id = $id;

    if ($contacto->actualizar($campo, $valor)) {
        echo "El campo '$campo' se actualizó correctamente.";
    } else {
        echo "Error al actualizar el campo.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
