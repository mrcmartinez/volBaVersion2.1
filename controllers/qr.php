<?php

class Qr extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->qr = [];
        $this->view->mensaje = "";
    }

    function consultar($param = null)
    {
        $idPersonal = $param[0];
        // $telefono = $this->model->get($idPersonal);
        $this->listar($idPersonal);
        // 
        // 
    }
    function listar($param){
        clearstatcache();
        $idPersonal = $param;
        $this->view->id = $idPersonal;
        $file = "assets/img/QR/qr".$idPersonal.".png";
        $img=constant('URL').$file;
        $this->view->img = $img;
        // 
        $qr = $this->model->getId($idPersonal);
        // print_r($qr);
        $this->view->qr = $qr;
        // $this->view->telefono = $telefono;
        $this->view->render('qr/index');
    }
function actualizar($param = null){
    $id_personal = $param[0];
    $fecha=date("Y-m-d");
    $identificador=mt_rand(5, 15);
 
    if($this->model->updateQr(['id_personal' => $id_personal, 'identificador' => $identificador,
    'fecha_modificacion' => $fecha])){
        $this->view->mensaje = "Se activo nuevo Qr";
        $this->view->code = "success";
    }else{
        $this->view->mensaje = "No se pudo actualizar el Qr";
        $this->view->code = "error";
    }
    $this->listar($id_personal);
}

}