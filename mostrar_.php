<?php
//require 'conexion.php';
$conexion = mysqli_connect('localhost','root','','volba');
if(!$conexion){
	echo "error en la conexion";
}
date_default_timezone_set('America/Mexico_City');
$fecha= date('Y-m-d');
$result=array();
$result['datos']=array();
$query = "SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre,a.id_personal as id,a.estatus, a.fecha,a.hora 
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal where a.fecha='$fecha'";
$response = mysqli_query($conexion,$query);
while($row=mysqli_fetch_array($response)){
	$index['id']=$row['1'];
	$index['nombre']=$row['0'];
	$index['estatus']=$row['2'];
	$index['fecha']=$row['3'];
	$index['hora']=$row['4'];
	array_push($result['datos'],$index);
}
$result['exito']='1';
echo json_encode($result);
?>