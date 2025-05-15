<?php
include_once 'models/bajas.php';
class BajaModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getBusqueda($fInicio,$fTermino,$consulta){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, b.id_personal, b.fecha,b.motivo 
            FROM bajas as b 
            INNER JOIN personal as p
            ON b.id_personal = p.id_personal WHERE fecha BETWEEN '$fInicio' AND '$fTermino' and CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) like '%$consulta%' ORDER BY fecha DESC");
            while($row = $query->fetch()){
                $item = new Bajas();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->motivo = $row['motivo'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}