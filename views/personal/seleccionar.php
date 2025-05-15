<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div class="container-fluid">
        <div class="center-form">
            <h1 class="center">Buscar Voluntariado para petición</h1>
            <div class="center"><?php echo $this->mensaje; ?></div>

            <div id="respuesta" class="center">
                <form action="<?php echo constant('URL'); ?>personal/seleccionarPersonal/" method="POST">
                    <input type="radio" id="" name="radio_busqueda" value="Activo" checked>Activo
                    <p>
                        <input type="search" name="caja_busqueda" id="caja_busqueda"
                            value="<?php echo $this->consulta; ?>" autofocus>
                        <input type="hidden" name="peticion" value="<?php echo $this->tipo; ?>">
                        <input type="submit" value="🔍Buscar">
                    </p>
                </form>
            </div>
            <form action="<?php echo constant('URL'); ?>peticion/imprimir" method="POST">
                <input type="hidden" name="peticion" value="<?php echo $this->tipo; ?>">
                <div id="div2">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Turno</th>
                                <th>Actividad</th>
                                <th>SELECCIONAR</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-personal">
                            <?php
                    include_once 'models/personalBanco.php';
                    foreach($this->personal as $row){
                        $personal = new PersonalBanco();
                        $personal = $row; 
                ?>
                            <tr id="fila-<?php echo $personal->id_personal; ?>">
                                <td><?php echo $personal->id_personal; ?></td>
                                <td><?php echo $personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre; ?>
                                </td>
                                <td><?php echo $personal->rolar ? 'Rolar' : $personal->turno; ?></td>
                                <td><?php echo $personal->actividad; ?></td>
                                <td><input type="checkbox" value="<?php echo $personal->id_personal; ?>" name="personal"
                                        onchange="this.form.submit()"></td>
                                <input type="hidden" name="nombre"
                                    value="<?php echo $personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre; ?>">
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
</body>

</html>