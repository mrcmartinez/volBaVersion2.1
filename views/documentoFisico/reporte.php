<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <div class="center-form">
            <form action="<?php echo constant('URL'); ?>documento" method="POST">
                <input type="submit" class="btn-options" value="Documentación Digital">
            </form>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <input type="submit" class="btn-options-check" value="Documentación Fisica">
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
                <input type="submit" class="btn-options" value="Reporte General">
            </form>
            <h1 class="center"><small>Reportes</small>Documentación Fisica entregada</h1>
            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <p>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                    <input type="submit" class="btn-options-info" value="🔍Buscar">
                </p>
            </form>

            <div id="div2">
                <table class="table table-striped table-hover t-tipo1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>nombre</th>
                            <th>Acta</th>
                            <th>Curp</th>
                            <th>Carta</th>
                            <th>C. Domicilio</th>
                            <th>Datos</th>
                            <th>Estudio</th>
                            <th>Ex. Medico</th>
                            <th>INE</th>
                            <th>Solicitud</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-documento">
                        <?php
                    include_once 'models/documentosfisicos.php';
                    foreach($this->documentoFisico as $row){
                        $documentoFisico = new DocumentosFisicos();
                        $documentoFisico = $row; 
                ?>
                        <tr id="fila-<?php echo $documentoFisico->id_personal; ?>">
                            <td><?php echo $documentoFisico->id_personal; ?></td>
                            <td><?php echo $documentoFisico->nombre_personal; ?></td>
                            <td><?php echo marcado($documentoFisico->acta); ?></td>
                            <td><?php echo marcado($documentoFisico->curp); ?></td>
                            <td><?php echo marcado($documentoFisico->carta); ?></td>
                            <td><?php echo marcado($documentoFisico->comprobante); ?></td>
                            <td><?php echo marcado($documentoFisico->datos); ?></td>
                            <td><?php echo marcado($documentoFisico->estudio); ?></td>
                            <td><?php echo marcado($documentoFisico->examen); ?></td>
                            <td><?php echo marcado($documentoFisico->ine); ?></td>
                            <td><?php echo marcado($documentoFisico->solicitud); ?></td>
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