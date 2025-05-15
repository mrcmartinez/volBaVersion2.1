<?php require 'libraries/session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
    
        <div class="center-form">
        <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Agregar Documento</h1>

            <div class="center"><?php echo $this->mensaje; ?></div>
            <?php $idU=intval($this->ultimoId);?>
            <form action="<?php echo constant('URL'); ?>documento/registrarNuevo" method="POST"
                enctype="multipart/form-data">

                <p>
                    <label for="id_personal">ID</label><br>
                    <input type="number" name="id_personal" value=<?php echo $idU?> readonly>
                </p>
                <p>
                    <label for="nombre">Documento</label><br>
                    <select id="nombre" name="nombre">
                        <option value="Solicitud">Solicitud</option>
                        <option value="Carta compromiso">Carta compromiso</option>
                        <option value="Acta nacimiento">Acta nacimiento</option>
                        <option value="CURP">CURP</option>
                        <option value="INE">INE</option>
                        <option value="Comprobante domicilio">Comprobante domicilio</option>
                        <option value="Estudio socioeconomico">Estudio socioeconomico</option>
                        <option value="Examen medico">Examen medico</option>
                    </select>
                    <input type="file" name="descripcion" accept="application/pdf" required>
                </p></br>
                <p>
                    <input type="submit" value="Subir Documentos">
                </p>

            </form>
            <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                <input type="submit" value="Cancelar">
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>