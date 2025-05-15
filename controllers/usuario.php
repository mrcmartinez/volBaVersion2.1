<?php



class Usuario extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->usuario = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }

    function listar(){
        $usuario = $this->view->datos = $this->model->get();
        $this->view->usuario = $usuario;
            $this->view->render('usuario/index');
    }
    function nuevo(){
        $this->view->render('usuario/nuevo');
    }
    function crear(){
        $nombre_usuario = $_POST['nombre_usuario'];
        $password=md5($_POST['password']);
        $rol  = $_POST['rol'];
        $estatus  = $_POST['estatus'];
        if($this->model->insert(['nombre_usuario' => $nombre_usuario, 'password' => $password,
                                 'rol' => $rol,'estatus' => $estatus])){
            $this->view->mensaje = "Usuario creado correctamente";
            $this->view->render('usuario/nuevo');
        }else{
            $this->view->mensaje = "ID ya está registrada";
            $this->view->render('curso/nuevo');
        }
    }
    function verUsuario($param = null){
        $idUsuario = $param[0];
        $usuario = $this->model->getById($idUsuario);
        $this->view->usuario = $usuario;
        $this->view->render('usuario/detalle');
    }

    function actualizarUsuario($param = null){
        $id_usuario = $_POST['id_usuario'];
        $nombre_usuario    = $_POST['nombre_usuario'];
        $estatus    = $_POST['estatus'];
        if (!empty($_POST['password_new'])) {
            //se digito nueva contraseña
            $password  = md5($_POST['password_new']);
        }else{
            //no se digito nueva contraseña
            $password  = $_POST['password'];
        }
        $rol  = $_POST['rol'];
        if($this->model->update(['id_usuario' => $id_usuario,'nombre_usuario' => $nombre_usuario, 'password' => $password,
                                'rol' => $rol,'estatus' => $estatus])){
            $this->view->mensaje = "usuario actualizado correctamente";
            $this->listar();
        }else{
            $this->view->mensaje = "No se pudo actualizar el usuario";
            $this->view->render('usuario/detalle');
        }
    }

    function eliminarUsuario($param = null){
        $id = $param[0];
        $estatus = $param[1];
        if($this->model->delete($id,$estatus)){
            $mensaje ="Cambio de estatus correctamente";
        }else{
            $mensaje = "No se pudo cambiar el estatus";
        }
        $this->listar();
    }   
}
?>