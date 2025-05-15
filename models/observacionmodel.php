<?php
require 'models/observacionBD.php';
class ObservacionModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function verModel(){
        // echo "<br> entro a modelo funcion ver";
    }
    public function getById($id,$tipo){
        $item = new ObservacionBD();
            $query = $this->db->connect()->prepare("SELECT* from observacion where id_personal=:id_personal and tipo=:tipo");
            try{
            $query->execute(['id_personal' => $id,'tipo' => $tipo]);
            while($row = $query->fetch()){
                $item = new ObservacionBD();
                $item->id_personal = $row['id_personal'];
                $item->tipo = $row['tipo'];
                $item->comentario = $row['comentario'];        
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

}
?>