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
            <h1 class="center">Petición cambio de turno</h1>
            <form action="<?php echo constant('URL') . 'personal/seleccionarPersonal/'?>" method="post">
                <input type="hidden" name="peticion" value="turno">
                <input type="submit" value="🔍Buscar">
            </form>
            <div><?php echo $this->mensaje; ?></div>
            <form action="<?php echo constant('URL'); ?>peticion/crear" method="POST" enctype="multipart/form-data">

                <div class="wrapper">
                    <div class="box">
                        <label for="">Id personal</label>
                        <input type="number" readonly name="id_personal" id="" value="<?php echo $this->id; ?>">
                        <label for="">Tipo</label>
                        <input type="text" readonly name="tipo" value="Cambio turno">
                        <input type="hidden" name="fecha_solicitada" id="">
                        <label for="turno">Turno</label>
                        
                        <select class="select" id="dia_solicitado" name="dia_solicitado">
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miercoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sabado</option>
                        </select>

                        <label for="">Descripcion</label>
                        <input type="text" name="descripcion" id="" required>
                        <input type="file" name="archivo" accept="application/pdf">
                    </div>
                </div>
                <input type="submit" value="Solicitar">
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

</body>

</html>