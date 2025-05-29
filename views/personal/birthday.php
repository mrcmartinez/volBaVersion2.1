<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluye DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!-- Incluye DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- Incluye Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <!-- Incluye Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
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
                <table class="table table-striped table-hover" id="table1">
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
<script>
    $(document).ready(function () {
        $('#table1').DataTable({
            paging: false,              // ❌ Desactiva paginación
            info: false,                // ❌ Oculta "Mostrando X de Y"
            scrollY: '400px',           // ✅ Scroll vertical
            scrollCollapse: true,
            language: {                 // ✅ Español
                search: "Buscar:",
                zeroRecords: "No se encontraron resultados",
                emptyTable: "No hay datos disponibles",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                loadingRecords: "Cargando...",
                processing: "Procesando..."
            },
            dom: 'Bfrtip',
            buttons: [
    {
        extend: 'excelHtml5',
        text: 'Exportar a Excel',
        titleAttr: 'Exportar a Excel',
        title: 'Cumpleaños' // ← Cambia el encabezado del Excel
    },
    {
        extend: 'pdfHtml5',
        text: 'Exportar a PDF',
        titleAttr: 'Exportar a PDF',
        title: 'Cumpleaños' // ← Cambia el encabezado del PDF
    },
    {
        extend: 'print',
        text: 'Imprimir',
        titleAttr: 'Imprimir',
        title: 'Cumpleaños' // ← Encabezado de la impresión
    }
]

        });
    });
</script>


</body>

</html>