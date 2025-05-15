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
    <h1 class="center titulov">Agregar <small>Candidata</small></h1>
    <div id="main"><br><br>
        <form action="<?php echo constant('URL'); ?>candidato/listar" method="POST">
            <input type="submit" value="❌">
        </form>
        <div class="center-form"><?php echo $this->mensaje; ?>
        
            <h1 class="center">Datos <small>generales</small></h1>

            <form class="row g-3" action="<?php echo constant('URL'); ?>candidato/registrar" method="POST">
                <div class="col-md-6">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="" required autofocus autocomplete="off">
                </div>
                <div class="col-md-6">
                    <label for="edad">Edad</label>
                    <input class="form-control" type="number" min="18" max="55"
                        name="edad" id="" required autocomplete="off">
                </div>
                <div class="col-md-6">
                    <label for="telefono">Telefono</label>
                    <input class="form-control" type="tel"
                        name="telefono" id="" pattern="[0-9]{10}" title="10 digitos sin espacio ni guion" required autocomplete="off">
                </div>
                
                <div class="col-md-6">
                    <input type="hidden" name="estatus" value="Activo">
                    <br><input class="form-control btn btn-dark" type="submit" value="Registrar">
                </div>
                <span></span>
            </form>
        </div>
        </div>
    <?php require 'views/footer.php'; ?>

</body>

</html>