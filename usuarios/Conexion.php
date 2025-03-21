<?php
class Conexion {
    private static $pdo;

    public static function conectar() {
        if (!isset(self::$pdo)) {
            $server = 'tcp:agendadb-1.database.windows.net,1433';
            $database = 'agendadb';
            $username = 'admon@';
            $password = 'idcH?n3hKYP+!?Z';

            // DSN para SQL Server
            $dsn = "sqlsrv:Server=$server;Database=$database";

            try {
                self::$pdo = new PDO($dsn, $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conexión exitosa"; // opcional
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>
