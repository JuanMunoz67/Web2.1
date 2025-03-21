<?php
    // Recibe los datos del formulario
    if (isset($_POST["txtNombres"]) && isset($_POST["txtTel"]) && isset($_POST["txtCorreo"])) {
        $nombres = trim($_POST["txtNombres"]);
        $tel = trim($_POST["txtTel"]);
        $correo = trim($_POST["txtCorreo"]);

        // Validaciones
        if (empty($nombres) || empty($tel) || empty($correo)) {
            echo json_encode(["error" => false, "message" => "Todos los campos son obligatorios."]);
            exit;
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nombres)) {
            echo json_encode(["error" => false, "message" => "El nombre solo puede contener letras y espacios."]);
            exit;
        } elseif (!preg_match("/^[0-9]{10}$/", $tel)) {
            echo json_encode(["error" => false, "message" => "El teléfono debe tener 10 dígitos."]);
            exit;
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["error" => false, "message" => "El correo no es válido."]);
            exit;
        }

        include_once("contacto.php");
        $contacto = new Contacto();
        $contacto->nombres = $nombres;
        $contacto->telefono = $tel;
        $contacto->correo = $correo;

        if ($contacto->alta() > 0) {
            echo json_encode(["success" => true, "message" => "Contacto agregado con éxito."]);
        } else {
            echo json_encode(["error" => false, "message" => "Hubo un error al agregar el contacto."]);
        }
    } else {
        echo json_encode(["error" => false, "message" => "Faltan datos en el formulario."]);
    }
?>
