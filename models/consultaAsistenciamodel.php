<?php

include_once 'models/asistencia.php';

class ConsultaAsistenciaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get($id){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora, m.descripcion
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal
            LEFT JOIN motivo as m
            ON m.fecha = a.fecha 
            AND m.id_personal = a.id_personal 
            where a.id_personal=:id_personal ");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                $item->descripcion = $row['descripcion'];
                array_push($items, $item);      
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getAll(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal");
            
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
        public function getRango($id, $year){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora, m.descripcion
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal
            LEFT JOIN motivo as m
            ON m.fecha = a.fecha 
            AND m.id_personal = a.id_personal 
            where a.id_personal=:id_personal 
            AND year(a.fecha)= :rango order by a.fecha desc");
            try{
            $query->execute(['id_personal' => $id,'rango' => $year]);
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                $item->descripcion = $row['descripcion'];
                array_push($items, $item);      
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    //este metodo lo utiliza lista.php y reporte.php
    public function getBusqueda($c,$f,$fInicio,$fTermino,$orden,$h){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora,m.descripcion,p.apellido_paterno,p.turno,a.hora,p.horario
            FROM asistencia as a
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal
            LEFT JOIN motivo as m
            ON m.fecha = a.fecha 
            AND m.id_personal = a.id_personal 
            WHERE (a.id_personal ='$c' OR CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) like '%".$c."%' OR p.turno ='$c') AND p.horario like '%".$h."%' AND a.estatus like '%".$f."%' AND a.fecha BETWEEN '$fInicio' AND '$fTermino' ORDER BY $orden");
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->turno = $row['turno'];
                $item->horario = $row['horario'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                $item->descripcion = $row['descripcion'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getBusquedaReport($c,$f,$fInicio,$fTermino,$orden,$hora){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora,m.descripcion,p.apellido_paterno,p.turno,a.hora,p.horario
            FROM asistencia as a
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal
            LEFT JOIN motivo as m
            ON m.fecha = a.fecha 
            AND m.id_personal = a.id_personal 
            WHERE (a.id_personal ='$c' OR CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) like '%".$c."%' OR p.turno ='$c') AND a.hora BETWEEN '$hora[0]' AND '$hora[1]' AND a.estatus like '%".$f."%' AND a.fecha BETWEEN '$fInicio' AND '$fTermino' ORDER BY $orden");
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->turno = $row['turno'];
                $item->horario = $row['horario'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                $item->descripcion = $row['descripcion'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getList($fecha,$hora){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, p.actividad, a.id_personal, a.fecha,a.estatus,a.hora
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal WHERE fecha = '$fecha' and a.hora BETWEEN '$hora[0]' AND '$hora[1]' ORDER BY nombre");
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->actividad = $row['actividad'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE ASISTENCIA SET estatus = :estatus,hora=:hora WHERE (fecha = :fecha AND id_personal = :id_personal)');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'fecha' => $item['fecha'],
                'hora' => $item['hora'],
                'estatus' => $item['estatus']
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
    public function updateEstatusRolar($item){
        $query = $this->db->connect()->prepare('UPDATE asistencia set estatus = :estatus WHERE id_personal IN (SELECT id_personal from personal WHERE rolar=:rolar and estatus!=:estatusPersonal) AND fecha=:fecha and estatus=:estatusAsistencia');
        try{
            $query->execute([
                'estatus' => 'Asistencia',
                'estatusAsistencia' => 'Asistencia-Apoyo',
                'estatusPersonal' => 'Baja',
                'fecha' => $item['fecha'],
                'rolar' => true
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function buscar($datos){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT id_personal from personal WHERE (estatus=:estatus OR estatus=:estatus2) AND turno=:turno AND horario=:horario AND rolar=:rolar");
            try{
            $query->execute([
                'turno' => $datos['turno'],
                'horario' => $datos['horario'],
                'estatus' => $datos['estatus'],
                'rolar' => $datos['rolar'],
                'estatus2' => 'Activo-Pendiente'
                ]);
            while($row = $query->fetch()){
                $row['id_personal'];
                array_push($items, $row);      
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    // buscar el personal que rola turno y ademas que tiene 0 registro de aistencia en los ultimos 6 dias correspondientes a la semana
    // buscar el personal que rola turno y ademas que tiene 0 registros en la tabla la semana anterior
    public function buscarRolar($fecha){
        $items = [];
       // Calcular el número de semana anterior
    $semanaActual = date('W', strtotime($fecha));
    $semanaAnterior = $semanaActual - 1;
    $anio = date('Y', strtotime($fecha));
        // echo $numeroSemana;
            $query = $this->db->connect()->prepare("SELECT DISTINCT p.id_personal
        FROM personal AS p
        WHERE p.id_personal NOT IN (
            SELECT a.id_personal
            FROM asistencia AS a
            WHERE WEEK(a.fecha, 1) = $semanaAnterior AND YEAR(a.fecha) = $anio
        )
        AND EXISTS (
            SELECT 1
            FROM asistencia AS a2
            WHERE a2.id_personal = p.id_personal
        )
        AND p.estatus != 'Baja'
        AND P.rolar= TRUE");
            try{
                $query->execute();
            while($row = $query->fetch()){
                $row['id_personal'];
                array_push($items, $row);      
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    
    
        // buscar el personal que rola turno
        public function getBuscarRolar(){
            $items = [];
                $query = $this->db->connect()->prepare("SELECT id_personal from personal WHERE rolar=TRUE and estatus!='Baja'");
                try{
                    $query->execute();
                while($row = $query->fetch()){
                    $row['id_personal'];
                    array_push($items, $row);      
                }
                return $items;
            }catch(PDOException $e){
                return [];
            }
        }
    function prueba($datos){
        echo $datos; 
        echo "</br>";
    }
    public function insertManual($datos){
        $query = $this->db->connect()->prepare('INSERT ignore into asistencia(id_personal) SELECT id_personal from personal WHERE estatus=:estatus AND turno=:turno');
        try{
            $query->execute([
                'turno' => $datos['turno'],
                'fecha' => $datos['fecha'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function buscarManual($datos){
        // print_r($datos);
        $query = $this->db->connect()->prepare('INSERT INTO ASISTENCIA (id_personal, fecha, hora) VALUES(:id_personal, :fecha, :hora)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha'],
                'hora' => $datos['hora']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function buscarManualRolar($datos) {
        try {
            $conn = $this->db->connect();
            $conn->beginTransaction();
    
            // Calcular el último sábado
            $fecha = $datos['fecha'];
            $ultimoSabado = date('Y-m-d', strtotime(date('w', strtotime($fecha)) == 6 ? $fecha : 'last Saturday', strtotime($fecha)));
            $lunes = date('Y-m-d', strtotime("$ultimoSabado -5 days"));

    
            // Calcular número de semana
            $numeroSemana = date('W', strtotime($ultimoSabado));
    
            // Insertar en ASISTENCIA
            $query1 = $conn->prepare('INSERT INTO ASISTENCIA (id_personal, fecha, hora) VALUES (:id_personal, :fecha, :hora)');
            $query1->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $ultimoSabado,
                'hora' => $datos['hora']
            ]);
    
            // Insertar en MOTIVO
            $descripcion = "No asistio entre lunes $lunes a sabado $ultimoSabado de la semana anterior $numeroSemana";
            $query2 = $conn->prepare('INSERT INTO MOTIVO (id_personal, fecha, descripcion) VALUES (:id_personal, :fecha, :descripcion)');
            $query2->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $ultimoSabado,
                'descripcion' => $descripcion
            ]);
    
            // Confirmar la transacción
            $conn->commit();
            return true;
    
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            if (isset($conn)) {
                $conn->rollBack();
            }
            return false;
        }
    }
    
    public function insertApoyo($datos){
        $query = $this->db->connect()->prepare('INSERT INTO asistencia (id_personal, fecha, hora, estatus) VALUES(:id_personal, :fecha, :hora, :estatus)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha'],
                'hora' => $datos['hora'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function delete($id,$fecha){
        $query = $this->db->connect()->prepare("DELETE FROM asistencia WHERE id_personal = :id_personal AND fecha = :fecha");
        try{
            $query->execute([
                'id_personal'=> $id,
                'fecha'=> $fecha
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function consultarAgenda($id){
        $nomb="";
        $query = $this->db->connect()->prepare("SELECT p.id_personal, CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, va.telefonos from vista_agenda as va INNER JOIN personal as p ON p.id_personal = va.id_personal where va.id_personal=:id_personal;");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $nomb=$row['nombre'];
                $tel=$row['telefonos'];
            }
            return array($nomb,$tel);
        }catch(PDOException $e){
            return array(null,null);
        }
    }
    public function insertMotivo($datos){
        $query = $this->db->connect()->prepare('INSERT INTO motivo (ID_PERSONAL, FECHA, DESCRIPCION) VALUES(:id_personal, :fecha, :descripcion)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha'],
                'descripcion' => $datos['descripcion']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function insertjustificar($datos){
        $query = $this->db->connect()->prepare('INSERT INTO PETICION (ID_PERSONAL, FECHA_APERTURA, TIPO, FECHA_SOLICITADA,ESTATUS,AUTORIZO) VALUES(:id_personal, :fecha_apertura, :tipo, :fecha_solicitada, :estatus, :autorizo)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha_apertura' => $datos['fecha_apertura'],
                'tipo' => $datos['tipo'],
                'fecha_solicitada' => $datos['fecha_solicitada'],
                'autorizo' => $datos['autorizo'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
}
?>