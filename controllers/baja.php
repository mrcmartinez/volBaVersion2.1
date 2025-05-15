<?php

class Baja extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->baja = [];
        $this->view->mensaje = "";
        $this->view->consulta = "";
    }

    public function render()
    {
        $f_inicio=date('Y-m-01');
        $f_termino=date('Y-m-d');
        $busqueda='';
        if(isset($_POST['fecha_inicio'])){
            $f_inicio  = $_POST['fecha_inicio'];
            $f_termino  = $_POST['fecha_termino'];
        }
        if (!empty($_POST['caja_busqueda_baja'])) {
            $busqueda=$_POST['caja_busqueda_baja'];
            $f_inicio=date('2000-01-01');
            $f_termino=date('Y-m-d');
        }
        $baja = $this->model->getBusqueda($f_inicio,$f_termino,$busqueda);
        $this->view->baja = $baja;
        $this->view->inicio = $f_inicio;
        $this->view->termino = $f_termino;
        $this->view->render('bajas/reporte');
    }

    function generarReporte(){
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $fecha=date('Y-m-d');
        $busqueda="";
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
        $salida .= "<h1>Reporte</h1>";
        $salida .= "<h1>Bajas voluntariado</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>FECHA</th> <th>MOTIVO</th> </thead>";
        foreach($asistencia = $this->model->getBusqueda($f_inicio,$f_termino,$busqueda) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".$r->fecha."</td> <td>".utf8_decode($r->motivo)."</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=bajas_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }
    function generarReportePDF(){
        require 'libraries/fpdf/fpdf.php';
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $busqueda="";
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,10,"Impreso el ".date('Y-m-d'),0,1,'R');
        $pdf->Image('assets/img/logo (3).png',10,8,33);
        $pdf->SetFont('Arial','B',24);
         // Movernos a la derecha
        $pdf->Cell(80);
         // Título
        $pdf->SetTextColor(250,150,100);
        // $pdf->SetFillColor(200,220,255);
        $pdf->Cell(30,10,'Bajas Voluntariado',0,1,'C');
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(70);
        $pdf->Cell(50,10,'De: '.$f_inicio.' a: '.$f_termino,0,1,'c');
        $pdf->Ln(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetFillColor(250,150,100);
        $pdf->Cell(6,5,'',0,0,'c',0);
        $pdf->Cell(15,10,'ID',1,0,'c',1);
        $pdf->Cell(80,10,'NOMBRE',1,0,'c',1);
        $pdf->Cell(40,10,'FECHA DE BAJA',1,1,'c',1);
        // $pdf->Cell(140,10,'MOTIVO',1,1,'c',1);
        $pdf->SetFont('Arial','',11);
        $i=1;
        foreach($asistencia = $this->model->getBusqueda($f_inicio,$f_termino,$busqueda) as $r){
            $pdf->Cell(6,5,$i,0,0,'c',0);
            $pdf->Cell(15,10,$r->id_personal,1,0,'c',0);
            $pdf->Cell(80,10,utf8_decode($r->nombre),1,0,'c',0);
            $pdf->Cell(40,10,$r->fecha,1,1,'c',0);
            $i++;
        //    pdf->MultiCell(140,10,$r->motivo, 'LRT', 'L', 0);
        }
        $pdf->Output();
        // $pdf->Output("BajasVoluntariado".time().".pdf", "D");
        // $archivo->Output("test.pdf", "D");
        }
}
