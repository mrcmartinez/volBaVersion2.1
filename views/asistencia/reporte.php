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
            <form action="<?php echo constant('URL'); ?>documento" method="POST">
                <input type="submit" class="btn-options" value="Documentacion">
            </form>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <input type="submit" class="btn-options" value="Documentación Fisica">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
                <input type="submit" class="btn-options-check" value="Asistencias">
            </form>
            <form action="<?php echo constant('URL'); ?>baja" method="POST">
                <input type="submit" class="btn-options" value="Bajas">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaFaltas" method="POST">
                <input type="submit" class="btn-options" value="Total Faltas">
            </form>

            <form action="<?php echo constant('URL'); ?>reporteSemanal" method="POST">
                <input type="submit" class="btn-options" value="Reporte General">
            </form>

            <h1 class="center"><small>Reportes</small>Asistencia</h1>
            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
                
            <!-- filtro de horario -->
            Horario por:
                <?php switch($this->filtroHorario){
                    
                    case "":
                        echo '<input type="radio" id="" name="filtroHorario" value="" checked onchange="this.form.submit()">Todo
                        <input type="radio" id="" name="filtroHorario" value="Matutino" onchange="this.form.submit()">Matutino
                        <input type="radio" id="" name="filtroHorario" value="Vespertino" onchange="this.form.submit()">Vespertino';
                        break;
                    case "Matutino":
                        echo '<input type="radio" id="" name="filtroHorario" value="" onchange="this.form.submit()">Todo
                        <input type="radio" id="" name="filtroHorario" value="Matutino" checked onchange="this.form.submit()">Matutino
                        <input type="radio" id="" name="filtroHorario" value="Vespertino" onchange="this.form.submit()">Vespertino';
                        break;
                    case "Vespertino":
                        echo '<input type="radio" id="" name="filtroHorario" value="" onchange="this.form.submit()">Todo
                        <input type="radio" id="" name="filtroHorario" value="Matutino" onchange="this.form.submit()">Matutino
                        <input type="radio" id="" name="filtroHorario" value="Vespertino"checked onchange="this.form.submit()">Vespertino';
                        break;
                }?>
                </br>
            <!-- filtro de horario -->
            
                Filtrar por:
                <?php switch($this->radio){
                    
                    case "Asistencia":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Asistencia"checked onchange="this.form.submit()">Asistencias+Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Asistencia-Apoyo" onchange="this.form.submit()">Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Falta" onchange="this.form.submit()">Faltas
                        <input type="radio" id="" name="radio_busqueda" value="" onchange="this.form.submit()">Todo';
                        break;
                    case "Asistencia-Apoyo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Asistencia" onchange="this.form.submit()">Asistencias+Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Asistencia-Apoyo" checked onchange="this.form.submit()">Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Falta" onchange="this.form.submit()">Faltas
                        <input type="radio" id="" name="radio_busqueda" value="" onchange="this.form.submit()">Todo';
                        break;
                    case "Falta":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Asistencia" onchange="this.form.submit()">Asistencias+Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Asistencia-Apoyo" onchange="this.form.submit()">Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Falta"checked onchange="this.form.submit()">Faltas
                        <input type="radio" id="" name="radio_busqueda" value="" onchange="this.form.submit()">Todo';
                        break;
                    case "":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Asistencia" onchange="this.form.submit()">Asistencias+Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Asistencia-Apoyo" onchange="this.form.submit()">Apoyo
                        <input type="radio" id="" name="radio_busqueda" value="Falta" onchange="this.form.submit()">Faltas
                        <input type="radio" id="" name="radio_busqueda" value="" checked onchange="this.form.submit()">Todo';
                        break;
                }?>
                
                <p>
                    Ordenar Por:
                    <?php switch ($this->radioOrden) {
                case "fecha":
                    echo'<input type="radio" name="radio_ordenar" value="nombre" onchange="this.form.submit()">Nombre
                    <input type="radio" name="radio_ordenar" value="fecha"checked onchange="this.form.submit()">Fecha';
                    break;
                case 'nombre':
                        echo'<input type="radio" name="radio_ordenar" value="nombre"checked onchange="this.form.submit()">Nombre
                        <input type="radio" name="radio_ordenar" value="fecha" onchange="this.form.submit()">Fecha';
                        break;
                    break;
            }?>
                </p>

                <p>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus placeholder="ID,Nombre,Turno" value="<?php echo $this->consulta; ?>">
                    De:<input type="Date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>" title="Fecha filtro inicio" onchange="this.form.submit()">
                    a:<input type="Date" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>" title="Fecha filtro fin" onchange="this.form.submit()">
                    <input type="submit" class="btn-options-info" value="🔍Buscar">
                </p>
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/generarReporte" method="POST">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
                <input type="hidden" name="radio_ordenar" id="radio_ordenar" value="<?php echo $this->radioOrden; ?>">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                <input type="hidden" name="filtroHorario" id="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png" title="Generar Excel">
            </form>

            <form action="<?php echo constant('URL'); ?>consultaAsistencia/generarReportePDF" method="post" target="_blank">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
                <input type="hidden" name="radio_ordenar" id="radio_ordenar" value="<?php echo $this->radioOrden; ?>">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                <input type="hidden" name="filtroHorario" id="filtroHorario" value="<?php echo $this->filtroHorario; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png" title="Generar PDF">
            </form>
            <div id="div2">
                <table class="table table-striped table-hover t-tipo3">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>TurnoActual</th>
                            <th>Horario</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estatus</th>
                            
                            <?php if ($this->radio=="Falta") {
                                echo '<th>Motivo</th>';
                                echo '<th></th>';
                            }?>
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
                            <td><?php echo $asistencia->id_personal; ?></td>
                            <td><?php echo $asistencia->nombre; ?></td>
                            <td><?php echo $asistencia->turno; ?></td>
                            <td><?php echo $asistencia->horario; ?></td>
                            <td><?php echo diaSemana($asistencia->fecha);echo date('d-m-Y', strtotime($asistencia->fecha));?></td>
                            <td><?php echo $asistencia->hora; ?></td>
                            <td><?php echo $asistencia->estatus; ?></td>
                            <?php if ($this->radio=="Falta") {
                                ?> <td><?php echo nl2br($asistencia->descripcion); ?></td>
                                <td><a href="<?php echo constant('URL') . 'consultaAsistencia/marcarjustificado/'. $asistencia->id_personal.'/'.$asistencia->fecha.'/reporte'; ?>"><img
                                            src="<?php echo constant('URL'); ?>assets/img/refresh2.png" title="Marcar como justificada"/></a></td>
                                    <td><form action="<?php echo constant('URL'); ?>consultaAsistencia/llamarModal" method="post">
                                            <input type="hidden" name="id_personal" value="<?php echo $asistencia->id_personal; ?>">
                                            <input type="hidden" name="fecha" value="<?php echo $asistencia->fecha; ?>">
                                            <input type="image" src="<?php echo constant('URL'); ?>assets/img/editar2.png" title="indicar motivo de la falta">
                                        </form>
                                    </td><?php
                            }?>
                            
                            
                            
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
    <script src="<?php echo constant('URL'); ?>assets/js/salto.js"></script>
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
    <?php
        if (!empty($this->idMotivo)) 
        {
            ?>
        <a href="#miModalBaja">Abrir Modal</a>
        <div id="miModalBaja" class="modalBaja">

            <div class="modalBaja-contenido">
                <p>
                    <a href="<?php echo constant('URL'); ?>consultaAsistencia">❌</a>
                </p>
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/registrarMotivo" method="post" method="post">
                    <label for="">Motivo de la Falta dia <?php echo diaSemana($this->fecha)?><?php echo date('d-m-Y', strtotime($this->fecha));?></label>
                    <p>
                        
                        <h6><?php echo $this->telefonos;?></h6>
                        <h6><?php echo $this->nombre;?></h6>
                        <input type="hidden" name="id_personal" value="<?php echo $this->idMotivo?>">
                        <input type="hidden" name="fecha" value="<?php echo $this->fecha?>">
                        <textarea name="descripcion" id="nota" required rows="2" cols="55" maxlength="200" onkeyup="check(event);"></textarea>
                    </p>
                    <input class="btn btn-dark" type="submit" value="Aceptar">
                </form>
            </div>
        </div>
        <?php    
        }
    ?>
</body>

</html>