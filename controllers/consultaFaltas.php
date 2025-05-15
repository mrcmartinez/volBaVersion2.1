<?php

class ConsultaFaltas extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->faltas = [];
        $this->view->mensaje = "";
        $this->view->filtroHorario = "";
    }
function render(){
    $consulta = "";
    $filtroHorario = "";
        if (isset($_POST['caja_busqueda'])) {
            $consulta = $_POST['caja_busqueda'];
            $filtroHorario = $_POST['filtroHorario'];
        }
    // echo "controlador";
   
    // $this->view->render('faltas/index');
    // $this->view->render('faltas');

    $faltas = $this->model->get($consulta,$filtroHorario);
    $this->view->faltas = $faltas;
    $this->view->mensaje;
    $this->view->filtroHorario=$filtroHorario;
    $this->view->consulta=$consulta;
    $this->view->render('faltas/index');
}
function generarReporte(){
    $filtroHorario = $_POST['filtroHorario'];
    $consulta = $_POST['caja_busqueda'];
    // $filtro = $_POST['radio_busqueda'];
    $fecha=date('Y-m-d');
    $absoluta= constant('URL')."assets/img/logoXLS.png";
    $salida = "";
    $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
    $salida .= "<h1>Reporte</h1>";
    $salida .= "<h1>Voluntariado Faltas Totales</h1>";
    $salida .= "<table>";
    $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>DIA</th> <th>HORARIO</th> <th>FECHA_INGRESO</th> <th>TOTAL</th> <th>FECHAS</th> </thead>";
    foreach($falats=$this->model->get($consulta,$filtroHorario) as $r){
        $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".utf8_decode($r->turno)."</td> <td>".utf8_decode($r->horario)."</td> <td>".$r->fecha_ingreso."</td><td>".$r->total_faltas."</td> <td>".$r->fecha_faltas."</td></tr>";
    }
    $salida .= "</table>";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=voluntariado_".time().".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $salida;
}
function generarReportePDF(){
    require 'libraries/fpdf/fpdf.php';
    $consulta = $_POST['caja_busqueda'];
    // $filtro = $_POST['radio_busqueda'];
    $filtroHorario = $_POST['filtroHorario'];
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(0,10,"impreso".date('Y-m-d'),0,1,'R');
    $pdf->Image('assets/img/logo (3).png',10,8,33);
    $pdf->SetFont('Arial','B',24);
     // Movernos a la derecha
    $pdf->Cell(80);
     // Título
    $pdf->SetTextColor(250,150,100);
    // $pdf->SetFillColor(200,220,255);
    $pdf->Cell(30,10,'Total Faltas',0,0,'C');
    $pdf->SetTextColor(0);
    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetFillColor(250,150,100);
    $pdf->Cell(6,5,'',0,0,'c',0);
    $pdf->Cell(10,10,'ID',1,0,'c',1);
    $pdf->Cell(75,10,'NOMBRE',1,0,'c',1);
    // $pdf->Cell(30,10,'PATERNO',1,0,'c',1);
    // $pdf->Cell(30,10,'MATERNO',1,0,'c',1);
    // $pdf->Cell(22,10,'TURNO',1,0,'c',1);
    $pdf->Cell(25,10,'Turno',1,0,'c',1);
    // $pdf->Cell(22,10,'ESTATUS',1,0,'c',1);
    // $pdf->Cell(15,10,'Horario',1,0,'c',1);
    $pdf->Cell(25,10,'fecha_ingreso',1,0,'c',1);
    $pdf->Cell(15,10,'total',1,0,'c',1);
    $pdf->Cell(90,10,'fechas',1,1,'c',1);
    $pdf->SetFont('Arial','',10);
    $i=1;
    foreach($personal=$this->model->get($consulta,$filtroHorario) as $r){
        $pdf->Cell(6,5,$i,0,0,'c',0);
        $pdf->Cell(10,7,$r->id_personal,1,0,'c',0);
        // $pdf->Cell(40,10,utf8_decode($r->nombre),1,0,'c',0);
        $pdf->Cell(75,7,utf8_decode($r->nombre),1,0,'c',0);
        // $pdf->Cell(30,10,utf8_decode($r->apellido_materno),1,0,'c',0);
        // $pdf->Cell(22,10,$r->turno,1,0,'c',0);
        $pdf->Cell(25,7,$r->turno,1,0,'c',0);
        $pdf->Cell(25,7,$r->fecha_ingreso,1,0,'c',0);
        $pdf->Cell(15,7,$r->total_faltas,1,0,'c',0);
        $pdf->Cell(90,7,$r->fecha_faltas,1,1,'c',0);
        // $pdf->Cell(15,7,"",1,0,'c',0);
        // $pdf->Cell(15,7,"",1,0,'c',0);
        // $pdf->Cell(22,10,$r->estatus,1,0,'c',0);
        // $pdf->Cell(45,7,'',1,1,'c',0);
        $i++;
    }
    // for ($i=0; $i < 8; $i++) { 
    //     $pdf->Cell(6,7,'',0,0,'c',0);
    //     $pdf->Cell(10,7,'',1,0,'c',0);
    //     // $pdf->Cell(40,10,utf8_decode($r->nombre),1,0,'c',0);
    //     $pdf->Cell(75,7,' ',1,0,'c',0);
    //     // $pdf->Cell(30,10,utf8_decode($r->apellido_materno),1,0,'c',0);
    //     // $pdf->Cell(22,10,$r->turno,1,0,'c',0);
    //     $pdf->Cell(25,7,'',1,0,'c',0);
    //     $pdf->Cell(15,7,"",1,0,'c',0);
    //     $pdf->Cell(15,7,"",1,0,'c',0);
    //     // $pdf->Cell(22,10,$r->estatus,1,0,'c',0);
    //     $pdf->Cell(45,7,'',1,1,'c',0);
    // }
    $pdf->Output();
    // $pdf->Output("VoluntariadoTotalFaltas".time().".pdf", "D");
    // $archivo->Output("test.pdf", "D");
    }

}