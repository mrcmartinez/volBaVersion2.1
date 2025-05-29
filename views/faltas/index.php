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
                <input type="submit" class="btn-option" value="Documentación Digital">
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
                <input type="submit" class="btn-options-check" value="Total Faltas">
            </form>
            <form action="<?php echo constant('URL'); ?>reporteSemanal" method="POST">
                <input type="submit" class="btn-option" value="Reporte Historico">
            </form>
            <form action="<?php echo constant('URL'); ?>reporteSemanal/verReportePeriodo" method="POST">
                <input type="submit" class="btn btn-option" value="Reporte Periodo">
            </form>
            <h1 class="center"><small>Total</small>Faltas</h1>
            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>consultaFaltas" method="POST">
                <p>
                <div class="alinear">
                            <div class="col-md-2">
                                <select class="form-select" id="horario" name="filtroHorario"
                                    onchange="this.form.submit()">
                                    <option value="<?php echo $this->filtroHorario; ?>">
                                        ✔<?php echo filtroHorario($this->filtroHorario); ?></option>
                                    <option value="">Todo</option>
                                    <option value="Matutino">Matutino</option>
                                    <option value="Vespertino">Vespertino</option>
                                </select>
                            </div>
                            <input type="search" class="form-control" name="caja_busqueda" id="caja_busqueda"
                                value="<?php echo $this->consulta; ?>" autofocus
                                title="Buscar ID, Nombre, Dia">
                            <input class="btn btn-info" type="submit" value="🔍Buscar">
                        </div>
                </p>
            </form>
            <form action="<?php echo constant('URL'); ?>consultaFaltas/generarReporte" method="POST">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="hidden" name="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png">
            </form>

            <form action="<?php echo constant('URL'); ?>consultaFaltas/generarReportePDF" method="post" target="_blank">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="hidden" name="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png">
            </form>
            <div id="div2">
                <table class="table table-striped table-hover t-tipo4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Turno</th>
                            <th>Horario</th>
                            <th>Fecha Ingreso</th>
                            <th>Total Faltas</th>
                            <th>Fechas</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-documento">
                        <?php
                    include_once 'models/faltas.php';
                    foreach($this->faltas as $row){
                        $faltas = new Faltas();
                        $faltas = $row; 
                ?>
                        <tr id="fila-<?php echo $faltas->id_personal; ?>">
                            <td><?php echo $faltas->id_personal; ?></td>
                            <td><?php echo $faltas->nombre; ?></td>
                            <td><?php echo $faltas->turno; ?></td>
                            <td><?php echo $faltas->horario; ?></td>
                            <td><?php echo $faltas->fecha_ingreso; ?></td>
                            <td <?php echo colorTotalFalta($faltas->total_faltas);?>><?php echo $faltas->total_faltas; ?></td>
                            <td><?php echo $faltas->fecha_faltas; ?></td>

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