<?php

class inicioModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function select($datos){
        $row=false;
        try{
            $conn=$this->db->connect();
            $query = $conn->prepare('SELECT* FROM usuario WHERE nombre_usuario = :nombre_usuario AND password = :password AND estatus=:estatus');
            $query->execute(['nombre_usuario' => $datos['nombre_usuario'], 'password' => $datos['password'], 'estatus' => 'Activo']);
            $row = $query->fetch(PDO::FETCH_NUM);
            return $row;
        }catch(PDOException $e){
            return $row;
        }
    }
}

?>