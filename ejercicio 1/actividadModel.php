<?php

class actividadModel{

    private $db;


    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=PFY;charset=utf8', 'root', '');
    }


    function cargarAutomaticamente200Km($kms,$fecha,$tipo_operacion, $id_cliente){
        $query = $this->db->prepare("INSERT INTO actividad(kms, fecha, tipo_operacion, id_cliente) VALUES(?, ?, ?, ?)");
        $query->execute(array($kms,$fecha,$tipo_operacion, $id_cliente));
    }
}