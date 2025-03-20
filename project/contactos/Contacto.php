<?php
include_once 'Conexion.php';

class Contacto {
    public $id;
    public $nombres;
    public $telefono;
    public $correo;

    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function alta() {
        $query = "INSERT INTO contacto (nombres, telefono, correo) VALUES (:nombres, :telefono, :correo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function listar() {
        $query = "SELECT * FROM contacto";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar() {
        $query = "DELETE FROM contacto WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function actualizar($campo, $valor) {
        $allowedFields = ["nombres", "telefono", "correo"]; 
        if (!in_array($campo, $allowedFields)) {
            throw new Exception("Campo no permitido.");
        }

        $query = "UPDATE contacto SET $campo = :valor WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>