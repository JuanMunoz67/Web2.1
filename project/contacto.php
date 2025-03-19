<?php
    class Contacto{
        var $id;
        var $nombres;
        var $telefono;
        var $correo;

        function alta(){
            include_once("conect.php");
            $con=new Conexion;
            $conn=$con->conectar();
            $query="insert into contacto(nombres, telefono, correo) values ('$this->nombres', '$this->telefono', '$this->correo');";
            $stmt=$conn->prepare($query);
            return $stmt->execute();
        }

        function listar(){
            include_once("conect.php");
            $con=new Conexion;
            $conn=$con->conectar();
            $query="select * from contacto;";
            $stmt=$conn->prepare(($query));
            $stmt->execute(); $todos=null; $i=0;
            while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                $contacto=new Contacto();
                $contacto->id=$data["id"];
                $contacto->nombres=$data["nombres"];
                $contacto->correo=$data["correo"];
                $contacto->telefono=$data["telefono"];
                $todos[$i]=$contacto;
                $i=$i+1;
            }
            return $todos;
        }

        function eliminar(){
            include_once("conect.php");
            $con=new Conexion;
            $conn=$con->conectar();
            $query="DELETE FROM contacto where nombres='this->nombres';";
            $stmt=$conn->prepare($query);
            return $stmt->execute();
        }

        function actualizar($campo, $valor){
            include_once("conect.php");
            $con = new Conexion;
            $conn = $con->conectar();
            $query = "UPDATE contacto SET $campo = :valor WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        }

    }