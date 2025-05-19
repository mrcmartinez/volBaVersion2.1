<?php
require_once 'libraries/session.php';
class ConsultaAsistencia extends Controller{
    
    function __construct(){
        parent::__construct();
        $this->view->asistencia = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
        $this->view->filtroHorario= "";
    }

    function render(){
        $consulta  = "";
        $filtro="Falta";
        $filtroHorario="";
        $consultaHora=consultarHoras($filtroHorario);
        $filtroOrden="fecha";
        $f_inicio=date('Y-m-01');
        $f_termino=date('Y-m-d');
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
            $filtroHorario  = $_POST['filtroHorario'];
            $consultaHora=consultarHoras($filtroHorario);
            $filtroOrden  = $_POST['radio_ordenar'];
        }if(isset($_POST['fecha_inicio'])){
            $f_inicio  = $_POST['fecha_inicio'];
            $f_termino  = $_POST['fecha_termino'];
        }
        $asistencia = $this->model->getBusquedaReport($consulta,$filtro,$f_inicio,$f_termino,$filtroOrden,$consultaHora);
        $this->view->inicio = $f_inicio;
        $this->view->termino = $f_termino;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->filtroHorario = $filtroHorario;
        $this->view->radioOrden = $filtroOrden;
        $this->view->asistencia = $asistencia;
        $this->view->render('asistencia/reporte');
    }

    function paseLista(){
        $filtroHorario="Matutino";
        $fecha=date('Y-m-d');
        if (isset($_POST['fecha'])) {
        $fecha=$_POST['fecha'];
        }
        if (isset($_POST['filtroHorario'])) {
            $filtroHorario=$_POST['filtroHorario'];
            }
        $this->view->filtroHorario = $filtroHorario;
        $this->buscarLista($fecha,$filtroHorario);
    }
    function buscarLista($fecha,$filtroHorario){
        $consulta=consultarHoras($filtroHorario);
        // $h_inicio=$consulta[0];
        // $h_fin=$consulta[1];

        $asistencia = $this->model->getList($fecha,$consulta);
        $this->view->asistencia = $asistencia;
        $this->view->fecha = $fecha;
        $this->view->render('asistencia/lista');
    }
    // 
    function calendario($param = null){
        $idPersonal = $param[0];
        $asistencia = $this->model->get($idPersonal);
        $this->view->asistencia = json_encode($asistencia);
        $this->view->id = $idPersonal;
        $this->view->render('asistencia/calendario');
    }
    // 
    function marcarAsistencia(){
            $fecha=$_POST['fecha'];
            $filtroHorario=$_POST['filtroHorario'];
            $hora=consultarEntrada($filtroHorario);
            $estatus=$_POST['estatus'];
            if (empty($_POST['personal'])) {
                $this->view->mensaje = "No se ha seleccionado ningun";
                $this->view->code = "error";
            }else{
            foreach ($_POST['personal'] as $id_personal) {
                $this->model->update(['id_personal' => $id_personal,'fecha' => $fecha,'estatus' => $estatus,'hora' => $hora]);
              }
            $this->view->mensaje = "Asistencia registrada";
            $this->view->code = "success";
            }
            $this->view->filtroHorario = $filtroHorario;
            $this->buscarLista($fecha,$filtroHorario);
            // aui estaba down
            // $asistencia = $this->model->getList($fecha);
            // $this->view->asistencia = $asistencia;
            // $this->view->fecha = $fecha;
            // $this->view->render('asistencia/lista'); 
            // aui estaba up
        
    }
    function verasistenciaid($param = null){
        $idPersonal = $param[0];
        $asistencia = $this->model->get($idPersonal);
        $this->view->asistencia = $asistencia;
        $this->view->id = $idPersonal;
        
        $this->view->render('asistencia/index');
    }
        function verasistenciaidRango($param = null){
        $idPersonal = $param[0]; 
        if(isset($_POST['year'])){
            $year=$_POST['year'];
        }else{
            $year= date('Y');
        }


        $asistencia = $this->model->getRango($idPersonal,$year);
        $this->view->asistencia = $asistencia;
        $this->view->id = $idPersonal;
        $this->view->year = $year;
        $this->view->render('asistencia/index');
    }
    function generar($param = null){
     $fecha= $_POST['fecha'];
    $dia = "";
    switch (date("l")) {
        case "Saturday":
           $dia = "Sabado";
        break;
        case "Monday":
           $dia = "Lunes";
        break;
        case "Tuesday":
          $dia = "Martes";
        break;
        case "Wednesday":
          $dia = "Miercoles";
        break;
        case "Thursday":
          $dia = "Jueves";
        break;
        case "Friday":
          $dia = "Viernes";
        break;
    }
        if($this->model->insertManual(['fecha' => $fecha,'turno' => $dia, 'estatus' => 'Activo'])){
            $this->view->mensaje = "Lista Actualizada";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo activar Modo manual";
            $this->view->code = "error";
        }
        //pendiente actualizar filtroHorario
        // $filtroHorario="Matutino";
        $this->buscarLista($fecha,$filtroHorario);
    }
    // function buscar2(){
    //     $fecha='2023-05-06';
    //     $asistenciaRolar=$this->model->buscarRolar($fecha);
    //     print_r($asistenciaRolar);
    // }
        function numeroSemana(){
        $fecha = '2023-12-31'; // Cambia esta fecha por la que necesitas

        // Obtén el número de semana
        $numeroSemana = date('W', strtotime($fecha));
        
        echo "El número de semana para la fecha $fecha es: $numeroSemana";
    }
    function buscar(){
        $estatus="Activo";
        $fecha= $_POST['fecha'];
        $filtroHorario=$_POST['filtroHorario'];
        $rolar=FALSE;
        // $dia = "";
        $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        $dia = $dias[(date('N', strtotime($fecha))) - 1];
        $asistencia=$this->model->buscar(['turno' => $dia,'estatus' => $estatus,'horario' => $filtroHorario,'rolar' => $rolar]);
        $hora=consultarHoraLimite($filtroHorario);
        // print_r($asistencia);
        foreach ($asistencia as $r) {
            if($this->model->buscarManual(['id_personal' => $r['id_personal'],'fecha' => $fecha,'hora' => $hora])){
                $this->view->mensaje = "Lista Actualizada";
                $this->view->code = "success";
            }else{
                $this->view->mensaje = "Lista ya esta actualizada";
                $this->view->code = "error";
            }
          }
        //   aqui hacer recorrido de personal que rola turno
        $asistenciaRolar=$this->model->buscarRolar($fecha);
        // print_r($asistenciaRolar);
        foreach ($asistenciaRolar as $r) {
            if($this->model->buscarManualRolar(['id_personal' => $r['id_personal'],'fecha' => $fecha,'hora' => $hora])){
                $this->view->mensaje = "Lista Actualizada";
                $this->view->code = "success";
            }else{
                $this->view->mensaje = "Lista ya esta actualizada";
                $this->view->code = "error";
            }
          }
        // hasta aqui ciclo de personal que rola
        $this->actualizarEstatusRolar($fecha);
          $this->view->filtroHorario = $filtroHorario;
          $this->buscarLista($fecha,$filtroHorario);

    }
    function actualizarEstatusRolar($fecha){
        $this->model->updateEstatusRolar(['fecha' => $fecha]);
    }
    function agregarApoyo(){
            $id_personal=$_POST['personal'];
            $fecha= $_POST['fecha'];
            $estatus=$_POST['tipo'];
            //
            //
            $filtroHorario=$_POST['filtroHorario'];
            $hora=consultarEntrada($filtroHorario);
            if($this->model->insertApoyo(['id_personal' => $id_personal, 'fecha' => $fecha,'hora' => $hora,'estatus' => $estatus])){
                $this->view->mensaje = "Voluntariado agregado como ".$estatus;
                $this->view->code = "success";
            }else{
                $this->view->mensaje = "No se pudo agregar".$estatus;
                $this->view->code = "error";
            }
            // $this->view->id = $id_personal;
            // $this->view->render('asistencia/lista');
             //pendiente actualizar filtroHorario
            // $filtroHorario="Matutino";
            $this->view->filtroHorario = $filtroHorario;
            $this->buscarLista($fecha,$filtroHorario);
            // $this->paseLista();
    }
    function generarReporte(){
        $consulta  = $_POST['caja_busqueda'];
        $filtro  = $_POST['radio_busqueda'];
        $filtroHorario  = $_POST['filtroHorario'];
        $hora=consultarHoras($filtroHorario);
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $filtroOrden  = $_POST['radio_ordenar'];
        $fecha=date('Y-m-d');
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
        $salida .= "<h1>Reporte</h1>";
        $salida .= "<h1>Asistencias voluntariado</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>TURNOACTUAL</th> <th>FECHA</th> <th>HORA</th> <th>ESTATUS</th> </thead>";
        $totalAsistencias=0;
        $totalApoyo=0;
        $totalFaltas=0;
        foreach($asistencia = $this->model->getBusquedaReport($consulta,$filtro,$f_inicio,$f_termino,$filtroOrden,$hora) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".$r->turno."</td> <td>".diaSemana($r->fecha).date('d-m-Y', strtotime($r->fecha))."</td> <td>".$r->hora."</td> <td>".$r->estatus."</td></tr>";
            switch ($r->estatus) {
                case 'Asistencia':
                    $totalAsistencias++;
                    break;
                case 'Falta':
                    $totalFaltas++;
                    break;
                case 'Asistencia-Apoyo':
                    $totalApoyo++;
                    break;
                default:
                    break;
            }
        }
        $totalFinal=$totalAsistencias+$totalApoyo;
        $salida .= "<h6>Total Asistencias+Apoyo:".$totalFinal."</h6>";
        $salida .= "<h6>Total Asistencias:".$totalAsistencias."</h6>";
        $salida .= "<h6>Total Apoyo:".$totalApoyo."</h6>";
        $salida .= "<h6>Total Faltas:".$totalFaltas."</h6>";
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=asistencia_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }
    function generarReportePDF(){
        require 'libraries/fpdf/fpdf.php';
        $consulta  = $_POST['caja_busqueda'];
        $filtro  = $_POST['radio_busqueda'];
        $filtroHorario  = $_POST['filtroHorario'];
        $horario=consultarHoras($filtroHorario);
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $filtroOrden  = $_POST['radio_ordenar'];
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/logo (3).png',10,8,33);
        $pdf->SetFont('Arial','B',24);
         // Movernos a la derecha
        $pdf->Cell(83);
         // Título
        $pdf->SetTextColor(250,150,100);
        // $pdf->SetFillColor(200,220,255);
        $pdf->Cell(30,10,'Asistencia Voluntariado',0,0,'C');
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Ln(10);
        $pdf->Cell(50);
        if (isset($_POST['listaAsistencia'])) {
            $pdf->Cell(30,10,diaSemana($f_termino)." ".date('d-m-Y', strtotime($f_termino)),0,1,'c');
        }else{
            $pdf->Cell(30,10,'Del: '.$f_inicio.' al: '.$f_termino,0,1,'c');
        }

        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',11);
        $pdf->SetFillColor(250,150,100);
        $pdf->Cell(6,5,'',0,0,'c',0);
        $pdf->Cell(10,10,'ID',1,0,'c',1);
        $pdf->Cell(85,10,'NOMBRE',1,0,'c',1);
        $pdf->Cell(23,10,'FECHA',1,0,'c',1);
        $pdf->Cell(33,10,'ESTATUS',1,0,'c',1);
        $pdf->Cell(34,10,'',1,1,'c',1);
        $pdf->SetFont('Arial','',11);
        $i=1;
        $totalAsistencias=0;
        $totalApoyo=0;
        $totalFaltas=0;
        foreach($asistencia = $this->model->getBusquedaReport($consulta,$filtro,$f_inicio,$f_termino,$filtroOrden,$horario) as $r){
            $pdf->Cell(6,5,$i,0,0,'c',0);
            $pdf->Cell(10,7,$r->id_personal,1,0,'c',0);
            $pdf->Cell(85,7,utf8_decode($r->nombre),1,0,'c',0);
            $pdf->Cell(23,7,$r->fecha,1,0,'c',0);
            $pdf->Cell(33,7,$r->estatus,1,0,'c',0);
            $pdf->Cell(34,7,"",1,1,'c',0);
            $i++;
            switch ($r->estatus) {
                case 'Asistencia':
                    $totalAsistencias++;
                    break;
                case 'Falta':
                    $totalFaltas++;
                    break;
                case 'Asistencia-Apoyo':
                    $totalApoyo++;
                    break;
                default:
                    break;
            }
        }
        $totalFinal=$totalAsistencias+$totalApoyo;
        $pdf->Cell(6,20,"",0,1,'c',0);
        $pdf->Cell(6,20,"",0,0,'c',0);
        $pdf->Cell(80,7,"Total Asistencias + Apoyo: ".$totalFinal,1,0,'c',0);
        $pdf->Cell(30,7,"Asistencias: ".$totalAsistencias,1,0,'c',0);
        $pdf->Cell(30,7,"Apoyo: ".$totalApoyo,1,0,'c',0);
        $pdf->Cell(30,7,"Faltas: ".$totalFaltas,1,0,'c',0);
        $pdf->Output();
        // $pdf->Output("AsistenciasVoluntariado".time().".pdf", "D");
        // $archivo->Output("test.pdf", "D");
        }

        function eliminar($param = null){
            $id_personal = $param[0];
            $fecha=$param[1];
            $filtroHorario=$param[2];
            $year=date('Y');
    
            if($this->model->delete($id_personal,$fecha)){
                $mensaje = "voluntariado eliminado en lista";
                $this->view->code = "success";
            }else{
                $mensaje = "No se pudo eliminar voluntariado de lista";
                $this->view->code = "error";
            }
            if (isset($param[2])&&($param[2]=="ID")) {
                $asistencia = $this->model->getRango($id_personal,$year);
                $this->view->asistencia = $asistencia;
                $this->view->id = $id_personal;
                $this->view->year = $year;
                $this->view->render('asistencia/index');
            }
            if (isset($param[2])&&($param[2]=="IDCalendario")) {
                $asistencia = $this->model->get($id_personal);
                $this->view->asistencia = $asistencia;
                $this->view->id = $id_personal;
                $this->view->render('asistencia/calendario/'.$id_personal);
            }
            else{
                $this->view->mensaje = $mensaje;
                $this->view->filtroHorario = $filtroHorario;
                 //pendiente actualizar filtroHorario
                // $filtroHorario="Matutino";
                $this->buscarLista($fecha,$filtroHorario);
            }
            
        }
        // function eliminarCalendario($param = null){
        //     $id_personal = $param[0];
        //     $fecha=$param[1];
    
        //     if($this->model->delete($id_personal,$fecha)){
        //         $mensaje = "voluntariado eliminado en lista";
        //         $this->view->code = "success";
        //     }else{
        //         $mensaje = "No se pudo eliminar voluntariado de lista";
        //         $this->view->code = "error";
        //     }
        //     if (isset($param[2])&&($param[2]=="ID")) {
        //         $asistencia = $this->model->get($id_personal);
        //         $this->view->asistencia = $asistencia;
        //         $this->view->id = $id_personal;
        //         $this->view->render('asistencia/calendario');
        //     }else{
        //         $this->view->mensaje = $mensaje;
        //         $this->view->filtroHorario = $filtroHorario;
        //          //pendiente actualizar filtroHorario
        //         // $filtroHorario="Matutino";
        //         $this->buscarLista($fecha,$filtroHorario);
        //     }
            
        // }
        function reset($param = null){
            $id_personal = $param[0];
            $fecha=$param[1];
            $estatus="Falta";
            $filtroHorario=$param[2];
            $hora=consultarHoraLimite($filtroHorario);
            if($this->model->update(['id_personal' => $id_personal, 'fecha' => $fecha,'hora' => $hora,'estatus' => $estatus])){
                $mensaje = "Se desmarco la asistencia";
                $this->view->code = "success";
            }else{
                $mensaje = "No se pudo desmarcar asistencia";
                $this->view->code = "error";
            }
            $this->view->mensaje = $mensaje;
              //pendiente actualizar filtroHorario
            //   $filtroHorario="Matutino";
            $this->view->filtroHorario = $filtroHorario;
            $this->buscarLista($fecha,$filtroHorario);
        }
        public function consultarTel($id){
            $tel="";
            $query = $this->db->connect()->prepare("SELECT idnombreCompleto from vistapersonalv where id_personal=:id_personal");
            try{
                $query->execute(['id_personal' => $id]);
                while($row = $query->fetch()){
                    $tel=$row['nombreCompleto'];
                }
                return $nomb;
            }catch(PDOException $e){
                return null;
            }
        }
        function llamarModal(){
            $id_personal=$_POST['id_personal'];
            $fecha=$_POST['fecha'];
            $year=date('Y');
            //$_SESSION['BanderaFalta'];
            // $this->view->agenda =$this->model->consultarAgenda($id_personal);
            $this->view->idMotivo = $id_personal;
            $this->view->fecha = $fecha;
            $consulta=$this->model->consultarAgenda($id_personal);
            $this->view->telefonos = $consulta[0];
            $this->view->nombre = $consulta[1];
            // echo $consulta;
            // echo $consulta[0];
            // echo $consulta[1];
            if (isset($_POST['consultaID'])) {
                echo "existe";
                $asistencia = $this->model->getRango($id_personal,$year);
                $this->view->asistencia = $asistencia;
                $this->view->id = $id_personal;
                $this->view->year = $year;
                $this->view->render('asistencia/index');
            }else{
                $this->render();
            }
            
        }

        function registrarMotivo(){
            $id_personal=$_POST['id_personal'];
            $fecha=$_POST['fecha'];
            $descripcion=$_POST['descripcion'];
            $year= date('Y');

            if($this->model->insertMotivo(['id_personal' => $id_personal, 'fecha' => $fecha, 'descripcion' => $descripcion])){
                $this->view->mensaje = "Motivo registrado correctamente";
                $this->view->code = "success";
                $this->view->radio="Falta";
                if (isset($_POST['consultaID'])) {
                    $asistencia = $this->model->getRango($id_personal,$year);
                    $this->view->asistencia = $asistencia;
                    $this->view->id = $id_personal;
                    $this->view->year = $year;
                    $this->view->render('asistencia/index');
                }else{
                    $this->render();
                }
                
            }else{
                $this->view->mensaje = "Ya existe motivo registrado";
                $this->view->code = "error";
                $this->render();
            }
        }
        function marcarjustificado($param=null){
            // include_once 'libraries/session.php';
            // echo $autorizo=$_SESSION['idUser'];
            $id_personal=$param[0];
            $fecha=$param[1];
            $estatus="Falta-Justificada";
            $hora='0000-00-00';
            $estatusEstado  = "Autorizado";
            $fecha_apertura  = date("Y-m-d");
            $tipo  = "Justificante";
            $fecha_solicitada  = $fecha;
            $autorizo=$_SESSION['idUser'];
            $year=date('Y');

            if($this->model->update(['id_personal' => $id_personal, 'fecha' => $fecha, 'hora' => $hora, 'estatus' => $estatus])){
                $this->model->updateEstatus(['id_personal' => $id_personal,'estatus' => "Activo"]);

                $this->model->insertJustificar(['id_personal' => $id_personal,
                                         'fecha_apertura' => $fecha_apertura, 'tipo' => $tipo, 'fecha_solicitada' => $fecha_solicitada,
                                          'estatus' => $estatusEstado,'autorizo' => $autorizo]);

                $this->view->mensaje = "Marcado como Justificada";
                $this->view->code = "success";
            }else{
                $this->view->mensaje = "No se pudo justificar";
                $this->view->code = "error";
            }
            if (isset($param[2])) {
                $this->render();
            }else{
                $asistencia = $this->model->getRango($id_personal, $year);
                $this->view->asistencia = $asistencia;
                $this->view->id = $id_personal;
                $this->view->year = $year;
                $this->view->render('asistencia/index');
            }
            
        }
}

?>