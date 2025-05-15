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
        <h1 class="center">Detalle de <?php echo $this->telefono->id_personal; ?> </h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>telefono/actualizartelefono" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" readonly value="<?php echo $this->telefono->id_personal; ?>"
                    required>
            </p>
            <input type="hidden" name="ant_lada" value="<?php echo $this->telefono->lada; ?>">
            <input type="hidden" name="ant_numero" value="<?php echo $this->telefono->numero; ?>">

            <p>
                <label for="lada">lada</label><br>
                <input type="tel" name="lada" value="<?php echo $this->telefono->lada; ?>" pattern="[0-9]{3}" title="3 digitos" required>
                
            </p>
            <p>
                <label for="numero">número</label><br>
                <input type="tel" name="numero" value="<?php echo $this->telefono->numero; ?>" pattern="[0-9]{7}" title="7 digitos" required>
            </p>

            <p>
                <label for="tipo">tipo</label><br>
                <input type="text" name="tipo" value="<?php echo $this->telefono->tipo; ?>" required>
            </p>
            <p>
                <label for="descripcion">descripción</label><br>
                <input type="text" name="descripcion" value="<?php echo $this->telefono->descripcion; ?>">
            </p>

            <p>
                <input type="submit" value="Actualizar teléfono">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>