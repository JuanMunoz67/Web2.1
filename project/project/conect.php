<?php
    class Conexion{
        function conectar(){
            $dsn="mysql:host=localhost;dbname=agendadb;charset=utf8";
            $pdo=new PDO($dsn,"root", "");
            return $pdo;
        }
    }
?>