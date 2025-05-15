<?php require_once('libraries/session.php');?>
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
        <h3 class="center"><?php echo $_SESSION['nombreVol'];?></h3>
        <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
            <input type="submit" value="❌">
        </form>
        <div class="center-form">

            <h1 class="center">Agregar Documentos</h1>
            <div class="center"><?php echo $this->mensaje; ?></div>
            <?php $idU=intval($this->ultimoId);?>
            <form class="row g-3" action="<?php echo constant('URL'); ?>documento/registrarDocumento" method="POST"
                enctype="multipart/form-data">

                <div class="col-12">
                    <label for="id_personal">ID</label>
                    <input class="form-control" type="number" name="id_personal" value=<?php echo $idU?> readonly>
                </div>
                <div class="col-md-6">

                    <input type="text" name="nombre_1" value="INE" readonly>
                    <input type="file" name="descripcion_1">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nombre_2" value="CURP" readonly>
                    <input type="file" name="descripcion_2">
                </div>


                <div class="col-md-6">
                    <input type="text" name="nombre_3" value="Comprobante" readonly>
                    <input type="file" name="descripcion_3">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nombre_4" value="Carta Compromiso" readonly>
                    <input type="file" name="descripcion_4">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nombre_5" value="Examen medico" readonly>
                    <input type="file" name="descripcion_5">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nombre_6" value="Estudio Socioeconomico" readonly>
                    <input type="file" name="descripcion_6">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nombre_7" value="Solicitud" readonly>
                    <input type="file" name="descripcion_7">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nombre_8" value="Acta Nacimiento" readonly>
                    <input type="file" name="descripcion_8">
                </div>
                <div class="col-md-4">
                    <input class="form-control btn btn-success" type="submit" value="Subir">
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nombre_9">
                    <input type="file" name="descripcion_9">
                </div>
            </form>
            <form class="row g-3" action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                <div class="col-md-4">
                    <input type="hidden" name="mensaje">
                    <input class="form-control btn btn-dark" type="submit" value="Terminar">
                </div>
                <div class="col-md-8">
                    <progress class="form-control" id="file" value="70" max="100"></progress>
                </div>
            </form>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>
</body>

</html>