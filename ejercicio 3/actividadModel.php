<?php

class actividadModel{

    private $db;


    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=PFY;charset=utf8', 'root', '');
    }
    function getActividadesCliente($id){
        $query = $this->db->prepare("SELECT SUM(kms) AS total_kms FROM actividad WHERE id_cliente = ?");
        $query->execute($id);
        $actividades = $query->fetch(PDO::FETCH_OBJ);
        return $actividades;
    }


    function transferir($kms,$fecha,$tipo_operacion, $id_cliente){
        $query = $this->db->prepare("INSERT INTO actividad(kms, fecha, tipo_operacion, id_cliente) VALUES(?, ?, ?, ?)");
        $query->execute(array($kms,$fecha,$tipo_operacion, $id_cliente));
    }

}

    
