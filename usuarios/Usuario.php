<?php
include_once 'Conexion.php';

class Usuario {
    public $id;
    public $nombres;
    public $correo;
    public $contrasena;

    public $conn; 

    public function __construct() {
        $this->conn = Conexion::conectar(); 
    }

    // Método para agregar usuario
    public function alta() {
        $query = "INSERT INTO usuario (nombres, correo, contrasena) VALUES (:nombres, :correo, :contrasena)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $this->contrasena, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Método para listar todos los usuarios
    public function listar() {
        $query = "SELECT * FROM usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los registros
    }

    // Método para eliminar un usuario por su ID
    public function eliminar() {
        $query = "DELETE FROM usuario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Método para actualizar un campo de un usuario
    public function actualizar($campo, $valor) {
        $allowedFields = ["nombres", "correo", "contrasena"]; 
        if (!in_array($campo, $allowedFields)) {
            throw new Exception("Campo no permitido.");
        }

        $query = "UPDATE usuario SET $campo = :valor WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
