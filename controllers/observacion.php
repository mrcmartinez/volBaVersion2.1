<?php



class Observacion extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->usuario = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }
    function ver(){
        $id_personal = $_POST['id_personal'];
        $tipo = $_POST['tipo'];
        $observacion= $this->model->getById($id_personal,$tipo);
        $cadena=$observacion->comentario;
        $cadena.='<br> <a href="';
        $cadena.= constant('URL').'personal/eliminar_nota/';
        $cadena.= $id_personal.'/'.$tipo.'">eliminar</a>';
        // $cadena.='<br> <a href="';
        // $cadena.= constant('URL').'personal/llamarBaja/';
        // $cadena.= $id_personal.'/'.$tipo.'">editar</a>';
        echo $cadena;
        // echo $observacion->comentario echo '<button>Hola</button>';
    }
    function insertar(){
        echo $id_personal=$_POST['id_personal'];
        echo $tipo=$_POST['tipo'];
        echo $comentario=$_POST['comentario'];
    }
    function modalNote(){
        // echo '<a href="#miModalBaja">Abrir Modal</a>';
        // echo '<div id="miModalBaja" class="modalBaja">';
        // echo '<div class="modalBaja-contenido">';
        // echo '<form action="';echo constant('URL');echo 'personal/eliminarPersonal" method="post" method="post">';
        // echo '<label for="">Motivo de la baja</label>';
        // echo '<input type="text" name="id_personal" value="">';
        // echo '<input type="text" name="cometario" value="">';
        // echo '</form>';
        // echo '</div>';
        // echo '</div>';
        echo $cadena = $_POST['Pass'];
        // $this->view->mensaje = $cadena;
        // $this->view->render('pruebas/index');
    }

    function crearNota(){
        $id_personal = $_POST['id_personal'];
        $tipo=$_POST['tipo'];
        $comentario  = $_POST['comentario'];
        if($this->model->insert(['id_personal' => $id_personal, 'tipo' => $tipo,
                                 'comentario' => $comentario])){
            $this->view->mensaje = "nota creada correctamente";
        }else{
            $this->view->mensaje = "nota ya está registrada";
        }
    } 
}
?>