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
            <div><?php echo $this->mensaje; ?></div>
            <h1 class="center">Registrar Nuevo curso</h1>

            <form action="<?php echo constant('URL'); ?>curso/crear" method="POST">
                <label for="">Nombre</label><br>
                <input type="text" name="nombre" id="" required><br>
                <label for="">Descripcion</label><br>
                <input type="text" name="descripcion" id="" required><br>
                <label for="">Responsable</label><br>
                <input type="text" name="responsable" id="" required><br>
                <label for="">Fecha</label><br>
                <input type="date" name="fecha" id="" required><br>
                <label for="">Hora</label><br>
                <input type="time" name="hora" id="" required><br>
                <input type="hidden" value="Activo" name="estatus" id="" required><br>
                <input type="submit" value="Crear nuevo curso">
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

</body>

</html>