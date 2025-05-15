<?php

class Documento extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->documento = [];
        $this->view->mensaje = "";
        $this->view->consulta = "";
    }

    public function render()
    {
        $consulta = "";
        if (isset($_POST['caja_busqueda'])) {
            $consulta = $_POST['caja_busqueda'];
        }
        $documento = $this->model->getBusqueda($consulta);
        $this->view->documento = $documento;
        $this->view->consulta = $consulta;
        $this->view->render('documentacion/reporte');
    }

    public function nuevoDocumento($param = null)
    {
        $id_personal = $param[0];
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = "";
        $this->view->render('documentacion/nuevoRegistro');
    }

    public function registrarNuevo()
    {
        $id_personal = $_POST['id_personal'];
        $mensaje = "";
        $nombre = $_POST['nombre'];
        $estatus = "Entregado";
        
        //Se verifica que el archivo sea PDF
        if (($_FILES['descripcion']['type'] !='application/pdf')&&($_FILES['descripcion']['size'] > 1000000)){
            $mensaje =  "El archivo NO es pdf";
            $this->view->ultimoId = $id_personal;
            $this->view->mensaje = $mensaje;
            $this->view->render('documentacion/nuevoRegistro');
        }else{
            // echo "El archivo SI es pdf";  
        $file_name = $_FILES['descripcion']['name'];
        // echo "file_name es: ".$file_name;
        $file_tmp = $_FILES['descripcion']['tmp_name'];
        
        $micarpeta = "assets/img/documentacion/".$id_personal;
        if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
        }
        $route = "assets/img/documentacion/".$id_personal."/" . $file_name;
        $descripcion = $file_name;
        move_uploaded_file($file_tmp, $route);
        if ($this->model->insert(['id_personal' => $id_personal, 'nombre' => $nombre,
            'descripcion' => $descripcion, 'estatus' => $estatus])) {
            $mensaje = $mensaje . "Se entrego: " . $nombre . "\n";
        } else {
            $mensaje = $mensaje . "Ya existe" . $nombre . "\n";
        }
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = $mensaje;
        $this->view->render('documentacion/nuevoRegistro');
        }
   
    }

    public function registrarDocumento()
    {
        $id_personal = $_POST['id_personal'];
        $mensaje = "";
        for ($i = 1; $i < 10; $i++) {
            if (
                isset($_POST['nombre_' . $i]) &&
                isset($_FILES['descripcion_' . $i]['name']) && ($_FILES['descripcion_' . $i]['name'] != null)
            ) {
                $nombre = $_POST['nombre_' . $i];
                $estatus = "Entregado";
                $file_name = $_FILES['descripcion_' . $i]['name'];
                $file_tmp = $_FILES['descripcion_' . $i]['tmp_name'];
                $micarpeta = "assets/img/documentacion/".$id_personal;
                if (!file_exists($micarpeta)) {
                    mkdir($micarpeta, 0777, true);
                    }
                $route = "assets/img/documentacion/".$id_personal."/" . $file_name;
                // $route = "assets/img/" . $file_name;
                $descripcion = $file_name;
                move_uploaded_file($file_tmp, $route);
                if ($this->model->insert(['id_personal' => $id_personal, 'nombre' => $nombre,
                    'descripcion' => $descripcion, 'estatus' => $estatus])) {
                    $mensaje = $mensaje . "Se entrego: " . $nombre . "\n";
                } else {
                    $mensaje = $mensaje . "Ya existe" . $nombre . "\n";
                }
            }
        }
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = $mensaje;
        $this->view->render('documentacion/index');
    }

    public function verdocumentoid($param = null)
    {
        $idPersonal = $param[0];
        $documento = $this->model->get($idPersonal);
        $this->view->id = $idPersonal;
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
    }

    public function eliminardocumento($param = null)
    {
        $id_personal = $param[0];
        $nombre = $param[1];
        if ($this->model->delete($id_personal, $nombre)) {
            $mensaje = "Documento eliminado correctamente";
        } else {
            $mensaje = "No se pudo eliminar el documento";
        }
        $this->view->mensaje = $mensaje;
        $documento = $this->model->get($id_personal);
        $this->view->id = $id_personal;
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
    }
    public function generarReporte()
    {
        $consulta = $_POST['caja_busqueda'];
        $fecha=date('Y-m-d');
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
        $salida .= "<h1>Reporte</h1>";
        $salida .= "<h1>Documentacion Entregada</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>TIPO</th> <th>ESTATUS</th></thead>";
        foreach ($documento = $this->model->getBusqueda($consulta) as $r) {
            $salida .= "<tr> <td>" . $r->id_personal . "</td> <td>" .utf8_decode($r->nombre_personal). "</td> <td>" . $r->nombre . "</td> <td>" . $r->estatus . "</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Documentacion_" . time() . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }

    public function generarReportePDF()
    {
        require 'libraries/fpdf/fpdf.php';
        $consulta = $_POST['caja_busqueda'];
        $fecha=date('Y-m-d');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/logo (3).png', 10, 8, 33);
        $pdf->SetFont('Arial', 'B', 24);
        // Movernos a la derecha
        $pdf->Cell(80);
        // Título
        $pdf->SetTextColor(250, 150, 100);
        // $pdf->SetFillColor(200,220,255);
        $pdf->Cell(30, 10, 'Documentacion personal voluntariado', 0, 0, 'C');
        $pdf->SetTextColor(0);
        $pdf->Ln(30);
        $pdf->Cell(50);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(30,10,'Fecha: '.$fecha,0,1,'c');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(250, 150, 100);
        $pdf->Cell(10, 10, 'ID', 1, 0, 'c', 1);
        $pdf->Cell(80, 10, 'NOMBRE', 1, 0, 'c', 1);
        $pdf->Cell(60, 10, 'Documento', 1, 0, 'c', 1);
        $pdf->Cell(22, 10, 'ESTATUS', 1, 1, 'c', 1);
        $pdf->SetFont('Arial', '', 12);
        foreach ($personal = $this->model->getBusqueda($consulta) as $r) {
            // $salida .= "<tr> <td>".$r->id_personal."</td> <td>".$r->nombre."</td> <td>".$r->apellido_paterno."</td> <td>".$r->apellido_materno."</td> <td>".$r->turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td></tr>";
            $pdf->Cell(10, 10, $r->id_personal, 1, 0, 'c', 0);
            $pdf->Cell(80, 10, utf8_decode($r->nombre_personal), 1, 0, 'c', 0);
            $pdf->Cell(60, 10, $r->nombre, 1, 0, 'c', 0);
            $pdf->Cell(22, 10, $r->estatus, 1, 1, 'c', 0);
        }
        $pdf->Output();
        // $pdf->Output("Documnetacion".time().".pdf", "D");
        // $archivo->Output("test.pdf", "D");
    }
    function verDocumento($param = null){
        $id= $param[0];
        $descripcion= $param[1];
        $route = "assets/img/documentacion/".$id."/" . $descripcion;
        echo $route;
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=documentacion".time().".pdf");
        readfile($route);
        
    } 
}