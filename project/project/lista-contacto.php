<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        include_once("contacto.php");
        $contacto = new Contacto();
        $arr = $contacto->listar(); // CORREGIDO: Usar listar() en lugar de alta()
    ?>
    <table border="1">
        <tr><th>id</th><th>Nombres</th><th>Correo</th><th>Telefono</th></tr>
        <?php
            if (is_array($arr) && !empty($arr)) {
                foreach ($arr as $c) {                
        ?>
        <tr>
            <td><?php echo $c->id; ?></td>
            <td><?php echo $c->nombres; ?></td>
            <td><?php echo $c->correo; ?></td>
            <td><?php echo $c->telefono; ?></td>
        </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='4'>No hay contactos registrados</td></tr>";
            }
        ?>
    </table>
    <a href="alta.html"><button>Regresar a operaciones</button></a>
</body>
</html>
