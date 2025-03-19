<?php 
session_start(); 
    if(!isset($_SESSION['color'])){
        $_SESSION['color']=$_POST["txtColor"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="<?php echo $_SESSION['color']?>">
    !!Hola!!
    <a href="tercera.php">a tercera</a>
</body>
</html>