<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <div class="center-form">

            <form action="<?php echo constant('URL'); ?>documento" method="POST">
                <input type="submit" class="btn-options" value="Documentación">
            </form>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <input type="submit" class="btn-options" value="Documentación Fisica">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
                <input type="submit" class="btn-options" value="Asistencias">
            </form>

            <form action="<?php echo constant('URL'); ?>baja" method="POST">
                <input type="submit" class="btn-options" value="Bajas">
            </form>

            <form action="<?php echo constant('URL'); ?>consultaFaltas" method="POST">
                <input type="submit" class="btn-options" value="Total Faltas">
            </form>
            
            <form action="<?php echo constant('URL'); ?>reporteSemanal" method="POST">
                <input type="submit" class="btn-options-check" value="Reporte General">
            </form>
            
            <h1 class="center"><small>Reporte</small>semanal</h1>
            <form action="<?php echo constant('URL'); ?>reporteSemanal/generarReporte" method="POST">
                <!-- <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>"> -->
                <!-- <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>"> -->
                <input type="submit" class="btn btn-primary"value="Generar Reporte">
            </form>
            <form action="<?php echo constant('URL'); ?>baja/generarReportePDF" method="post" target="_blank">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png" title="Generar PDF">
            </form>
            <div id="div2" class="center">
                
                <!-- <p>Este reporte desglosa la informacion de voluntarias, indicando el total de registros de su paquete alimentario y las ocasiones en que no se tienen registro de ello</p> -->


            </div>
            
<!--  -->
<table class="table table-striped table-hover t-tipo2">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Actividad</th>
                            <th>Turno</th>
                            <th>Fecha ingreso</th>
                            <th>Total Faltas</th>
                            <th>Total Asistencia</th>
                            <th>Total Asistencia Apoyo</th>
                            <th>Total Falta Justificada</th>
                            <th>Fechas Faltas</th>
                            <th>Fecha Falta Justificada</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-baja">
                        <?php $i=1;
                    include_once 'models/reporteSemanalDB.php';
                    foreach($this->reporte as $row){
                        $reporte = new ReporteSemanalDB();
                        $reporte = $row; 
                ?>
                        <tr id="fila-<?php echo $reporte->id_personal; ?>">
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $reporte->id_personal; ?></td>
                            <td><?php echo $reporte->nombre; ?></td>
                            <td><?php echo $reporte->turno; ?></td>
                            <td><?php echo $reporte->actividad; ?></td>
                            <td><?php echo $reporte->fecha_ingreso; ?></td>
                            <td><?php echo $reporte->total_faltas; ?></td>
                            <td><?php echo $reporte->total_asistencia; ?></td>
                            <td><?php echo $reporte->total_asistencia_apoyo; ?></td>
                            <td><?php echo $reporte->total_falta_justificada; ?></td>
                            <td><?php echo $reporte->fecha_faltas; ?></td>
                            <td><?php echo $reporte->fecha_falta_justificada; ?></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
<!--  -->

        </div>
    </div>
    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>