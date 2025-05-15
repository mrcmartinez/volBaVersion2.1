<?php
require 'libraries/session.php';

class Taller extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }

    function render(){
        $this->view->render('taller/nuevo');
    }
    function listar($param = null){
        $consulta  = "";
        $filtro="Activo";
        $fecha="";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
            $fecha  = $_POST['caja_fecha'];
        }
        $cursos = $this->view->datos = $this->model->getBusqueda($consulta,$filtro,$fecha);
        $this->view->cursos = $cursos;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        if (isset($param[0])) {
            $this->view->idCurso = $param[0];
            $this->view->render('tallero/consulta');
        }else{
            $this->view->render('taller/consulta');
        }
    }

    function crear(){
        $nombre    = $_POST['nombre'];
        $descripcion  = $_POST['descripcion'];
        $responsable  = $_POST['responsable'];
        $fecha  = $_POST['fecha'];
        $hora  = $_POST['hora'];
        $estatus  = $_POST['estatus'];

        if($this->model->insert(['nombre' => $nombre, 'descripcion' => $descripcion,
                                 'responsable' => $responsable, 'fecha' => $fecha, 'hora' => $hora, 'estatus' => $estatus])){
            $this->view->mensaje = "Curso creado correctamente";
            $this->view->code = "success";
            $this->listar();
        }else{
            $this->view->mensaje = "No se pudo registrar";
            $this->view->code = "error";
            $this->view->render('taller/nuevo');
        }
    }
    function verCurso($param = null){
        $idCurso = $param[0];
        $curso = $this->model->getById($idCurso);
        $this->view->curso = $curso;
        $this->view->render('taller/detalle');
    }

    function actualizarCurso($param = null){
        $id = $_POST['id'];
        $nombre    = $_POST['nombre'];
        $descripcion  = $_POST['descripcion'];
        $responsable  = $_POST['responsable'];
        $fecha  = $_POST['fecha'];
        $hora  = $_POST['hora'];
        $estatus  = $_POST['estatus'];

        if($this->model->update(['id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion,
                                'responsable' => $responsable, 'fecha' => $fecha, 'hora' => $hora, 'estatus' => $estatus])){
            $this->view->mensaje = "Curso actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar al curso";
        }
        $this->listar();
    }

    function eliminarCurso($param = null){
        $id = $param[0];
        $estatus = $param[1];
        if($this->model->delete($id,$estatus)){
            $mensaje ="Curso eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar al curso";
        }
        $this->listar();
    }
}

?>