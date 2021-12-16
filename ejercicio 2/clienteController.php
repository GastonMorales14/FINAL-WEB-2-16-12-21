<?php
require_once "Model/clienteModel.php";
require_once "Model/actividadModel.php";
require_once "Model/tarjetaModel.php";
require_once "View/clienteView.php";

class clienteController{
    
    private $model;
    private $modelActividad;
    private $modelTarjeta;
    private $view;

    function __construct() {

        $this->model = new clienteModel();
        $this->modelActividad = new actividadModel();
        $this->modelTarjeta = new tarjetaModel();
        $this->view = new clienteView();

    }



    function mostrarResumenDeCuenta($id){
        $cliente = $this->model->getCliente($id);
        $actividad = $this->modelActividad->getActividadesCliente($id);
        $tarjetas = $this->modelTarjeta->getTarjetasCliente($id);
        if(!empty($cliente)){
            if(!empty($actividad) && !empty($tarjetas)){
                $this->view->showClienteResumen($cliente,$actividad,$tarjetas);
            }else{
                $this->view->showClienteResumen($cliente, "no tiene actividad ni tarjetas asociadas");
            }
        }else{
            $this->view->showCliente("El cliente no existe");
        }
    }
}