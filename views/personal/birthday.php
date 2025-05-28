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

    <div id="main">
        <div class="center-form">
            <h1 class="center">Cumpleaños🎂</h1>
            <form action="<?php echo constant('URL'); ?>reporteSemanal/birthday" method="POST">
                <div class="alinear">
                    <label for="mes">Seleccione mes: </label>
<select class="form-select" id="mes" name="mes" autocomplete="off">
    <?php
    $nombresMeses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];

    for ($i = 1; $i <= 12; $i++) {
        $selected = ($i == (int)$this->mes) ? 'selected' : '';
        echo "<option value=\"$i\" $selected>$nombresMeses[$i]</option>";
    }
    ?>
</select>

                    <!-- <input type="month" type="search" class="form-control" name="caja_busqueda" id="caja_busqueda" autofocus> -->
                    <input type="submit" class="btn btn-info" value="🔍Buscar">
                </div>
            </form>
            <!-- <form action="<?php echo constant('URL'); ?>candidato" method="POST">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/nuevo.png" value="Nuevo" title="Nuevo candidato">
            </form> -->
            <div id="div2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Fecha nacimiento</th>
                        </tr>
                    </thead>

                    <tbody id="tbody-alumnos">

                        <?php $i=1;
            include_once 'models/reporteSemanalDB.php';
$hoy = date('m-d'); // Mes y día actual, ejemplo: "05-28"

foreach ($this->datos as $row) {
    $candidato = new ReporteSemanalDB();
    $candidato = $row;

    // Extrae el mes y día del cumpleaños
    $cumple = date('m-d', strtotime($candidato->fecha_nacimiento));

    // Verifica si hoy es su cumpleaños
    $esCumple = ($cumple == $hoy);
?>
    <tr id="fila-<?php echo $candidato->id_personal; ?>">
        <td><?php echo $i; $i++; ?></td>
        <td><?php echo $candidato->id_personal; ?></td>
        <td>
            <?php echo $candidato->nombre; ?>
            <?php if ($esCumple): ?>
                <img src="<?php echo constant('URL'); ?>assets/img/confeti.gif" alt="🎉" width="30">
            <?php endif; ?>
        </td>
        <td><?php echo $candidato->edad; ?></td>
        <td><?php echo $candidato->fecha_nacimiento; ?></td>
    </tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>

</html>