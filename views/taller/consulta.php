
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
        <h1 class="center">Curso/Taller</h1>
        <div class="center">
            <form  action="<?php echo constant('URL'); ?>curso/listar" method="post">
            <input type="submit" class="btn-options" value="Voluntariado">
            </form>
            <form action="<?php echo constant('URL'); ?>taller/listar" method="post">
                <input type="submit" class="btn-options-check" value="Candidatos">
            </form>
        </div>
        <form action="<?php echo constant('URL'); ?>taller/listar" method="POST">
            <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo"checked onchange="this.form.submit()">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Terminado" onchange="this.form.submit()">Terminado';
                        break;
                    case "Terminado":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo" onchange="this.form.submit()">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Terminado"checked onchange="this.form.submit()">Terminado';
                        break;
                }?>
            <p>
                <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                <input type="date" name="caja_fecha" id="caja_fecha" autofocus>
                <input type="submit" class="btn-options-info" value="🔍Buscar">
            </p>
        </form>
        <form action="<?php echo constant('URL'); ?>taller" method="POST">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/plus.png" value="Nuevo" title="Nuevo curso">
        </form>
        <div id="div2">
        <table id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Responsable</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                    <th></th>
                    
                </tr>
            </thead>

            <tbody id="tbody-alumnos">

                <?php
            include_once 'models/talleres.php';
            foreach ($this->cursos as $row) {
                $curso = new Talleres();
                $curso = $row;
        ?>
                <tr id="fila-<?php echo $curso->id; ?>">
                    <td><?php echo $curso->id; ?></td>
                    <td><?php echo $curso->nombre; ?></td>
                    <td><?php echo $curso->descripcion; ?></td>
                    <td><?php echo $curso->responsable; ?></td>
                    <td><?php echo $curso->fecha; ?></td>
                    <td><?php echo $curso->hora; ?></td>
                    
                    <td><?php echo $curso->estatus; ?></td>
                    <td><a href="<?php echo constant('URL') . 'participaciones/verCapacitacionId/'. $curso->id.'/'.$curso->estatus.'/'.$curso->nombre;?>"><img
                                src="<?php echo constant('URL'); ?>assets/img/lista.png" title="Lista Agregados"/></a>

                        <?php if (( $_SESSION['rol']!="Supervisor" )&&($this->radio=="Activo")) { ?>
                    <a href="<?php echo constant('URL') . 'candidato/listar/'. $curso->id.'/'.$curso->estatus.'/'.$curso->nombre;?>"><img
                                src="<?php echo constant('URL'); ?>assets/img/grupo.png" title="Agregar"/></a>
                    <a href="<?php echo constant('URL') . 'taller/verCurso/' . $curso->id; ?>"><img
                                src="<?php echo constant('URL'); ?>assets/img/editar.png" title="Editar"/></a>
                    
                    <?php } ?>
                    <a href="<?php echo constant('URL') . 'taller/eliminarCurso/' . $curso->id.'/'.$this->radio; ?>"><button
                                onclick="return confirmBaja()"><?php if ($this->radio=="Activo") { 
                            ?>Cerrar</button><?php
                            }else{
                                ?>Activar</button><?php
                            } ?></a></td>
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