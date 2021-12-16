<?php

class clienteModel{

    private $db;


    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=PFY;charset=utf8', 'root', '');
    }

    function getClientes(){
        $query = $this->db->prepare("SELECT *  FROM cliente");
        $query->execute();
        $clientes = $query->fetchAll(PDO::FETCH_OBJ);
        return $clientes;
    }
}