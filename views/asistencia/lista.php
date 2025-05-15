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
            <h1 class="center">Lista Asistencia
                <?php echo diaSemana($this->fecha); echo date('d-m-Y', strtotime($this->fecha)); echo $this->filtroHorario;?>
            </h1>
            <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/back.png" title="Salir">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/buscar" method="POST">
                <input type="hidden" name="fecha" value="<?php echo $this->fecha; ?>">
                <input type="hidden" name="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="image" onclick="return confirmBaja()"
                    src="<?php echo constant('URL'); ?>assets/img/mode.png" title="Activar modo manual">
            </form>
            <form action="<?php echo constant('URL'); ?>personal/seleccionarPersonal" method="POST">
                <input type="hidden" name="fecha" value="<?php echo $this->fecha; ?>">
                <input type="hidden" name="listaAsistencia">
                <input type="hidden" name="tipo" value="Asistencia">
                <input type="hidden" name="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/add-user.png"
                    title="Agregar asistencia">
            </form>

            <form action="<?php echo constant('URL'); ?>personal/seleccionarPersonal" method="POST">
                <input type="hidden" name="fecha" value="<?php echo $this->fecha; ?>">
                <input type="hidden" name="listaApoyo">
                <input type="hidden" name="tipo" value="Asistencia-Apoyo">
                <input type="hidden" name="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/nuevo.png"
                    title="Agregar asistencia-apoyo">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/generarReportePDF" method="post" target="_blank">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="">
                <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="">
                <input type="hidden" name="radio_ordenar" id="radio_ordenar" value="nombre">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->fecha; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->fecha; ?>">
                <input type="hidden" name="filtroHorario" id="filtroHorario"
                    value="<?php echo $this->filtroHorario; ?>">
                <input type="hidden" name="listaAsistencia">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png" title="Generar PDF">
            </form>

            <form action="<?php echo constant('URL'); ?>consultaAsistencia/paseLista" method="POST">
                <input type="date" name="fecha" value="<?php echo $this->fecha; ?>" min="2022-07-01"
                    max="<?php echo date("Y-m-d");?>" onchange="this.form.submit()" title="Fecha de la lista">
                <!-- <input type="text" name="filtroHorario" value="<?php echo $this->filtroHorario;?>"> -->
                <!-- <input type="submit"> -->
                <select id="filtroHorario" name="filtroHorario" onchange="this.form.submit()">
                    <option value="<?php echo $this->filtroHorario; ?>">
                        ✔<?php echo $this->filtroHorario; ?></option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
            </form>
            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/marcarAsistencia" method="POST">

                <div id="div2">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Actividad</th>
                                <th>hora</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-asistencia">
                            <?php $i=1;
                    include_once 'models/asistencia.php';
                    foreach($this->asistencia as $row){
                        $asistencia = new Asistencia();
                        $asistencia = $row; 
                ?>
                            <tr id="fila-<?php echo $asistencia->id_personal; ?>">
                                <td><?php echo $i; $i++;?></td>
                                <td><a href="<?php echo constant('URL') . 'consultaAsistencia/eliminar/' . $asistencia->id_personal.'/'.$asistencia->fecha.'/'.$this->filtroHorario; ?>"
                                        onclick="return confirmBaja()"><img
                                            src="<?php echo constant('URL'); ?>assets/img/eliminar.png"
                                            title="Quitar de Lista" /></a>
                                    <a href="<?php echo constant('URL') . 'consultaAsistencia/reset/' . $asistencia->id_personal.'/'.$asistencia->fecha.'/'.$this->filtroHorario; ?>"
                                        onclick="return confirmBaja()"><img
                                            src="<?php echo constant('URL'); ?>assets/img/undo.png"
                                            title="Desmarcar" /></a>
                                </td>
                                <td><?php echo $asistencia->id_personal; ?></td>
                                <td><?php echo $asistencia->nombre; ?></td>

                                <td><?php echo $asistencia->actividad; ?></td>
                                <td><?php echo $asistencia->hora; ?></td>

                                <?php if ($asistencia->estatus=="Falta" ) { ?>

                                <td><input type="checkbox" value="<?php echo $asistencia->id_personal; ?>"
                                        name="personal[]" onclick=""></td>

                                <?php }else{
     ?>
                                <td>
                                    <div class="check-color"><input type="checkbox"
                                            value="<?php echo $asistencia->id_personal; ?>" name="personal[]" checked
                                            disabled onclick="" id="check1"><label
                                            for="check1"><?php echo $asistencia->estatus; ?></label></div>
                                </td>
                                <?php
} ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="estatus" value="Asistencia">
                <input type="hidden" name="fecha" value="<?php echo $this->fecha; ?>">
                <input type="hidden" name="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="submit" name="seleccion" class="btn btn-dark" value="Validar" />
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
    <?php
        if (!empty($this->mensaje)) 
        {
            ?>
    <script>
    Swal.fire({
        // position: 'top-end',
        icon: "<?php echo $this->code; ?>",
        title: '<?php echo $this->mensaje; ?>',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php    
        }
    ?>
</body>

</html>