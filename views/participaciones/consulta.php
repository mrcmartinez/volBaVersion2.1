<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>

    <?php require 'views/header.php'; ?>

    <div id="main">
        <div class="center-form">
            <h1 class="center">Participacion</h1>
            <h3 class="center">
                <?php if (isset($this->nombreCurso)) {
                $_SESSION['nombreCurso']=$this->nombreCurso;
            }?>
                <?php echo $_SESSION['nombreCurso'];?></h3>
            <form action="<?php echo constant('URL'); ?>participaciones/saludo" method="POST">
                <div id="div2">
                    <table width="100%" id="tabla">
                        <thead>
                            <tr>
                                <th>ID_candidato</th>
                                <th>Nombre</th>
                                <th>estatus</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="tbody-alumnos">

                            <?php
            include_once 'models/capacitacion.php';
            foreach ($this->capacitacion as $row) {
                $capacitacion = new Participacion();
                $capacitacion = $row;
        ?>
                            <tr id="fila-<?php echo $capacitacion->id_curso; ?>">
                                <td><?php echo $capacitacion->id_candidato; ?></td>
                                <td><?php echo $capacitacion->nombre; ?></td>
                                <td><?php echo $capacitacion->estatus; ?></td>

                                <?php if ($capacitacion->estatus=="Pendiente" ) { ?>
                                <td><input type="checkbox" value="<?php echo $capacitacion->id_candidato; ?>"
                                        name="personal[]" onclick=""></td>
                                <?php }else{
                             ?>
                                <td><input type="checkbox" value="<?php echo $capacitacion->id_candidato; ?>" name=""
                                        checked disabled onclick=""></td>
                                <?php
                        } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php
            if (isset($this->idCurso)) {
                ?><input type="hidden" name="id" value="<?php echo $this->idCurso; ?>"><?php
            }else{
                ?><input type="hidden" name="id" value="<?php echo $capacitacion->id_curso; ?>"><?php
            }
            ?>
                <input type="hidden" name="nombreCurso" value="<?php echo $_SESSION['nombreCurso']; ?>">
                <input type="submit" name="seleccion" value="Registrar capacitación" />
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>/public/js/main.js"></script>
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