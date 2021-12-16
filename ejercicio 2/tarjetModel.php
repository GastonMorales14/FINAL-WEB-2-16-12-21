<?php

class tarjetaModel{

    private $db;


    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=PFY;charset=utf8', 'root', '');
    }


    function getTarjetasCliente($id){
            $query = $this->db->prepare("SELECT * FROM tarjeta WHERE id_cliente = ?");
            $query->execute($id);
            $tarjetas = $query->fetchAll(PDO::FETCH_OBJ);
            return $tarjetas;
    }



}