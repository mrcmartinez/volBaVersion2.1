<?php
include_once 'models/telefonos.php';
class TelefonoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO telefono (id_personal, lada, numero,tipo,descripcion) VALUES(:id_personal, :lada, :numero, :tipo, :descripcion)');
            $query->execute(['id_personal' => $datos['id_personal'], 'lada' => $datos['lada'], 'numero' => $datos['numero'], 'tipo' => $datos['tipo'], 'descripcion' => $datos['descripcion']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function get($id){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT*FROM telefono WHERE id_personal = :id_personal");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Telefonos();
                $item->id_personal = $row['id_personal'];
                $item->lada = $row['lada'];
                $item->numero = $row['numero'];
                $item->tipo = $row['tipo'];
                $item->descripcion = $row['descripcion'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id,$lada,$numero){
        $item = new Telefonos();
        $query = $this->db->connect()->prepare("SELECT * FROM telefono WHERE id_personal = :id_personal AND lada = :lada AND numero = :numero");
        try{
            $query->execute(['id_personal' => $id,'lada' => $lada,'numero' => $numero]);
            while($row = $query->fetch()){
                $item->id_personal = $row['id_personal'];
                $item->lada = $row['lada'];
                $item->numero = $row['numero'];
                $item->tipo = $row['tipo'];
                $item->descripcion = $row['descripcion'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE telefono SET lada = :lada, numero = :numero, 
        tipo = :tipo,descripcion = :descripcion WHERE id_personal = :id_personal AND lada = :ant_lada AND numero = :ant_numero");
        try{
            $query->execute([
                'id_personal'=> $item['id_personal'],
                'lada'=> $item['lada'],
                'numero'=> $item['numero'],
                'tipo'=> $item['tipo'],
                'descripcion'=> $item['descripcion'],
                'ant_lada'=> $item['ant_lada'],
                'ant_numero'=> $item['ant_numero']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id,$lada,$numero){
        $query = $this->db->connect()->prepare("DELETE FROM telefono WHERE id_personal = :id_personal AND lada = :lada AND numero = :numero");
        try{
            $query->execute([
                'id_personal'=> $id,
                'lada'=> $lada,
                'numero'=> $numero
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>