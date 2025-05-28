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
        public function getReportePeriodo($fechaInicio, $fechaFin){
        $items = [];
        //echo $fechaInicio;
        //echo $fechaFin;
        //$fechaInicio='2025-01-01';
        //$fechaFin='2025-02-01';
        try{
            $query = $this->db->connect()->query("SELECT p.id_personal as id, CONCAT(P.apellido_paterno,' ',P.apellido_materno ,' ',p.nombre) AS nombre,  p.calle, p.colonia, p.numero_exterior,p.fecha_ingreso, p.fecha_nacimiento,p.estado_civil,p.numero_hijos,p.seguro_medico,p.escolaridad,p.turno,p.actividad, p.ocupacion,p.estatus,p.rolar,ROUND(TIMESTAMPDIFF(MONTH, p.fecha_nacimiento, CURDATE()) / 12.0, 1) AS edad, ROUND(TIMESTAMPDIFF(MONTH, p.fecha_ingreso, CURDATE()) / 12.0, 1) AS antiguedad, COUNT(CASE WHEN a.estatus = 'Asistencia' THEN 1 END) AS total_asistencia, COUNT(CASE WHEN a.estatus = 'Asistencia-Apoyo' THEN 1 END) AS total_asistencia_apoyo, COUNT(CASE WHEN a.estatus = 'Falta' THEN 1 END) AS total_faltas, COUNT(CASE WHEN a.estatus = 'Falta-Justificada' THEN 1 END) AS total_faltas_justificadas, GROUP_CONCAT( CASE WHEN a.estatus = 'Falta' THEN DATE_FORMAT(a.fecha, '%d-%b-%y') ELSE NULL END ORDER BY a.fecha SEPARATOR ',' ) AS fecha_faltas, vaa.telefonos FROM personal p LEFT JOIN asistencia a ON p.id_personal = a.id_personal AND a.fecha BETWEEN '$fechaInicio' AND '$fechaFin' LEFT JOIN  vista_agenda_activos as vaa  ON p.id_personal = vaa.id_personal WHERE p.estatus != 'Baja' GROUP BY p.id_personal, p.nombre ORDER BY p.nombre");
            while($row = $query->fetch()){
                $item = new ReporteSemanalDB();
                $item->id_personal = $row['id'];
                $item->nombre = $row['nombre'];
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
                $item->edad = $row['edad'];
                $item->antiguedad = $row['antiguedad'];
                $item->fecha_ingreso = $row['fecha_ingreso'];
                $item->telefonos = $row['telefonos'];
                $item->fecha_faltas = $row['fecha_faltas'];
                //$item->fecha_falta_justificada = $row['fecha_falta_justificada'];
                $item->total_faltas = $row['total_faltas'];
                $item->total_falta_justificada = $row['total_faltas_justificadas'];
                $item->total_asistencia = $row['total_asistencia'];
                $item->total_asistencia_apoyo = $row['total_asistencia_apoyo'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

      public function getBirthday($month){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT id_personal as id, CONCAT(apellido_paterno,' ',apellido_materno ,' ',nombre) AS nombre ,fecha_ingreso, fecha_nacimiento,ROUND(TIMESTAMPDIFF(MONTH, fecha_nacimiento, CURDATE()) / 12.0, 1) AS edad, ROUND(TIMESTAMPDIFF(MONTH, fecha_ingreso, CURDATE()) / 12.0, 1) AS antiguedad from personal WHERE estatus != 'Baja' AND month(fecha_nacimiento)=$month ORDER BY day(fecha_nacimiento)");
            while($row = $query->fetch()){
                $item = new ReporteSemanalDB();
                $item->id_personal = $row['id'];
                $item->nombre = $row['nombre'];
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->edad = $row['edad'];
                $item->fecha_ingreso = $row['fecha_ingreso'];
                $item->antiguedad = $row['antiguedad'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

}
?>