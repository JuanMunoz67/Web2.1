<?php 
    $nombres=$_POST["txtNombres"];
    include_once("contacto.php");
    $contacto=new Contacto();
    $contacto->nombres=$nombres;
    if($contacto->eliminar()>0){
        echo "Contacto Eliminado";
    } else {
        echo "Error";
    }