<?php
class Participaciones extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function saludo(){
        $id_curso=$_POST['id'];
        $estatus="Completo";
        $_SESSION['nombreCurso']=$_POST['nombreCurso'];
        if (empty($_POST['personal'])) {
            $this->view->mensaje = "no se ha seleccionado nada";
            $this->view->code = "error";
        }else{
        foreach ($_POST['personal'] as $id_candidato) {
            $this->model->update(['id_curso' => $id_curso, 'id_candidato' => $id_candidato,'estatus' => $estatus]);
          }
        $this->view->mensaje = "Participacion registrada";
        $this->view->code = "success";
        }
        $capacitacion = $this->view->datos = $this->model->getById($id_curso);
        $this->view->capacitacion = $capacitacion;
        $this->view->idCurso = $id_curso;
        $this->view->render('participaciones/consulta');
    }
    function asignarCapacitacion(){
        $id_curso=$_POST['id'];
        $estatus="Pendiente";
        $estado=$_POST['estado'];
        $nombreCurso=$_POST['nombreCurso'];
        
        if (empty($_POST['personal'])) {
            $this->view->mensaje = "No se ha ningun candidato";
            $this->view->code = "error";

        }else{
        foreach ($_POST['personal'] as $id_candidato) {
            $this->model->insert(['id_curso' => $id_curso, 'id_candidato' => $id_candidato,
                                  'estatus' => $estatus]);
        
          }
            $this->view->mensaje = "Candidato asignado";
            $this->view->code = "success";
        }
        $capacitacion = $this->view->datos = $this->model->getById($id_curso);
        $this->view->capacitacion = $capacitacion;
        $this->view->estado = $estado;
        $this->view->nombreCurso = $nombreCurso;
        $this->view->render('participaciones/consulta');
    }
    function verCapacitacionId($param = null){
        $idCurso = $param[0];
        $estado = $param[1];
        $_SESSION['nombreCurso'] = $param[2];
        $capacitacion = $this->model->getById($idCurso);
        $this->view->capacitacion = $capacitacion;
        $this->view->estado = $estado;
        $this->view->idCurso = $idCurso;
        $this->view->render('participaciones/consulta');
    }
    
}

?>