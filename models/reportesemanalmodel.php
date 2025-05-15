<?php
require 'models/reporteSemanalDB.php';
class ReporteSemanalModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT p.id_personal as id,p.*,CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombreCompleto,p.ocupacion,vft.id_personal, vft.fecha_faltas,vft.total_faltas, vat.id_personal, vat.total_asistencia, vapt.id_personal, vapt.total_asistencia_apoyo, vfjt.id_personal, vfjt.total_falta_justificada, vfjt.fecha_falta_justificada, vac.id_personal,vac.telefonos from personal as p left join vista_faltas_totales as vft on p.id_personal = vft.id_personal left join vista_asistencias_totales as vat on p.id_personal = vat.id_personal left JOIN vista_asistencias_apoyo_totales as vapt on p.id_personal = vapt.id_personal left JOIN vista_faltas_justificadas_totales as vfjt on p.id_personal = vfjt.id_personal left JOIN vista_agenda_completa as vac on p.id_personal = vac.id_personal WHERE (p.estatus ='Activo' OR p.estatus='Activo-Pendiente')ORDER by nombreCompleto;");
            while($row = $query->fetch()){
                $item = new ReporteSemanalDB();
                $item->id_personal = $row['id'];
                $item->nombre = $row['nombreCompleto'];
                $item->calle = $row['calle'];
                $item->colonia = $row['colonia'];
                $item->numero_exterior = $row['numero_exterior'];
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->estado_civil = $row['estado_civil'];
                $item->numero_hijos = $row['numero_hijos'];
                $item->seguro_medico = $row['seguro_medico'];
                $item->escolaridad = $row['escolaridad'];
                $item->colonia = $row['colonia'];
                $item->turno = $row['turno'];
                $item->actividad = $row['actividad'];
                $item->ocupacion = $row['ocupacion'];
                $item->estatus = $row['estatus'];
                $item->rolar = $row['rolar'];
                $item->fecha_ingreso = $row['fecha_ingreso'];
                $item->telefonos = $row['telefonos'];
                $item->fecha_faltas = $row['fecha_faltas'];
                $item->fecha_falta_justificada = $row['fecha_falta_justificada'];
                $item->total_faltas = $row['total_faltas'];
                $item->total_falta_justificada = $row['total_falta_justificada'];
                $item->total_asistencia = $row['total_asistencia'];
                $item->total_asistencia_apoyo = $row['total_asistencia_apoyo'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>