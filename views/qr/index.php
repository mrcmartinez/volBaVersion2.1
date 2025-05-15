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
    <?php require 'views/header.php'; 
    ?>

    <div id="main">
        <div class="center-form">
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">QR</h1>

            <div class="center">
                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form> -->
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf "value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Documentación Digital">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Documentacion Fisica">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Teléfonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input class="btn btn-success inf" type="submit" value="Qr">
                </form>
            </div>
            <div id="respuesta" class="center"></div>

            <div class="form-info">
                <div class="form-info-adv">
                    <h1>Advertencia</h1>
                    <p>Al actualizar el código Qr,</p>
                    <p>el anterior dejara de funcionar</p>
                    <p>y no sera valido</p>
                </div>
            </div>
            <div class="form-info">
                <p>
                    <label for="fecha_modificacion">Ultima actualización</label><br>
                    <input type="date" name="fecha_modificacion" value="<?php echo $this->qr->fecha_modificacion; ?>"
                        disabled>
                </p>
                <p>
                <input type="text" value="<?php echo $this->qr->identificador; ?>"
                        disabled>
                </p>
                <form action="<?php echo constant('URL'); ?>qr/actualizar/<?php echo $this->id?>" method="POST">
                    <input type="hidden" name="nombreVol" value="<?php echo $_SESSION['nombreVol'];?>">
                    <input class="btn btn-danger" type="submit" value="Actualizar" onclick="return confirmBaja()">
                </form>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
    <?php
        if (!empty($this->mensaje)) 
        {
            ?>
    <script>
    Swal.fire({
        // position: 'top-end',
        icon: "<?php echo $this->code; ?>",
        title: '<?php echo $this->mensaje; ?>',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php    
        }
    ?>
</body>

</html>