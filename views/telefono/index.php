<?php require 'libraries/session.php';?>
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
            <h1 class="center">Telefonos</h1>

            <div class="center"><?php echo $this->mensaje; ?></div>
            <div class="center">
                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form> -->
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Documentación Digital">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Documentacion Fisica">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn btn-success inf" type="submit" value="Teléfonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input type="submit" class="btn btn-secondary inf" value="Qr">
                </form>
            </div>
            <div id="respuesta" class="center"></div>

            <table width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>lada</th>
                        <th>número</th>
                        <th>Tipo</th>
                        <th>Detalle </th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody-telefono">
                    <?php
                    include_once 'models/telefonos.php';
                    foreach($this->telefono as $row){
                        $telefono = new Telefonos();
                        $telefono = $row; 
                ?>
                    <tr id="fila-<?php echo $telefono->id_personal; ?>">
                        <td><?php echo $telefono->id_personal; ?></td>
                        <td><?php echo $telefono->lada; ?></td>
                        <td><?php echo $telefono->numero; ?></td>
                        <td><?php echo $telefono->tipo; ?></td>
                        <td><?php echo $telefono->descripcion; ?></td>

                        <td><a
                                href="<?php echo constant('URL') . 'telefono/vertelefono/' . $telefono->id_personal.'/'. $telefono->lada.'/'. $telefono->numero; ?>"><img
                                    src="<?php echo constant('URL'); ?>assets/img/editar.png" /></a>
                        </td>
                        <td><a
                                href="<?php echo constant('URL') . 'telefono/eliminartelefono/' . $telefono->id_personal.'/'. $telefono->lada.'/'. $telefono->numero; ?>"><img
                                    src="<?php echo constant('URL'); ?>assets/img/eliminar2.png" /></a>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="<?php echo constant('URL') . 'telefono/nuevoTelefono/' . $this->id; ?>">Nuevo</a>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
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