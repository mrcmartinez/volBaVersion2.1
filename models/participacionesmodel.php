<?php
require 'models/participacion.php';
class ParticipacionesModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM participacion');
            while($row = $query->fetch()){
                $item = new Participacion();
                $item->id_candidato = $row['id_candidato'];
                $item->id_curso    = $row['id_curso'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getById($id){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT p.nombre, c.id_curso, c.id_candidato,c.estatus 
            FROM participacion as c 
            INNER JOIN candidato as p
            ON c.id_candidato = p.id_candidato WHERE c.id_curso=:id_curso");
            try{
            $query->execute(['id_curso' => $id]);
            while($row = $query->fetch()){
                $item = new Participacion();
                $item->id_curso = $row['id_curso'];
                $item->id_candidato = $row['id_candidato'];
                $item->nombre = $row['nombre'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO PARTICIPACION (ID_CURSO, ID_CANDIDATO, ESTATUS) VALUES(:id_curso, :id_candidato, :estatus)');
        try{
            $query->execute([
                'id_curso' => $datos['id_curso'],
                'id_candidato' => $datos['id_candidato'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE PARTICIPACION SET estatus = :estatus WHERE (id_curso = :id_curso AND id_candidato = :id_candidato)');
        try{
            $query->execute([
                'id_curso' => $item['id_curso'],
                'id_candidato' => $item['id_candidato'],
                'estatus' => $item['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>