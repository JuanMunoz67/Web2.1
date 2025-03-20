<?php
class Conexion {
    private static $pdo;

    public static function conectar() {
        if (!isset(self::$pdo)) {
            $dsn = "mysql:host=localhost;dbname=agendadb;charset=utf8";
            try {
                self::$pdo = new PDO($dsn, "root", "");
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>