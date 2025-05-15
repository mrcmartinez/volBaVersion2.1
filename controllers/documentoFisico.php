<?php
require 'libraries/session.php';

class DocumentoFisico extends Controller{

    public function __construct()
    {
        parent::__construct();
        $this->view->documentoFisico = [];
        $this->view->mensaje = "";
        $this->view->consulta = "";
    }
    function render($id=null){
        $id_personal=$id;
        if (isset($_POST['id_personal'])) {
            $id_personal=$_POST['id_personal'];
        }
        $this->view->id = $id_personal;
        $this->view->render('documentoFisico/nuevo');
    }
    public function reporte()
    {
        $consulta = "";
        if (isset($_POST['caja_busqueda'])) {
            $consulta = $_POST['caja_busqueda'];
        }
        $documentoFisico = $this->model->getBusqueda($consulta);
        $this->view->documentoFisico = $documentoFisico;
        // print_r($documentoFisico);
        $this->view->consulta = $consulta;
        $this->view->render('documentoFisico/reporte');
    }

    public function verdocumentoid($param = null)
    {
        $idPersonal = $param[0];
        $this->listar($idPersonal);
        
    }
    function listar($idPersonal){
        $documentoFisico = $this->model->getById($idPersonal);
        $this->view->id = $idPersonal;
        // $this->view->prueba = "PruebaHola";
        $this->view->documentoFisico = $documentoFisico;
        // print_r($documentoFisico);
        $this->view->render('documentoFisico/consulta');
    }
    function actualizarDocumentoFisico(){
        $id_personal=$_POST['id_personal'];
        $acta = isset($_POST['acta'])?'1':'0'; 
        $curp = isset($_POST['curp'])?'1':'0'; 
        $carta = isset($_POST['carta'])?'1':'0'; 
        $comprobante = isset($_POST['comprobante'])?'1':'0'; 
        $datos = isset($_POST['datos'])?'1':'0'; 
        $estudio = isset($_POST['estudio'])?'1':'0'; 
        $examen = isset($_POST['examen'])?'1':'0'; 
        $ine = isset($_POST['ine'])?'1':'0';
        $solicitud = isset($_POST['solicitud'])?'1':'0';  
        
        if($this->model->update(['id_personal' => $id_personal, 'acta' => $acta, 'curp' => $curp,
                                'carta' => $carta, 'comprobante' => $comprobante, 'datos' => $datos, 'estudio' => $estudio,
                                'examen' => $examen,'ine' => $ine,'solicitud' => $solicitud])){
            $this->view->mensaje = "Papeleo actualizado correctamente";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo actualizar el papeleo";
            $this->view->code = "error";
        }
        $this->listar($id_personal);
    }
    function registrar(){
        $id_personal=$_POST['id_personal'];
        $acta = isset($_POST['acta'])?'1':'0'; 
        $curp = isset($_POST['curp'])?'1':'0'; 
        $carta = isset($_POST['carta'])?'1':'0'; 
        $comprobante = isset($_POST['comprobante'])?'1':'0'; 
        $datos = isset($_POST['datos'])?'1':'0'; 
        $estudio = isset($_POST['estudio'])?'1':'0'; 
        $examen = isset($_POST['examen'])?'1':'0'; 
        $ine = isset($_POST['ine'])?'1':'0';
        $solicitud = isset($_POST['solicitud'])?'1':'0';  
        
        if($this->model->insert(['id_personal' => $id_personal, 'acta' => $acta, 'curp' => $curp,
                                'carta' => $carta, 'comprobante' => $comprobante, 'datos' => $datos, 'estudio' => $estudio,
                                'examen' => $examen,'ine' => $ine,'solicitud' => $solicitud])){
            $this->view->mensaje = "Papeleo actualizado correctamente";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo actualizar el papeleo";
            $this->view->code = "error";
        }
        $this->view->ultimoId = $id_personal;
         $this->view->render('documentacion/index');
        //  include_once 'controllers/personal.php';
        //     $p = new Personal();
        //     $p->listarPersonal($id_personal);
        // $this->render($id_personal);
    }

}

?>