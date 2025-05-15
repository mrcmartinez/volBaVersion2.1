<?php
require 'models/usuarios.php';
class UsuarioModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO USUARIO (NOMBRE_USUARIO, PASSWORD, ROL, ESTATUS) VALUES(:nombre_usuario, :password, :rol, :estatus)');
        try{
            $query->execute([
                'nombre_usuario' => $datos['nombre_usuario'],
                'password' => $datos['password'],
                'rol' => $datos['rol'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM USUARIO');
            while($row = $query->fetch()){
                $item = new USUARIOS();
                $item->id_usuario = $row['id_usuario'];
                $item->nombre_usuario    = $row['nombre_usuario'];
                $item->password  = $row['password'];
                $item->rol  = $row['rol'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id){
        $item = new Usuarios();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM USUARIO WHERE id_usuario = :id_usuario');
            $query->execute(['id_usuario' => $id]);
            while($row = $query->fetch()){
                $item->id_usuario = $row['id_usuario'];
                $item->nombre_usuario = $row['nombre_usuario'];
                $item->password  = $row['password'];
                $item->rol  = $row['rol'];
                $item->estatus  = $row['estatus'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE USUARIO SET nombre_usuario = :nombre_usuario, password = :password, rol = :rol, estatus = :estatus WHERE id_usuario = :id_usuario');
        try{
            $query->execute([
                'id_usuario' => $item['id_usuario'],
                'nombre_usuario' => $item['nombre_usuario'],
                'password' => $item['password'],
                'rol' => $item['rol'],
                'estatus' => $item['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id,$estatus){
        if ($estatus=="Activo") {
            $query = $this->db->connect()->prepare("UPDATE usuario SET estatus = 'Inactivo' WHERE id_usuario = :id_usuario");
        }else{
            $query = $this->db->connect()->prepare("UPDATE usuario SET estatus = 'Activo' WHERE id_usuario = :id_usuario");
        }
        try{
            $query->execute([
                'id_usuario' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>