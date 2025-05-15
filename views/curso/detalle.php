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
        <div><?php echo $this->mensaje; ?></div>
        <div class="center-form">
        <h1 class="center">Actualizar curso<?php echo $this->curso->id; ?></h1>

        <form action="<?php echo constant('URL'); ?>curso/actualizarCurso/" method="POST">
            <label for="">Matrícula</label><br>
            <input type="text" readonly name="id" id="" value="<?php echo $this->curso->id; ?>"><br>
            <label for="">Nombre</label><br>
            <input type="text" name="nombre" value="<?php echo $this->curso->nombre; ?>"><br>
            <label for="">Descripcion</label><br>
            <input type="text" name="descripcion" value="<?php echo $this->curso->descripcion; ?>"><br>
            <label for="">Responsable</label><br>
            <input type="text" name="responsable" value="<?php echo $this->curso->responsable; ?>"><br>
            <label for="">fecha</label><br>
            <input type="date" name="fecha" value="<?php echo $this->curso->fecha; ?>"><br>
            <label for="">Hora</label><br>
            <input type="time" name="hora" value="<?php echo $this->curso->hora; ?>"><br>
            <label for="">estaus</label><br>
            <input type="text" name="estatus" value="<?php echo $this->curso->estatus; ?>"><br>
            <input type="submit" value="actualizar curso">
        </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
    
</body>
</html>