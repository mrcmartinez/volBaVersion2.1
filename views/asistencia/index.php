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


            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">AsistenciaP</h1>
            <div class="center">
                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form> -->
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/calendario/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary infDetalles" value="calendario">
                </form>
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-success infDetalles" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn btn-secondary infDetalles" type="submit" value="Documentacion Digittal">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary infDetalles" value="Documentacion Fisica">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary infDetalles" value="Telefonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input type="submit" class="btn btn-secondary infDetalles" value="Qr">
                </form>
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaidRango/<?php echo $this->id?>"
                    method="POST">
                   <input type="number" name="year" min="1900" max="2099" step="1" value="<?php echo $this->year?>" onchange="this.form.submit()"/>
                </form>
            </div>
            <div id="div2">
                <div id="respuesta" class="center"></div>

                <table class="table-hover" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estatus</th>
                            <th>Motivo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-asistencia">
                        <?php
                    include_once 'models/asistencia.php';
                    foreach($this->asistencia as $row){
                        $asistencia = new Asistencia();
                        $asistencia = $row; 
                ?>
                        <tr id="fila-<?php echo $asistencia->id_personal; ?>">
                            <td><a href="<?php echo constant('URL') . 'consultaAsistencia/eliminar/' . $asistencia->id_personal.'/'.$asistencia->fecha.'/ID'; ?>"
                                    onclick="return confirmBaja()"><img
                                        src="<?php echo constant('URL'); ?>assets/img/eliminar.png"
                                        title="Quitar de Lista" /></a></td>
                            <td><?php echo $asistencia->id_personal; ?></td>
                            <td><?php echo diaSemana($asistencia->fecha);echo date('d-m-Y', strtotime($asistencia->fecha));?>
                            </td>
                            <td><?php echo $asistencia->hora; ?></td>
                            <td><?php echo $asistencia->estatus; ?></td>
                            <td><?php echo nl2br($asistencia->descripcion); ?></td>
                            <?php if ($asistencia->estatus=="Falta") {
                            ?>
                            <td><a href="<?php echo constant('URL') . 'consultaAsistencia/marcarjustificado/'. $asistencia->id_personal.'/'.$asistencia->fecha; ?>"
                                    onclick="return confirmBaja()"><img
                                        src="<?php echo constant('URL'); ?>assets/img/refresh2.png"
                                        title="Marcar como justificada" /></a>
                                <form action="<?php echo constant('URL'); ?>consultaAsistencia/llamarModal"
                                    method="post">
                                    <input type="hidden" name="id_personal"
                                        value="<?php echo $asistencia->id_personal; ?>">
                                    <input type="hidden" name="fecha" value="<?php echo $asistencia->fecha; ?>">
                                    <input type="hidden" name="consultaID">
                                    <input type="image" src="<?php echo constant('URL'); ?>assets/img/editar2.png"
                                        title="indicar motivo de la falta">
                                </form>
                            </td>
                            <?php
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
    <?php
        if (!empty($this->idMotivo)) 
        {
            ?>
    <a href="#miModalBaja">Abrir Modal</a>
    <div id="miModalBaja" class="modalBaja">

        <div class="modalBaja-contenido">
            <p>
                <a href="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>">❌</a>
            </p>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/registrarMotivo" method="post" method="post">
                <label for="">Motivo de la Falta dia
                    <?php echo diaSemana($this->fecha)?><?php echo date('d-m-Y', strtotime($this->fecha));?></label>
                <p>

                <h4><?php echo $this->telefonos;?></h4>
                <h4><?php echo $this->nombre;?></h4>
                <input type="hidden" name="id_personal" value="<?php echo $this->idMotivo?>">
                <input type="hidden" name="fecha" value="<?php echo $this->fecha?>">
                <input type="hidden" name="consultaID">
                <textarea name="descripcion" id="nota" required rows="2" cols="55" maxlength="200"
                    onkeyup="check(event);"></textarea>
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