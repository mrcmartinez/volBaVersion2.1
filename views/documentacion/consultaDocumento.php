<?php require 'libraries/session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">

        <div class="center-form"><?php echo $this->mensaje; ?>
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Documentación</h1>
            <div class="center">
                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form> -->
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn btn-success inf" type="submit" value="Documentacion Digittal">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Documentacion Fisica">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Telefonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Qr">
                </form>
            </div>

            <div id="respuesta" class="center"></div>

            <table width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody-documento">
                    <?php
                    include_once 'models/documentos.php';
                    foreach($this->documento as $row){
                        $documento = new Documentos();
                        $documento = $row; 
                ?>
                    <tr id="fila-<?php echo $documento->id_personal; ?>">
                        <td><?php echo $documento->id_personal; ?></td>
                        <td><?php echo $documento->nombre; ?></td>
                        <td><?php echo $documento->estatus; ?></td>
                        <td><a
                                href="<?php echo constant('URL') . 'documento/eliminardocumento/' . $documento->id_personal.'/'. $documento->nombre; ?>"><img
                                    src="<?php echo constant('URL'); ?>assets/img/eliminar2.png" /></a>
                            <a href="<?php echo constant('URL') . 'documento/verDocumento/' . $documento->id_personal.'/'. $documento->descripcion; ?>"
                                target="_blank"><img src="<?php echo constant('URL'); ?>assets/img/lupa.png" /></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="<?php echo constant('URL') . 'documento/nuevoDocumento/' . $this->id; ?>">Nuevo</a>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>