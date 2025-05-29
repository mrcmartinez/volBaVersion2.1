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
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container-fluid">

    
    <?php require 'views/header.php'; ?>

    <div id="main">
        <div class="center-form-inicio">

            <form action="<?php echo constant('URL'); ?>documento" method="POST">
                <input type="submit" class="btn-option" value="Documentación">
            </form>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <input type="submit" class="btn-option" value="Documentación Fisica">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
                <input type="submit" class="btn-option" value="Asistencias">
            </form>

            <form action="<?php echo constant('URL'); ?>baja" method="POST">
                <input type="submit" class="btn-option" value="Bajas">
            </form>

            <form action="<?php echo constant('URL'); ?>consultaFaltas" method="POST">
                <input type="submit" class="btn-option" value="Total Faltas">
            </form>

            <form action="<?php echo constant('URL'); ?>reporteSemanal" method="POST">
                <input type="submit" class="btn-options-check" value="Reporte Historico">
            </form>
            <form action="<?php echo constant('URL'); ?>reporteSemanal/verReportePeriodo" method="POST">
                <input type="submit" class="btn btn-option" value="Reporte Periodo">
            </form>

            <h1 class="center">Reporte<small>global</small></h1>
            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center"></div>

            <form action="<?php echo constant('URL'); ?>reporteSemanal/generarReporte" method="POST">
                <!-- <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>"> -->
                <!-- <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>"> -->
                <!-- <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png" title="Generar EXCEL">Generar Excel -->
                <div class="center"><input class="btn-lg btn-primary" type="submit" value="Generar Excel"></div>
            </form>


            <div id="div2">
            <table class="table table-striped table-hover t-tipo2" id="myTableReporte">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Actividad</th>
                            <th>Turno</th>
                            <th>Fecha Ingreso</th>
                            <th>Antiguedad años</th>
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
                            <td><?php echo $reporte->rolar ? 'Rolar' : $reporte->turno;?></td>
                            <td><?php echo $reporte->actividad; ?></td>
                            <td><?php echo $reporte->fecha_ingreso; ?></td>
                            <td><?php echo edad($reporte->fecha_ingreso); ?></td>
                            <td <?php echo colorTotalFalta($reporte->total_faltas);?>><?php echo $reporte->total_faltas; ?></td>
                            <td><?php echo $reporte->total_asistencia; ?></td>
                            <td><?php echo $reporte->total_asistencia_apoyo; ?></td>
                            <td><?php echo $reporte->total_falta_justificada; ?></td>
                            <td><?php echo $reporte->fecha_faltas; ?></td>
                            <td><?php echo $reporte->fecha_falta_justificada; ?></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
   

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTableReporte').DataTable( {
        paging: false,
        "order": [1, 'asc']
        
} );
} );
</script>
</body>

</html>