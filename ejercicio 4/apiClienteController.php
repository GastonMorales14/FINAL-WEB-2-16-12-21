<?php

require_once "Model/clienteModel.php";
require_once "View/ApiView.php";

class ApiClienteController{
    
    private $model;
    private $view;

    function __construct() {

        $this->model = new clienteModel();
        $this->view = new ApiView();

    }
    
    function getDatosDeMiTarjeta($params = null) {    
        $idCliente = $params[":ID"];
        $cliente = $this->model->getTarjetas($idCliente);
        if(!empty($cliente)){
            return $this->view->response($cliente, 200);
        }else{
            return $this->view->response("No se pudo cargar el cliente", 500);
        }
    }

    function deleteTarjeta($params = null){
        $idCliente = $params[":ID"];  
        $tarjeta = $this->modelTarjeta->getTarjeta($idCliente);
        if(!empty($tarjeta)){
            $id = $this->model->deleteMiTarjeta($idCliente);
            if ($id != 0) {
                $this->view->response("La tarjeta se ha eliminado", 200);
            } else {
                $this->view->response("No se pudo eliminar la tarjeta", 500);
            }
        }
    }

}