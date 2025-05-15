<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/form.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div class="display">
        <form action="<?php echo constant('URL'); ?>peticion/listar" method="POST">
            <input type="submit" value="❌">
        </form>
        <div class="container">
            <h1 class="center">Petición Asistencia</h1>
            <form action="<?php echo constant('URL') . 'personal/seleccionarPersonal/'?>" method="post">
                <input type="hidden" name="peticion" value="falta">
                <input type="submit" class="btn" value="🔍Buscar">
            </form>

            <div class="center"><?php echo $this->mensaje; ?></div>
            <form action="<?php echo constant('URL'); ?>peticion/crear" method="POST" enctype="multipart/form-data">
                <div class="wrapper">
                    <div class="box">
                        <label for="">Id personal</label>
                        <input type="number"readonly name="id_personal" value="<?php echo $this->id; ?>"required >
                        <label for="">Tipo</label>
                        <input type="text" readonly name="tipo" value="Justificante">
                        <label for="">Fecha solicitada</label>
                        <input type="date" name="fecha_solicitada" id=""required>
                        <input type="hidden" name="dia_solicitado" id=""required>
                        <label for="">Descripcion</label>
                        <input type="text" name="descripcion" id=""required>
                        <input type="file" name="archivo" accept="application/pdf">
                    </div>
                </div>
                <p><input type="submit" class="btn" value="Solicitar"></p>
            </form>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>

</body>

</html>