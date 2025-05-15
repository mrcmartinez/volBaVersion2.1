<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <!-- <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css"> -->
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        
        <div class="center-form"><?php echo $this->mensaje; ?>
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Información</h1>
            <div class="center">

                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input class="btn-option" type="submit" value="Regresar">
                </form> -->
                <form
                    action="<?php echo constant('URL'); ?>consultaAsistencia/calendario/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" class="btn btn-info inf" value="Calendario">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" class="btn btn-info inf" value="Documentación Digital">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" class="btn btn-info inf" value="Documentación Fisico">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" class="btn btn-info inf" value="Teléfonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" class="btn btn-info inf" value="Qr">
                </form>
            </div>
            <div class="row g-3">
                <div class="col-1">
                    <label for="id_personal">ID</label><br>
                    <input type="number" class="form-control" name="id_personal" disabled
                        value="<?php echo $this->personal->id_personal; ?>">
                </div>
                <div class="col-5">
                    <label for="nombre">Nombre</label><br>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $this->personal->nombre; ?>"
                        disabled>
                </div>

                <div class="col-3">
                    <label for="apellido_paterno">Apellido Paterno</label><br>
                    <input type="text" class="form-control" name="apellido_paterno"
                        value="<?php echo $this->personal->apellido_paterno; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="apellido_materno">Apellido Materno</label><br>
                    <input type="text" class="form-control" name="apellido_materno"
                        value="<?php echo $this->personal->apellido_materno; ?>" disabled>
                </div>
                <div class="col-6">
                    <label for="calle">Calle</label><br>
                    <input type="text" class="form-control" name="calle" value="<?php echo $this->personal->calle; ?>"
                        disabled>
                </div>
                <div class="col-2">
                    <label for="numero_exterior">Número exterior</label><br>
                    <input type="number" class="form-control" name="numero_exterior"
                        value="<?php echo $this->personal->numero_exterior; ?>" disabled>
                </div>
                <div class="col-4">
                    <label for="colonia">Colonia</label><br>
                    <input type="text" class="form-control" name="colonia"
                        value="<?php echo $this->personal->colonia; ?>" disabled>
                </div>


                <div class="col-3">
                    <label for="fecha_nacimiento">Fecha Nacimiento</label><br>
                    <input type="date" class="form-control" name="fecha_nacimiento"
                        value="<?php echo $this->personal->fecha_nacimiento; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="edad">Edad</label>
                    <input type="number" class="form-control" name="edad" value="<?php echo $this->edadCalculada; ?>"
                        disabled>
                </div>

                <!-- <div class="form-info"> -->
                <div class="col-3">
                    <label for="estado_civil">Estado Civil</label>
                    <input type="text" class="form-control" name="estado_civil"
                        value="<?php echo $this->personal->estado_civil; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="numero_hijos">Número de hijos</label>
                    <input type="number" class="form-control" name="numero_hijos"
                        value="<?php echo $this->personal->numero_hijos; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="seguro_medico">Seguro Médico</label>
                    <input type="text" class="form-control" name="seguro_medico"
                        value="<?php echo $this->personal->seguro_medico; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="escolaridad">Escolaridad</label>
                    <input type="text" class="form-control" name="escolaridad"
                        value="<?php echo $this->personal->escolaridad; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="turno">Turno</label>
                    <input type="text" class="form-control" name="turno" value="<?php echo $this->personal->rolar ? 'Rolar' : $this->personal->turno; ?>"
                        disabled>
                </div>
                <div class="col-3">
                    <label for="horario">Horario</label>
                    <input type="text" class="form-control" name="horario"
                        value="<?php echo $this->personal->horario; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="actividad">Actividad</label>
                    <input type="text" class="form-control" name="actividad"
                        value="<?php echo $this->personal->actividad; ?>" disabled>
                </div>
                <div class="col-3">
                    <label for="fecha_ingreso">Fecha Ingreso</label>
                    <input type="date" class="form-control" name="fecha_ingreso"
                        value="<?php echo $this->personal->fecha_ingreso; ?>" disabled>
                </div>
                <div class="col-6">
                    <label for="estatus">Estatus</label>
                    <input type="text" class="form-control" name="estatus"
                        value="<?php echo $this->personal->estatus; ?>" disabled>
                </div>
            </div>
            <div class="col-md-12">
                    <label for="ocupacion">Ocupacion</label>
                    <input class="form-control" type="text" name="ocupacion"
                        value="<?php echo $this->personal->ocupacion; ?>" disabled>
                </div>
            <!-- </div> -->
        </div>
        
    </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>