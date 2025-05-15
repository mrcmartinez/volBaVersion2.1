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
            <h1 class="center">Asignar Candidato</h1>
            <h1 class="center"><?php echo $_SESSION['nombreCurso'];?></h1>
            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center">
                <form action="<?php echo constant('URL'); ?>candidato/listar/ <?php echo $this->idCurso ?>"
                    method="POST">
                    <p>
                        <input type="search" name="caja_busqueda" id="caja_busqueda"
                            value="<?php echo $this->consulta; ?>" autofocus>
                        <input type="submit" value="🔍Buscar">
                    </p>
                </form>
            </div>
            <form action="<?php echo constant('URL'); ?>participaciones/asignarCapacitacion" method="POST">
                <div id="div2">
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Fecha solicitud</th>
                                <th>Telefono</th>
                                <th></th>

                            </tr>
                        </thead>

                        <tbody id="tbody-alumnos">

                            <?php
            include_once 'models/candidatos.php';
            foreach ($this->candidato as $row) {
                $candidato = new Candidatos();
                $candidato = $row;
        ?>
                            <tr id="fila-<?php echo $candidato->id_candidato; ?>">
                                <td><?php echo $candidato->id_candidato; ?></td>
                                <td><?php echo $candidato->nombre; ?></td>
                                <td><?php echo $candidato->edad; ?></td>
                                <td><?php echo $candidato->fecha_solicitud; ?></td>
                                <td><?php echo $candidato->telefono; ?></td>
                                <td><input type="checkbox" value="<?php echo $candidato->id_candidato; ?>"
                                        name="personal[]" onclick="reload()"></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="estado" value="<?php echo $this->estado; ?>">
                <input type="hidden" name="id" value="<?php echo $this->idCurso; ?>">
                <input type="hidden" name="nombreCurso" value="<?php echo $_SESSION['nombreCurso'];?>">
                <input type="submit" name="seleccion" value="Agregar" />
            </form>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
</body>

</html>