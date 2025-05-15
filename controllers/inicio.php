<?php

class Inicio extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function render(){
        $this->view->render('inicio/index');
    }
    function cerrar_sesion(){
        session_start();
        session_unset();
        session_destroy();
        $this->view->render('inicio/index');
    }

    function iniciarSesion(){
        session_start();
        if (isset($_GET[base_url().'personal/cerrar_sesion'])) {
            session_unset();
            session_destroy();
            echo "sesion cerrada";
        }
        if (isset($_SESSION['rol'])) {
            switch($_SESSION['rol']){
                case "Administrador":
                    header('location:'. base_url().'personal');
                    break;
                case "Supervisor":
                    header('location:'. base_url().'personal');
                    break;
                    default;
            }
        }
        if (isset($_POST['nombre_usuario'])&&isset($_POST['password'])) {
            $nombre_usuario=$_POST['nombre_usuario'];
            $password=md5($_POST['password']);
            // $password=$_POST['password'];
            $row=$this->model->select(['nombre_usuario' => $nombre_usuario,'password' => $password]);

            if ($row == true) {
                // echo "el usuario y contraseña son correctos";
                $rol=$row[3];
                $usuario=$row[1];
                $idUser=$row[0];
                $_SESSION['idUser']=$idUser;
                $_SESSION['rol']=$rol;
                $_SESSION['user']=$usuario;
                switch($_SESSION['rol']){
                    case "Administrador":
                        // $archivoController = 'controllers/personal.php';
                        // require_once $archivoController;
                        // $controller = new Personal();
                        // $controller->listarPersonal();
                        header('location:'. base_url().'personal/listarPersonal');
                        // $this->view->render('personal');
                        break;
                    case "Supervisor":
                        header('location:'. base_url().'personal/listarPersonal');
                        // header('location:'. base_url().'documento');
                        break;
                        default;
                }
            }else{
                $this->view->mensaje = "el usuario o contraseña son incorrectos";
                $this->view->code = "error";
                $this->render();
            }
                
        }

    }
}

?>