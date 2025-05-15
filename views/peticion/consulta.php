<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <div class="center-form">

            <h1 class="center">Peticiones</h1>
            <div class="center">

            <form action="<?php echo constant('URL'); ?>peticion/listar" method="post">
                <?php switch($this->radio){
                    case "Pendiente":
                        echo '<input type="radio" name="radio_busqueda" value="Pendiente" onchange="this.form.submit()" checked/>Pendientes
                        <input type="radio" name="radio_busqueda" value="Autorizado" onchange="this.form.submit()"/>Autorizados
                        <input type="radio" name="radio_busqueda" value="Rechazada" onchange="this.form.submit()"/>Rechazada';
                        break;
                    case "Autorizado":
                        echo '<input type="radio" name="radio_busqueda" value="Pendiente" onchange="this.form.submit()" />Pendientes
                        <input type="radio" name="radio_busqueda" value="Autorizado" onchange="this.form.submit()" checked/>Autorizados
                        <input type="radio" name="radio_busqueda" value="Rechazada" onchange="this.form.submit()"/>Rechazada';
                        break;
                    case "Rechazada":
                        echo '<input type="radio" name="radio_busqueda" value="Pendiente" onchange="this.form.submit()" />Pendientes
                        <input type="radio" name="radio_busqueda" value="Autorizado" onchange="this.form.submit()"/>Autorizados
                        <input type="radio" name="radio_busqueda" value="Rechazada" onchange="this.form.submit()" checked/>Rechazada';
                        break;
                }?>

            </form>
            <div><?php echo $this->mensaje; ?></div>
            
                <p>
            <form action="<?php echo constant('URL'); ?>peticion" method="POST">
                <input type="submit" class="btn btn-warning" value="+Justificante">
            </form>

            <form action="<?php echo constant('URL'); ?>peticion/nuevo" method="POST">
                <input type="submit" class="btn btn-dark" value="+Cambio turno">
            </form>
            </p>
            </div>
            <div id="div2">
                <table class="table table-striped table-hover t-tipo4">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Folio apertura</th>
                            <th>Tipo</th>
                            <th>Dia solicitado</th>
                            <th>Fecha solicitada</th>
                            <th>Estatus</th>
                            <th>Autorizado</th>
                        </tr>
                    </thead>

                    <tbody id="tbody-alumnos">

                        <?php
            include_once 'models/peticiones.php';
            foreach ($this->peticiones as $row) {
                $peticion = new Peticiones();
                $peticion = $row;
        ?>
                        <tr id="fila-<?php echo $peticion->folio; ?>">
                            <td><?php echo $peticion->folio; ?></td>
                            <td><?php echo $peticion->id_personal; ?></td>
                            <td><?php echo $peticion->nombre; ?></td>
                            <td><?php echo $peticion->fecha_apertura; ?></td>
                            <td><?php echo $peticion->tipo; ?></td>
                            <td><?php echo $peticion->dia_solicitado; ?></td>
                            <td><?php echo $peticion->fecha_solicitada; ?></td>
                            <td><?php echo $peticion->estatus; ?></td>
                            <?php
                        if ($_SESSION['rol']!="Supervisor" && $peticion->estatus=="Pendiente") {?>
                            <td><a
                                    href="<?php echo constant('URL') . 'peticion/verPeticionId/'. $peticion->folio;?>">Gestionar</a>
                            </td>
                            <?php                 
                        }else{?><td><?php echo $peticion->autorizo; ?></td><?php

                        }           
                    ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

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