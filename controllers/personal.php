<?php require 'libraries/session.php';?>
<?php

class Personal extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->personal = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
        $filtroHorario="";
    }

    function render(){
        // $personal = $this->model->getBusqueda($consulta,$filtro,$filtroHorario);
        if (isset($_POST['reingreso'])) {
            $this->view->render('personal/reingreso');
        }else{
            $this->view->render('personal/nuevo');
        }
        
    }

    function registrarPersonal(){
        $id_personal=null;
        if (!empty($_POST['id_personal'])) {
            $id_personal=$_POST['id_personal'];
        }
        $fecha_ingreso  = $_POST['fecha_ingreso'];
        $nombre    = trim($_POST['nombre']);
        $apellido_paterno  = trim($_POST['apellido_paterno']);
        $apellido_materno  = trim($_POST['apellido_materno']);
        $calle  = trim($_POST['calle']);
        $colonia  = trim($_POST['colonia']);
        $numero_exterior  = $_POST['numero_exterior'];
        $fecha_nacimiento  = $_POST['fecha_nacimiento'];
        $estado_civil  = $_POST['estado_civil'];
        $numero_hijos  = $_POST['numero_hijos'];
        $seguro_medico  = $_POST['seguro_medico'];
        $escolaridad  = trim($_POST['escolaridad']);
        $rolar=FALSE;
        $turno  = $_POST['turno'];
        if ($_POST['turno']=='Rolar') {
            $turno  = 'Sabado';
            $rolar=TRUE;
        }
        $horario  = $_POST['horario'];
        $actividad  = $_POST['actividad'];
        $ocupacion  = $_POST['ocupacion'];
        $estatus  = $_POST['estatus'];
        $mensaje = "";
        $consulta = $this->model->insert(['id_personal' => $id_personal,'nombre' => $nombre, 'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,'calle' => $calle,
        'colonia' => $colonia,'numero_exterior' => $numero_exterior,
        'fecha_nacimiento' => $fecha_nacimiento,
        'estado_civil' => $estado_civil,'numero_hijos' => $numero_hijos,
        'seguro_medico' => $seguro_medico,'escolaridad' => $escolaridad,'turno' => $turno,'horario' => $horario,'actividad' => $actividad,'fecha_ingreso' => $fecha_ingreso,'ocupacion' => $ocupacion,'rolar' => $rolar,'estatus' => $estatus]);
        

        if($consulta[0]){
            if (!empty($_POST['id_personal'])) {
                $mensaje = "Voluntariado creado con ID ".$id_personal." llene la informacion adicional";
                $_SESSION['nombreVol']=$apellido_paterno.' '.$apellido_materno.' '.$nombre;
                $this->registrarQr($id_personal);
                $this->view->mensaje = $mensaje;
                $this->view->ultimoId = $id_personal;
                // $this->view->render('telefono/nuevo');
            }
            $mensaje = "Voluntariado creado con ID ".$consulta[1]." llene la informacion adicional";
            if (isset($_POST['id_candidato'])) {
                $this->eliminarCandidato($_POST['id_candidato']);
            }
            $_SESSION['nombreVol']=$apellido_paterno.' '.$apellido_materno.' '.$nombre;
            // include_once 'controllers/qr.php';
            // $codeQr = new Qr();
            $this->registrarQr($consulta[1]);
            $this->view->mensaje = $mensaje;
            $this->view->ultimoId = $consulta[1];
            $this->view->render('telefono/nuevo');
            // return true;
        }else{
            $mensaje = "ID Voluntario ya existe";
            $this->view->mensaje = $mensaje;
            $this->render();
            // return false;
        }
    }
    function listarPersonal($param = null){
        $consulta  = "";
        $filtro="Activo";
        $filtroHorario="";
        $rolar=False;
        if (isset($_POST['caja_busqueda']))
            $consulta  = $_POST['caja_busqueda'];
            if ($consulta=='rolar') {
                $rolar=True;
                $consulta='';
            }
            if (isset($_POST['filtroHorario']))
            $filtroHorario  = $_POST['filtroHorario'];
        if (isset($_POST['radio_busqueda']))
            "radio busueda: ".$filtro  = $_POST['radio_busqueda'];   
        $personal = $this->model->getBusquedaLista($consulta,$filtro,$filtroHorario);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->filtroHorario = $filtroHorario;
        if (isset($param[0])) {
            $this->view->idCurso = $param[0];
            if (isset($param[2])) {
                $_SESSION['nombreCurso']=$param[2];
            }
            $this->view->estado = "Activo";
            $this->view->render('personal/asignar');
        }else{
            if (isset($_POST['mensaje'])) {
                $this->view->mensaje = "Añadido correctamente";
                $this->view->code = "success";
            }
            $this->view->render('personal/index');
        }
    }
    function seleccionarPersonal(){
        $consulta  = "";
        $filtro="Activo";
        $tipo=$_POST['tipo'];
        $rolar=false;
        //filtroHorario para buscar todo(matutino y vespertino)
        $filtroHorario="";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
            if ($consulta=='rolar') {
                $rolar=True;
                $consulta='';
            }
        }
        $personal = $this->model->getBusqueda($consulta,$filtro,$filtroHorario,$rolar);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        if ((isset($_POST['listaApoyo']))OR(isset($_POST['listaAsistencia']))) {
            //llamar vista para seleccionar apoyo
            // if (isset($_POST['listaApoyo'])) {
            //     $this->view->tipo= "Apoyo";
            // }else{
            //     $this->view->tipo= "Asistencia";
            // }
            $this->view->filtroHorario=$_POST['filtroHorario'];
            $this->view->tipo= $tipo;
            $this->view->fecha= $_POST['fecha'];
            $this->view->render('personal/seleccionarApoyo');
        }else{
            //llamar vista para seleccionar peticion
            $this->view->tipo = $_POST['peticion'];
            $this->view->render('personal/seleccionar');
        }
    }

    function verPersonal($param = null){
        $idPersonal = $param[0];
        $personal = $this->model->getById($idPersonal);
        $this->view->personal = $personal;
        $edad_diff = date_diff(date_create($personal->fecha_nacimiento), date_create(date("Y-m-d")));
        $edadCalculada = $edad_diff->format('%y');
        $this->view->edadCalculada = $edadCalculada;
        $this->view->mensaje = "";
        $this->view->render('personal/detalle');
    }
    function verInformacion($param = null){
        $idPersonal = $param[0];
        $personal = $this->model->getById($idPersonal);
        $this->view->personal = $personal;
        $edad_diff = date_diff(date_create($personal->fecha_nacimiento), date_create(date("Y-m-d")));
        $edadCalculada = $edad_diff->format('%y');
        $this->view->edadCalculada = $edadCalculada;
        $this->view->mensaje = "";
        $_SESSION['nombreVol']=$personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre;
        $this->view->render('personal/informacion');
    }

    function actualizarPersonal(){
        $id_personal = $_POST['id_personal'];
        $nombre    = $_POST['nombre'];
        $estatus  = $_POST['estatus'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $calle = $_POST['calle'];
        $colonia = $_POST['colonia'];
        $numero_exterior = $_POST['numero_exterior'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $estado_civil = $_POST['estado_civil'];
        $numero_hijos = $_POST['numero_hijos'];
        $seguro_medico = $_POST['seguro_medico'];
        $escolaridad = $_POST['escolaridad'];
        $rolar=FALSE;
        $turno  = $_POST['turno'];
        if ($_POST['turno']=='Rolar') {
            $turno  = 'Sabado';
            $rolar=TRUE;
        }
        $horario  = $_POST['horario'];
        $actividad = $_POST['actividad'];
        $ocupacion = $_POST['ocupacion'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        
        if($this->model->update(['id_personal' => $id_personal, 'nombre' => $nombre, 'estatus' => $estatus,
         'apellido_paterno' => $apellido_paterno,
         'apellido_materno' => $apellido_materno,
         'calle' => $calle,
         'colonia' => $colonia,
         'numero_exterior' => $numero_exterior,
         'fecha_nacimiento' => $fecha_nacimiento,
         'estado_civil' => $estado_civil,
         'numero_hijos' => $numero_hijos,
         'seguro_medico' => $seguro_medico,
         'escolaridad' => $escolaridad,
         'turno' => $turno,
         'horario' => $horario,
         'fecha_ingreso' => $fecha_ingreso,
         'ocupacion' => $ocupacion,
         'rolar' => $rolar,
         'actividad' => $actividad] )){
            $this->view->mensaje = "Personal actualizado correctamente";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo actualizar el Personal";
            $this->view->code = "error";
        }
        $this->listarPersonal();
    }
    function llamarBaja($param = null){
        $this->view->nombre =$this->model->consultarId($param[0]);
        if (isset($param[1])) {
            $this->view->idNote = $param[0];
            $this->view->tipo = $param[1];
            // $this->view->nombre =$this->model->consultarId($param[0]);
        }else{
            $this->view->idBaja = $param[0];
        }
        $this->listarPersonal();
    }
    
    function eliminarPersonal($param = null){
        $fecha=date("Y-m-d");
            if (isset($_POST['id_personal'])) {
            $id_personal=$_POST['id_personal'];
            $motivo=$_POST['motivo'];
            $estatus = "Activo";
        }    
        if($this->model->delete($id_personal,$estatus)){
            $mensaje = "Listado actualizado";
            $this->view->code = "success";
            $this->model->insertBaja(['id_personal' => $id_personal,'fecha' => $fecha,'motivo' => $motivo]);
        }else{
            $this->view->code = "error";
            $mensaje = "No se pudo modificar el personal";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
    }

    function altaPersonal($param = null){
        $fecha=date("Y-m-d");
        if (isset($param[0])) {
            $id_personal = $param[0];
            $estatus = $param[1];
        }
        if($this->model->delete($id_personal,$estatus)){
            $mensaje = "Listado actualizado";
            $this->view->code = "success";
            $this->model->deleteBajaMotivo($id_personal);
            // $this->model->updateIngreso(['id_personal' => $id_personal,'fecha_ingreso' => $fecha]);
        }else{
            $this->view->code = "error";
            $mensaje = "No se pudo modificar el personal";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
    }

    function generarReporte(){
        $filtroHorario = $_POST['filtroHorario'];
        $consulta = $_POST['caja_busqueda'];
        $filtro = $_POST['radio_busqueda'];
        $fecha=date('Y-m-d');
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
        $salida .= "<h1>Reporte</h1>";
        $salida .= "<h1>Voluntariado</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>APELLIDO PATERNO</th> <th>APELLIDO MATERNO</th> <th>TURNO</th> <th>ACTIVIDAD</th> <th>ESTATUS</th> <th>INGRESO</th> <th>ESCOLARIDAD</th> <th>CIVIL</th> <th>HIJOS</th> <th>F.NACIMIENTO</th> <th>DIA</th> <th>MES</th> <th>AÑO</th> <th>EDAD</th></thead>";
        foreach($personal=$this->model->getBusquedaAll($consulta,$filtro,$filtroHorario) as $r){
            if ($consulta=='') {
                $turno= $r->rolar ? 'Rolar' : $r->turno;
                $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".utf8_decode($r->apellido_paterno)."</td> <td>".utf8_decode($r->apellido_materno)."</td> <td>".$turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td> <td>".$r->fecha_ingreso."</td> <td>".$r->escolaridad."</td> <td>".$r->estado_civil."</td> <td>".$r->numero_hijos."</td> <td>".$r->fecha_nacimiento."</td> <td>".formatDay($r->fecha_nacimiento)."</td> <td>".formatMonth($r->fecha_nacimiento)."</td> <td>".formatYear($r->fecha_nacimiento)."</td> <td>".edad($r->fecha_nacimiento)."</td></tr>";
            }else{
                if (!$r->rolar) {
                    $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".utf8_decode($r->apellido_paterno)."</td> <td>".utf8_decode($r->apellido_materno)."</td> <td>".$r->turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td> <td>".$r->fecha_ingreso."</td> <td>".$r->escolaridad."</td> <td>".$r->estado_civil."</td> <td>".$r->numero_hijos."</td> <td>".$r->fecha_nacimiento."</td> <td>".formatDay($r->fecha_nacimiento)."</td> <td>".formatMonth($r->fecha_nacimiento)."</td> <td>".formatYear($r->fecha_nacimiento)."</td> <td>".edad($r->fecha_nacimiento)."</td></tr>";
                }
                
            }
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=voluntariado_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }

    function generarReportePDF(){
$filtroHorario='';
    require 'libraries/fpdf/fpdf.php';
    $rolar=false;
    $consulta = $_POST['caja_busqueda'];
    if ($consulta=='rolar') {
        $rolar=True;
        $consulta='';
    }
    $filtro = $_POST['radio_busqueda'];
if(isset($_POST['filtroHorario'])){
    $filtroHorario = $_POST['filtroHorario'];
}
    $pdf = new FPDF();
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
    $pdf->Cell(30,10,'Voluntariado',0,0,'C');
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
    $pdf->Cell(25,10,'ACTIVIDAD',1,0,'c',1);
    // $pdf->Cell(22,10,'ESTATUS',1,0,'c',1);
    $pdf->Cell(15,10,'Asistio',1,0,'c',1);
    $pdf->Cell(15,10,'Mandil',1,0,'c',1);
    $pdf->Cell(45,10,'Costo',1,1,'c',1);
    $pdf->SetFont('Arial','',11);
    $i=1;
    foreach($personal=$this->model->getBusqueda($consulta,$filtro,$filtroHorario,$rolar) as $r){
        // if ($consulta) {
        $pdf->Cell(6,5,$i,0,0,'c',0);
        $pdf->Cell(10,7,$r->id_personal,1,0,'c',0);
        $pdf->Cell(75,7,utf8_decode($r->apellido_paterno.' '.$r->apellido_materno.' '.$r->nombre),1,0,'c',0);
        $pdf->Cell(25,7,$r->actividad,1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        $pdf->Cell(45,7,'',1,1,'c',0);
        // }
        
    // }
        $i++;
    }
    for ($i=0; $i < 8; $i++) { 
        $pdf->Cell(6,7,'',0,0,'c',0);
        $pdf->Cell(10,7,'',1,0,'c',0);
        // $pdf->Cell(40,10,utf8_decode($r->nombre),1,0,'c',0);
        $pdf->Cell(75,7,' ',1,0,'c',0);
        // $pdf->Cell(30,10,utf8_decode($r->apellido_materno),1,0,'c',0);
        // $pdf->Cell(22,10,$r->turno,1,0,'c',0);
        $pdf->Cell(25,7,'',1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        // $pdf->Cell(22,10,$r->estatus,1,0,'c',0);
        $pdf->Cell(45,7,'',1,1,'c',0);
    }
    $pdf->Output();
    // $pdf->Output("Voluntariado".time().".pdf", "D");
    // $archivo->Output("test.pdf", "D");
    }

    function code($params=null){
        require 'libraries/phpqrcode/qrlib.php';
        $id_personal=$params[0];
        if (empty($this->model->consultarIden($id_personal))) {
            $this->registrarQr($id_personal);
        }
        $identificador=$this->model->consultarIden($id_personal);
        $nombre=$this->model->consultarId($id_personal);
        $personal=$this->model->getById($id_personal);
        $file = "QR/qr".$id_personal.".png";
        $content = $id_personal.",".$nombre.",".$identificador;
        $ecc = 'H';
        $pixel_size = 3;
        $frame_size = 3;
         QRcode::png($content, $file, $ecc, $pixel_size, $frame_size);
         $img=constant('URL').$file;
       echo "
    <style>
        .tarjeta {
            width: fit-content;
            padding: 0.1cm;
            border: 0.1px solid #000;
            text-align: center;
            display: inline-block;
            font-family: Arial, sans-serif;
        }
        .tarjeta img {
            display: block;
            margin: 0 auto 10px auto;
        }
        .tarjeta h6 {
            margin: 2px 0;
            line-height: 1.2;
        }
        .tarjeta h6:last-of-type {
            margin-bottom: 8px;
        }
    </style>
    <div class='tarjeta'>
        <h2>VolBaL</h2>
        <img src='$img'>
        <h6><small>$id_personal - $personal->apellido_paterno $personal->apellido_materno</small></h6>
        <h6><small>$personal->nombre</small></h6>
    </div>
";


    }
    function registrarQr($id){
        $id_personal = $id;
        $fecha=date("Y-m-d");
        $identificador=mt_rand(5, 15);
        $this->model->insertQr(['id_personal' => $id_personal, 'identificador' => $identificador,
        'fecha_modificacion' => $fecha]);
    }
    function eliminarCandidato($id){
        $estatus="Aceptado";
        $this->model->deleteCandidato($id,$estatus);
    }
    function eliminarVoluntariado($param = null){
        $id_personal = $param[0];

        if($this->model->deleteVoluntariado($id_personal)){
            $mensaje = "Voluntariado eliminado correctamente";
            $this->view->code = "success";
        }else{
            $mensaje = "No se pudo eliminar el voluntariado";
            $this->view->code = "error";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
    }
    // function NumeroSemana(){
    //     $fecha = '2024-12-15'; // Cambia esta fecha por la que necesitas

    //     // Obtén el número de semana
    //     $numeroSemana = date('W', strtotime($fecha));
        
    //     echo "El número de semana para la fecha $fecha es: $numeroSemana";
    // }
    //mostrarSiguientesCat
    function listarSiguiente($param = null){
        $consulta  = "";
        $filtro="Activo";
        $filtroHorario="";
        if (isset($_POST['caja_busqueda']))
            $consulta  = $_POST['caja_busqueda'];
        if (isset($_POST['filtroHorario']))
            $filtroHorario  = $_POST['filtroHorario'];
        if (isset($_POST['radio_busqueda']))
            "radio busueda: ".$filtro  = $_POST['radio_busqueda'];   
        $personal = $this->model->getBusquedaSig($consulta,$filtro,$filtroHorario);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->filtroHorario = $filtroHorario;
        // if (isset($param[0])) {
            //$this->view->idCurso = $param[0];
            // if (isset($param[2])) {
            //     $_SESSION['nombreCurso']=$param[2];
            // }
            // $this->view->estado = "Activo";
            // $this->view->render('personal/asignar');
        // }else{
            // if (isset($_POST['mensaje'])) {
            //     $this->view->mensaje = "Añadido correctamente";
            //     $this->view->code = "success";
            // }
            // $this->view->render('personal/index');
        // }
        $this->view->render('personal/siguienteCat');
    }
    function actualizarEstado(){
        //actulizacion de estatus por año voluntarias pendientes con 4 faltas, activas con menos de 3 
        if($this->model->updateEstado()&&$this->model->updateEstadoFalta()){
            // $this->model->updateEstatus(['id_personal' => $id_personal,'estatus' => "Activo"]);
            $this->view->mensaje = "estado actualizado";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo actualizar estado";
            $this->view->code = "error";
        }
        $this->listarPersonal();
        // $this->model->updateEstatus();
    }
    function crearNota(){
        $id_personal = $_POST['id_personal'];
        $tipo=$_POST['tipo'];
        $comentario  = $_POST['comentario'];
        if($this->model->insertNota(['id_personal' => $id_personal, 'tipo' => $tipo,
                                 'comentario' => $comentario])){
            // $this->view->mensaje = "nota creada correctamente";
            $mensaje = "nota creada correctamente";
            $this->view->code = "success";// $this->view->render('usuario/nuevo');
        }else{
            $this->view->mensaje = "nota ya está registrada";
            $this->view->code = "error";
            // $this->view->render('curso/nuevo');
        }
        $this->listarPersonal();
    }
    function eliminar_nota($params = null){
        $id_personal = $params[0];
        $tipo = $params[1];
        // echo "entro a eliminar";

        if($this->model->deleteNote($id_personal,$tipo)){
            $mensaje = "Nota eliminada correctamente";
            $this->view->code = "success";
        }else{
            $mensaje = "No se pudo eliminar la nota";
            $this->view->code = "error";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
        // $telefono = $this->model->get($id_personal);
        // $this->view->telefono = $telefono;
        // $this->view->id = $id_personal;
        // $this->view->render('telefono/index');
    } 

    function modalNote(){
        $cadena = $_POST['tipo'];
        $cadena.= $_POST['comentario'];
        echo $cadena; 
        // $this->listarPersonal();
    }
    function modalNote2(){
        // echo $cadena = $_POST['Pass'];
        // $this->listarPersonal();
    }
}

?>