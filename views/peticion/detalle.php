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
        <div class="container-details">
            <h1 class="center">Detalle Folio <?php echo $this->peticion->folio; ?></h1>

            <div class="center"><?php echo $this->mensaje; ?></div>
            <form action="<?php echo constant('URL'); ?>peticion/listar" method="POST">
                <input type="submit" value="Regresar">
            </form>

            <?php if ( empty($this->peticion->dia_solicitado)) { ?>
            <form action="<?php echo constant('URL'); ?>peticion/autorizarFecha" method="POST">
                <?php }else{
            ?>
                <form action="<?php echo constant('URL'); ?>peticion/autorizarDia" method="POST">
                    <?php
        } ?>
                    <div class="wrapper">
                        <div class="box">
                            <label for="folio">Folio</label><br>
                            <input type="number" name="folio" readonly value="<?php echo $this->peticion->folio; ?>">
                            <label for="id_personal">ID personal</label><br>
                            <input type="number" name="id_personal" readonly
                                value="<?php echo $this->peticion->id_personal; ?>">

                            <label for="nombre">Nombre</label><br>
                            <input type="text" name="nombre" readonly value="<?php echo $this->peticion->nombre; ?>">

                            <label for="fecha_apertura">fecha apertura</label><br>
                            <input type="date" name="fecha_apertura" readonly
                                value="<?php echo $this->peticion->fecha_apertura; ?>">
                            <label for="tipo">Tipo</label><br>
                            <input type="text" name="tipo" readonly value="<?php echo $this->peticion->tipo; ?>">
                            <label for="descripcion">Descripcion</label><br>
                            <input type="text" name="descripcion" readonly
                                value="<?php echo $this->peticion->descripcion; ?>">
                            <?php if ( empty($this->peticion->dia_solicitado)) { ?>
                            <label for="fecha_solicitada">Fecha solicitada</label><br>
                            <input type="date" name="fecha_solicitada" readonly
                                value="<?php echo $this->peticion->fecha_solicitada; ?>">
                            <?php }else{
            ?>
                            <label for="dia_solicitado">Dia solicitado</label><br>
                            <input type="text" name="dia_solicitado" readonly
                                value="<?php echo $this->peticion->dia_solicitado; ?>">
                            <?php
        } ?>
                            <label for="estatus">Estatus</label><br>
                            <input type="text" name="estatus" readonly value="<?php echo $this->peticion->estatus; ?>">
                        </div>
                    </div>
                    <a href="<?php echo constant('URL') . 'peticion/verDocumentoPeticion/'.$this->peticion->id_personal.'/'.$this->peticion->archivo ?>"
                        target="_blank">Ver</a>
                    <p>
                        <input type="submit" value="Autorizar">
                    </p>
                </form>
                <form action="<?php echo constant('URL'); ?>peticion/rechazarPeticion" method="post">
                    <input type="hidden" name="folio" value="<?php echo $this->peticion->folio; ?>">
                    <input type="submit" value="No autorizar">
                </form>
        </div>
    </div>
    </div>
    <?php require 'views/footer.php'; ?>
</body>

</html>