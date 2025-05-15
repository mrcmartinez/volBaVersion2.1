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
        <h3 class="center"><?php echo $_SESSION['nombreVol'];?></h3>
        <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
            <input type="submit" value="❌">
        </form>
        <div class="center-form">

            <h1 class="center">Marcar Documentos entregados</h1>
            <form action="<?php echo constant('URL'); ?>documentoFisico/registrar" method="POST">
                <div class="form-info">
                    <p>
                        <input type="text" name="id_personal" value="<?php echo $this->ultimoId; ?>">
                    </p>

                    <p>
                        <input type="checkbox" name="acta" value="1">
                        <label for="acta">Acta</label>
                    </p>
                    <p>
                        <input type="checkbox" name="curp" value="1">
                        <label for="curp">CURP</label>
                    </p>
                    <p>
                        <input type="checkbox" name="carta" value="1">
                        <label for="carta">Carta compromiso</label>
                    </p>
                    <p>
                        <input type="checkbox" name="comprobante" value="1">
                        <label for="comprobante">Comprobante domicilio</label>
                    </p>
                    <p>
                        <input type="checkbox" name="datos" value="1">
                        <label for="datos">Datos</label>
                    </p>
                </div>
                <div class="form-info">
                    <p>
                        <input type="checkbox" name="estudio" value="1">
                        <label for="estudio">Estudio</label>
                    </p>
                    <p>
                        <input type="checkbox" name="examen" value="1">
                        <label for="examen">Examen medico</label>
                    </p>
                    <p>
                        <input type="checkbox" name="ine" value="1">
                        <label for="ine">INE</label>
                    </p>
                    <p>
                        <input type="checkbox" name="solicitud" value="1">
                        <label for="solicitud">Solicitud</label>
                    </p>
                </div>
                <p>
                    <input type="submit" value="Siguiente">
                </p>
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>