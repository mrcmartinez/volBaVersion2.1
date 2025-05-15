<?php
require 'models/qrcodigo.php';
class QrModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getId($id){
        $item = new Qrcodigo();
        $query = $this->db->connect()->prepare("SELECT*FROM CODE WHERE id_personal = :id_personal");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item->id_personal = $row['id_personal'];
                $item->identificador = $row['identificador'];
                $item->fecha_modificacion = $row['fecha_modificacion'];  
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }
    function updateQr($item){
        $query = $this->db->connect()->prepare('UPDATE code SET identificador = :identificador, fecha_modificacion = :fecha_modificacion WHERE id_personal = :id_personal');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'identificador' => $item['identificador'],
                'fecha_modificacion' => $item['fecha_modificacion']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

}
?>