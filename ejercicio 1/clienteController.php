<?php
require_once "Model/clienteModel.php";
require_once "Model/actividadModel.php";
require_once "Model/tarjetaModel.php";
require_once "View/clienteView.php";
require_once "Helpers/AuthHelper.php";

class clienteController{
    
    private $model;
    private $modelActividad;
    private $modelTarjeta;
    private $view;
    private $authHelper;

    function __construct() {

        $this->model = new clienteModel();
        $this->modelActividad = new actividadModel();
        $this->modelTarjeta = new tarjetaModel();
        $this->view = new clienteView();
        $this->authHelper = new AuthHelper();

    }


    function verificarDniCliente($clientes, $dni){
        foreach($clientes as $cliente){
            if($cliente->dni == $dni){
                return 1;
            }else{
                return 0;
            }
        }
    }


    function agregarCliente(){
        $logged = $this->authHelper->checkLoggedIn();
        $clientes = $this->model->getClientes();
        $dni = $_POST['dni'];
        $ejecutivo = $_POST['ejecutivo'];
        $verificacion =  $this->verificarDniCliente($clientes, $dni);

        if($logged == true){
            $role = $this->authHelper->getRole();
            if($role == 1){//1=administrador;
                if($verificacion == 0){
                    $id = $this->model->crearCliente($_POST['nombre'], $dni, $_POST['telefono'], $_POST['direccion'], $ejecutivo);
                    $this->modelActividad->cargarAutomaticamente200Km(200,DateTime(), 2,$id);
                    if($ejecutivo == 1){
                        $tarjetaEjecutiva = getBussinesCard()
                        $this->modelTarjeta->asociarTarjetaEjecutiva($id,$tarjetaEjecutiva);
                    }
                    $this->view->showClientes();
                }else{
                    $this->view->showClientes("El dni ingresado ya se encuentra registrado");
                }
            }else{
                $this->view->showClientes("No tienes permiso para realizar esta accion");
            }
        }else{
            $this->view->showLogin();
        }
    }


}
