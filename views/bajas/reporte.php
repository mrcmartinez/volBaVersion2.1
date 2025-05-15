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
                <input type="submit" class="btn-options-check" value="Bajas">
            </form>

            <form action="<?php echo constant('URL'); ?>consultaFaltas" method="POST">
                <input type="submit" class="btn-options" value="Total Faltas">
            </form>

            <form action="<?php echo constant('URL'); ?>reporteSemanal" method="POST">
                <input type="submit" class="btn-options" value="Reporte General">
            </form>

            <h1 class="center"><small>Reportes</small>Bajas</h1>

            <form action="<?php echo constant('URL'); ?>baja" method="POST">
                <p>
                    De:<input type="Date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>" title="Fecha filtro inicio">
                    a:<input type="Date" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>" title="Fecha filtro fin">
                    <input type="text" name="caja_busqueda_baja" id="" title="busqueda por nombre">
                    <input type="submit" class="btn-options-info" value="🔍Buscar">
                </p>
            </form>

            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center"></div>

            <form action="<?php echo constant('URL'); ?>baja/generarReporte" method="POST">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png" title="Generar EXCEL">
            </form>

            <form action="<?php echo constant('URL'); ?>baja/generarReportePDF" method="post" target="_blank">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png" title="Generar PDF">
            </form>

            <div id="div2">
                <table class="table table-striped table-hover t-tipo2">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha Baja</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-baja">
                        <?php $i=1;
                    include_once 'models/bajas.php';
                    foreach($this->baja as $row){
                        $baja = new Bajas();
                        $baja = $row; 
                ?>
                        <tr id="fila-<?php echo $baja->id_personal; ?>">
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $baja->id_personal; ?></td>
                            <td><?php echo $baja->nombre; ?></td>
                            <td><?php echo $baja->fecha; ?></td>
                            <td><?php echo nl2br($baja->motivo); ?></td>

                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>