<?php
require 'models/peticiones.php';
class PeticionModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM peticion');
            while($row = $query->fetch()){
                $item = new Peticiones();
                $item->folio = $row['folio'];
                $item->id_personal = $row['id_personal'];
                $item->fecha_apertura = $row['fecha_apertura'];
                $item->fecha_solicitada = $row['fecha_solicitada'];
                $item->dia_solicitado = $row['dia_solicitado'];
                $item->tipo = $row['tipo'];
                $item->archivo = $row['archivo'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO PETICION (ID_PERSONAL, FECHA_APERTURA, TIPO, FECHA_SOLICITADA, DIA_SOLICITADO,DESCRIPCION,ARCHIVO,ESTATUS) VALUES(:id_personal, :fecha_apertura, :tipo, :fecha_solicitada, :dia_solicitado, :descripcion, :archivo, :estatus)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha_apertura' => $datos['fecha_apertura'],
                'tipo' => $datos['tipo'],
                'fecha_solicitada' => $datos['fecha_solicitada'],
                'dia_solicitado' => $datos['dia_solicitado'],
                'descripcion' => $datos['descripcion'],
                'archivo' => $datos['archivo'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }

    public function getById($id){
        $item = new Peticiones();
        try{
            $query = $this->db->connect()->prepare("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, pet.folio, pet.id_personal,pet.fecha_apertura, pet.tipo, pet.autorizo,pet.estatus,pet.descripcion,pet.dia_solicitado,pet.archivo,pet.fecha_solicitada
            FROM peticion as pet 
            INNER JOIN personal as p
            ON pet.id_personal = p.id_personal  WHERE pet.folio = :folio");
            $query->execute(['folio' => $id]);
            while($row = $query->fetch()){
                $item->folio = $row['folio'];
                $item->id_personal    = $row['id_personal'];
                $item->nombre    = $row['nombre'];
                $item->fecha_apertura  = $row['fecha_apertura'];
                $item->tipo  = $row['tipo'];
                $item->descripcion  = $row['descripcion'];
                $item->fecha_solicitada  = $row['fecha_solicitada'];
                $item->dia_solicitado  = $row['dia_solicitado'];
                $item->archivo = $row['archivo'];
                $item->estatus  = $row['estatus'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }
    public function getBusqueda($f){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, pet.folio, pet.id_personal,pet.fecha_apertura, pet.tipo, pet.autorizo,pet.estatus,pet.fecha_solicitada,pet.dia_solicitado,u.id_usuario,u.nombre_usuario,u.id_usuario,u.nombre_usuario
            FROM peticion as pet 
            INNER JOIN personal as p
            ON pet.id_personal = p.id_personal 
            LEFT JOIN usuario as u
            ON pet.autorizo = u.id_usuario
            WHERE pet.estatus like '%".$f."%'");
            while($row = $query->fetch()){
                $item = new Peticiones();
                $item->folio = $row['folio'];
                $item->id_personal    = $row['id_personal'];
                $item->fecha_apertura  = $row['fecha_apertura'];
                $item->tipo  = $row['tipo'];
                $item->nombre  = $row['nombre'];
                $item->autorizo  = $row['nombre_usuario'];
                // $item->descripcion  = $row['descripcion'];
                $item->fecha_solicitada  = $row['fecha_solicitada'];
                $item->dia_solicitado  = $row['dia_solicitado'];
                // $item->archivo = $row['archivo'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function updateDay($item){
        $query = $this->db->connect()->prepare('UPDATE Personal SET turno = :turno WHERE id_personal = :id_personal');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'turno' => $item['dia_solicitado']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function updateDate($item){
        $query = $this->db->connect()->prepare('UPDATE asistencia SET estatus = :estatus WHERE id_personal = :id_personal and fecha = :fecha');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'fecha' => $item['fecha_solicitada'],
                'estatus' => "Falta-Justificada"
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE peticion SET estatus = :estatus, autorizo = :autorizo WHERE folio = :folio');
        try{
            $query->execute([
                'folio' => $item['folio'],
                'estatus' => $item['estatus'],
                'autorizo' => $item['autorizo']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function updateEstatus($item){
        $query = $this->db->connect()->prepare('UPDATE personal set estatus = :estatus WHERE id_personal IN (SELECT id_personal from vistafalta WHERE id_personal=:id_personal)');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'estatus' => $item['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function delete($id,$estatus){
        if ($estatus=="Activo") {
            $query = $this->db->connect()->prepare("UPDATE curso SET estatus = 'Terminado' WHERE id = :id");
        }else{
            $query = $this->db->connect()->prepare("UPDATE curso SET estatus = 'Activo' WHERE id = :id");
        }
        try{
            $query->execute([
                'id' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function consulta($consulta){
        try{
        $query = $this->db->connect()->query($consulta);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function consultaBD($consulta){
        // echo "hola modelo";
        // echo $consulta;
        $items = [];
        try{
            $query = $this->db->connect()->query($consulta);
            // echo "entro";
            while($row = $query->fetch()){
                $row['0'];
                // $item = new Peticiones();
                // $item->folio = $row['folio'];
                // $item->id_personal = $row['id_personal'];
                // $item->fecha_apertura = $row['fecha_apertura'];
                // $item->tipo = $row['tipo'];
                // $item->archivo = $row['archivo'];
                // $item->estatus  = $row['estatus'];
                array_push($items, $row);
            }
            print_r($items);
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>