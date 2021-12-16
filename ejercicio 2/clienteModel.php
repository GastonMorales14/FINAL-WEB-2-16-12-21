<?php

class clienteModel{

    private $db;


    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=PFY;charset=utf8', 'root', '');
    }

    function getCliente($id){
        $query = $this->db->prepare("SELECT a.(*), b. SUM(kms)  FROM a.cliente JOIN b.actividad WHERE a.id=?");
        $query->execute();
        $cliente = $query->FETCH(PDO::FETCH_OBJ);
        return $cliente;
    }
}