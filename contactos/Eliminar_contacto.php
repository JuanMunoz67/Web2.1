<?php
include_once("contacto.php");

$id = $_POST['txtId'];
$contacto = new Contacto();
$contacto->id = $id;

if ($contacto->eliminar()) {
    echo json_encode(['success' => true, 'message' => 'Contacto eliminado exitosamente.']);
} else {
    echo json_encode(['error' => false, 'message' => 'Error al eliminar el contacto.']);
}
?>
