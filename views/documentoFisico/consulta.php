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

        <div class="center-form">
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Documentación Fisica</h1>
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
                    <input type="submit" class="btn btn-secondary inf" value="Documentacion Digital">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn btn-success inf" type="submit" value="Documentacion Fisica">
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
            <form action="<?php echo constant('URL'); ?>documentoFisico/actualizardocumentoFisico" method="POST">
                <div class="form-info">
                    <p>
                        <input type="hidden" name="id_personal" readonly
                            value="<?php echo $this->documentoFisico->id_personal; ?>">
                    </p>

                    <p>
                        <input type="checkbox" name="acta" <?php echo check($this->documentoFisico->acta);?>>
                        <label for="acta">Acta</label>
                    </p>
                    <p>
                        <input type="checkbox" name="curp" <?php echo check($this->documentoFisico->curp);?>>
                        <label for="curp">CURP</label>
                    </p>
                    <p>
                        <input type="checkbox" name="carta" <?php echo check($this->documentoFisico->carta);?>>
                        <label for="carta">Carta compromiso</label>
                    </p>
                    <p>
                        <input type="checkbox" name="comprobante"
                            <?php echo check($this->documentoFisico->comprobante);?>>
                        <label for="comprobante">Comprobante domicilio</label>
                    </p>
                    <p>
                        <input type="checkbox" name="datos" <?php echo check($this->documentoFisico->datos);?>>
                        <label for="datos">Datos</label>
                    </p>
                </div>
                <div class="form-info">
                    <p>
                        <input type="checkbox" name="estudio" <?php echo check($this->documentoFisico->estudio);?>>
                        <label for="estudio">Estudio</label>
                    </p>
                    <p>
                        <input type="checkbox" name="examen" <?php echo check($this->documentoFisico->examen);?>>
                        <label for="examen">Examen medico</label>
                    </p>
                    <p>
                        <input type="checkbox" name="ine" <?php echo check($this->documentoFisico->ine);?>>
                        <label for="ine">INE</label>
                    </p>
                    <p>
                        <input type="checkbox" name="solicitud" <?php echo check($this->documentoFisico->solicitud);?>>
                        <label for="solicitud">Solicitud</label>
                    </p>
                </div>
                <p>
                    <input type="submit" class="btn btn-success" value="Actualizar">
                </p>
            </form>
            <?php
            ?>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
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