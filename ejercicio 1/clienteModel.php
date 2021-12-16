<?php

class clienteModel{

    private $db;


    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=PFY;charset=utf8', 'root', '');
    }

    function getClientes(){
        $query = $this->db->prepare("SELECT * FROM cliente");
        $query->execute();
        $clientes = $query->fetchAll(PDO::FETCH_OBJ);
        return $clientes;
    }

    function crearCliente($nombre, $dni, $telefono, $direccion, $ejecutivo){
        $query = $this->db->prepare("INSERT INTO cliente(nombre, dni, telefono, direccion, ejecutivo) VALUES(?, ?, ?, ?, ?)");
        $query->execute(array($nombre, $dni, $telefono, $direccion, $ejecutivo));
        return $this->db->lastInsertId();
    }
}