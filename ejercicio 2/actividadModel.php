<?php

class actividadModel{

    private $db;


    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=PFY;charset=utf8', 'root', '');
    }


    function getActividadesCliente($id){
            $query = $this->db->prepare("SELECT * FROM actividad WHERE id_cliente = ?");
            $query->execute($id);
            $actividades = $query->fetchAll(PDO::FETCH_OBJ);
            return $actividades;
    }



}




