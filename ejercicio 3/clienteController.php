<?php
require_once "Model/clienteModel.php";
require_once "Model/actividadModel.php";
require_once "View/clienteView.php";
require_once "Helpers/AuthHelper.php";

class clienteController{
    
    private $model;
    private $modelActividad;
    private $view;
    private $authHelper;

    function __construct() {

        $this->model = new clienteModel();
        $this->modelActividad = new actividadModel();
        $this->view = new clienteView();
        $this->authHelper = new AuthHelper();

    }


    function verificarSiElClienteExiste($clientes,$dni){
        foreach($clientes as $cliente){
            if($cliente->dni == $dni){
                return $cliente->id;
            }else{
                return 0;
            }
        }
    }

    function transferirKms($id){
        $logged = $this->authHelper->checkLoggedIn();
        $actividad = $this->modelActividad->getActividadesCliente($id);
        $dni = $_POST['dniDestinatario'];
        $montoATransferir = $_POST['monto'];
        $clientes = $this->model->getClientes();
        $destinatario = $this->verificarSiElClienteExiste($clientes,$dni);


        if($logged == true){
            if($destinatario != 0){
                if($actividad->total_kms >= $montoATransferir){
                    $this->modelActividad->transferir($montoATransferir,DateTime(), 2,$destinatario);
                    $this->modelActividad->restarTransferenciaOrigen($montoATransferir,$actividad);
                    $this->view->showTransferenciaRapida();
                }else{
                    $this->view->TransferenciaRapida("el cliente originario no tiene los kms necesarios para realizar la transferencia");
                }
                
            }else{
                $this->view->showTransferenciaRapida("el destinatario no existe");
            }
            
        }else{
            $this->view->showLogin();
        }    
    }


    }




