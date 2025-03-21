<?php
include_once 'Contacto.php'; 

$contacto = new Contacto();
$contactos = $contacto->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contactos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        .btn-back {
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Contactos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Teléfono</th>
                <th>Correo</th>
            </tr>
            <?php foreach ($contactos as $row): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["nombres"]; ?></td>
                <td><?php echo $row["telefono"]; ?></td>
                <td><?php echo $row["correo"]; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button class="btn-back" onclick="window.history.back()">Volver</button>
    </div>
</body>
</html>