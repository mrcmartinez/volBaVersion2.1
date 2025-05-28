<?php

class ReporteSemanal extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->reporte = [];
        $this->view->mensaje = "";
    }
    public function render()
    {
        $reporte=$this->model->get();
        $this->view->reporte = $reporte;
        $this->view->render('personal/reporteSemanal');
    }
    public function verDatos(){
        $reporte=$this->model->get();
        print_r($reporte);
    }
    function generarReporte(){
        $fecha=date('Y-m-d');
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>generardo el dia:$fecha</h6>";
        $salida .= "<h1>Reporte semanal</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th style='background-color:gray;'>N</th> <th style='background-color:gray;'>ID VOLUNTARIA</th> <th style='background-color:gray;'>NOMBRE</th> <th style='background-color:gray;'>TURNO</th> <th style='background-color:gray;'>ACTIVIDAD</th> <th style='background-color:gray;'>FECHA INGRESO</th> <th style='background-color:gray;'>".utf8_decode('AÑOS ANTIGUEDAD')."</th> <th style='background-color:gray;'>ESTATUS</th> <th style='background-color:gray;'>CALLE</th> <th style='background-color:gray;'>COLONIA</th> <th style='background-color:gray;'>N EXTERIOR</th> <th style='background-color:gray;'>FECHA NACIMIENTO</th> <th style='background-color:gray;'>DIA</th> <th style='background-color:gray;'>MES</th> <th style='background-color:gray;'>".utf8_decode('AÑO')."</th> <th style='background-color:gray;'>EDAD</th> <th style='background-color:gray;'>ESTADO CIVIL</th> <th style='background-color:gray;'>N HIJOS</th> <th style='background-color:gray;'>SEGURO MEDICO</th> <th style='background-color:gray;'>ESCOLARIDAD</th> <th style='background-color:gray;'>OCUPACION</th> <th style='background-color:gray;'>TELEFONOS</th> <th style='background-color:gray;'>TOTAL_FALTAS</th> <th style='background-color:gray;'>TOTAL ASISTENCIA</th> <th style='background-color:gray;'>TOTAL ASISTENCIA APOYO</th> <th style='background-color:gray;'>TOTAL FALTA JUSTIFICADA</th> <th style='background-color:gray;'>FECHA FALTAS</th>  <th style='background-color:gray;'>FECHA FALTA JUSTIFICADA</th> </thead>";
        $i=1;
        foreach($reporte = $this->model->get() as $r){
            $turno= $r->rolar ? 'Rolar' : $r->turno;
            $salida .= "<tr> <td>".$i."</td> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".$turno."</td> <td>".$r->actividad."</td> <td>".$r->fecha_ingreso."</td> <td>".edad($r->fecha_ingreso)."</td> <td>".$r->estatus."</td> <td>".utf8_decode($r->calle)."</td><td>".utf8_decode($r->colonia)."</td><td>".$r->numero_exterior."</td> <td>".$r->fecha_nacimiento."</td> <td>".formatDay($r->fecha_nacimiento)."</td> <td>".formatMonth($r->fecha_nacimiento)."</td> <td>".formatYear($r->fecha_nacimiento)."</td> <td>".edad($r->fecha_nacimiento)."</td> <td>".$r->estado_civil."</td><td>".$r->numero_hijos."</td> <td>".$r->seguro_medico."</td> <td>".$r->escolaridad."</td> <td>".$r->ocupacion."</td> <td>".$r->telefonos."</td> <td>".$r->total_faltas."</td>  <td>".$r->total_asistencia."</td> <td>".$r->total_asistencia_apoyo."</td> <td>".$r->total_falta_justificada."</td><td>".$r->fecha_faltas."</td> <td>".$r->fecha_falta_justificada."</td> </tr>";
        $i++;
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=reporteSemanal_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }
        function generarReportePeriodo(){
        $fecha=date('Y-m-d');
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>generardo el dia:$fecha</h6>";
        $salida .= "<h1>Reporte Periodo del $f_inicio al $f_termino</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th style='background-color:gray;'>N</th> <th style='background-color:gray;'>ID VOLUNTARIA</th> <th style='background-color:gray;'>NOMBRE</th> <th style='background-color:gray;'>TURNO</th> <th style='background-color:gray;'>ACTIVIDAD</th> <th style='background-color:gray;'>FECHA INGRESO</th> <th style='background-color:gray;'>".utf8_decode('AÑOS ANTIGUEDAD')."</th> <th style='background-color:gray;'>ESTATUS</th> <th style='background-color:gray;'>CALLE</th> <th style='background-color:gray;'>COLONIA</th> <th style='background-color:gray;'>N EXTERIOR</th> <th style='background-color:gray;'>FECHA NACIMIENTO</th> <th style='background-color:gray;'>DIA</th> <th style='background-color:gray;'>MES</th> <th style='background-color:gray;'>".utf8_decode('AÑO')."</th> <th style='background-color:gray;'>EDAD</th> <th style='background-color:gray;'>ESTADO CIVIL</th> <th style='background-color:gray;'>N HIJOS</th> <th style='background-color:gray;'>SEGURO MEDICO</th> <th style='background-color:gray;'>ESCOLARIDAD</th> <th style='background-color:gray;'>OCUPACION</th> <th style='background-color:gray;'>TELEFONOS</th> <th style='background-color:gray;'>TOTAL_FALTAS</th> <th style='background-color:gray;'>TOTAL ASISTENCIA</th> <th style='background-color:gray;'>TOTAL ASISTENCIA APOYO</th> <th style='background-color:gray;'>TOTAL FALTA JUSTIFICADA</th> <th style='background-color:gray;'>FECHA FALTAS</th> </thead>";
        $i=1;
        foreach($reporte = $this->model->getReportePeriodo($f_inicio, $f_termino) as $r){
            $turno= $r->rolar ? 'Rolar' : $r->turno;
            $salida .= "<tr> <td>".$i."</td> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".$turno."</td> <td>".$r->actividad."</td> <td>".$r->fecha_ingreso."</td> <td>".$r->antiguedad."</td> <td>".$r->estatus."</td> <td>".utf8_decode($r->calle)."</td><td>".utf8_decode($r->colonia)."</td><td>".$r->numero_exterior."</td> <td>".$r->fecha_nacimiento."</td> <td>".formatDay($r->fecha_nacimiento)."</td> <td>".formatMonth($r->fecha_nacimiento)."</td> <td>".formatYear($r->fecha_nacimiento)."</td> <td>".$r->edad."</td> <td>".$r->estado_civil."</td><td>".$r->numero_hijos."</td> <td>".$r->seguro_medico."</td> <td>".$r->escolaridad."</td> <td>".$r->ocupacion."</td> <td>".$r->telefonos."</td> <td>".$r->total_faltas."</td>  <td>".$r->total_asistencia."</td> <td>".$r->total_asistencia_apoyo."</td> <td>".$r->total_falta_justificada."</td><td>".$r->fecha_faltas."</td></tr>";
        $i++;
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=reportePeriodo_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }

        public function verReportePeriodo()
    {
        $f_inicio=date('Y-01-01');
        $f_termino=date('Y-m-d');
        if(isset($_POST['fecha_inicio'])){
            $f_inicio  = $_POST['fecha_inicio'];
            $f_termino  = $_POST['fecha_termino'];
        }
        $reporte=$this->model->getReportePeriodo($f_inicio,$f_termino);
        $this->view->reporte = $reporte;
        $this->view->inicio = $f_inicio;
        $this->view->termino = $f_termino;
        //dep($reporte);
        $this->view->render('personal/reportePeriodo');
    }

        public function birthday(){
            $mes = isset($_POST['mes']) ? $_POST['mes'] : date('m');
            $datos = $this->model->getBirthday($mes);
            echo $this->view->mes = $mes;
            $this->view->datos = $datos;
            $this->view->render('personal/birthday');
        }
}