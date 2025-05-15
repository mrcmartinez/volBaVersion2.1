<?php
require 'conexion.php';
$estatus="Activo";
$fecha= date('Y-m-d');
$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
$dia = $dias[(date('N', strtotime($fecha))) - 1];

//$id_personal=$_POST['id_personal'];
$id_personal="531";

$sentencia=$conexion->prepare("SELECT * FROM personal as p 
            where id_personal='$id_personal' AND p.turno='$dia'");
$sentencia->execute();
$resultado = $sentencia->get_result();
if ($fila = $resultado->fetch_assoc()) {
         echo json_encode($fila,JSON_UNESCAPED_UNICODE);     
}
$sentencia->close();
$conexion->close();


//$asistencia=$this->model->buscar(['turno' => $dia,'estatus' => $estatus]);
?>