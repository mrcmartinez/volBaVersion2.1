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
    <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
        <div class="center-form">
            <h1 class="center">Agregar teléfono</h1>

            <div class="center"><?php echo $this->mensaje; ?></div>
            <?php $idU=intval($this->ultimoId);?>
            <form action="<?php echo constant('URL'); ?>telefono/registrarNuevo" method="POST">

                <p>
                    <label for="id_personal">ID</label><br>
                    <input type="number" name="id_personal" readonly value=<?php echo $idU?>>
                </p>

                <p>
                    <label for="lada">Lada</label><br>
                    <input type="tel" name="lada" id="" pattern="[0-9]{3}" title="3 digitos" required>
                </p>
                <p>
                    <label for="numero">Número</label><br>
                    <input type="tel" name="numero" id="" pattern="[0-9]{7}" title="7 digitos" required>
                </p>
                <p>
                    <label for="tipo">Tipo</label><br>
                    <select id="tipo" name="tipo">
                        <option value="Celular">Celular</option>
                        <option value="Casa">Casa</option>
                        <option value="Emergencia">Emergencia</option>
                    </select>

                </p>
                <p>
                    <label for="descripcion">Descripción</label><br>
                    <input type="text" name="descripcion" id="">
                </p>

                <p>
                    <input type="submit" value="Registrar nuevo Telefono">
                </p>

            </form>
            <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $idU?>" method="POST">
                <input type="submit" value="Volver">
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>