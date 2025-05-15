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
            <h1 class="center">Candidatas</h1>
            <form action="<?php echo constant('URL'); ?>candidato/listar" method="POST">
                <div class="alinear">
                    <input type="text" type="search" class="form-control" name="caja_busqueda" id="caja_busqueda" autofocus>
                    <input type="submit" class="btn btn-info" value="🔍Buscar">
                </div>
            </form>
            <form action="<?php echo constant('URL'); ?>candidato" method="POST">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/nuevo.png" value="Nuevo" title="Nuevo candidato">
            </form>
            <div id="div2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Fecha solicitud</th>
                            <th>Telefono</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>

                    <tbody id="tbody-alumnos">

                        <?php $i=1;
            include_once 'models/candidatos.php';
            foreach ($this->candidato as $row) {
                $candidato = new Candidatos();
                $candidato = $row;
        ?>
                        <tr id="fila-<?php echo $candidato->id_candidato; ?>">
                        <td><?php echo $i; $i++;?></td>
                            <td><?php echo $candidato->id_candidato; ?></td>
                            <td><?php echo $candidato->nombre; ?></td>
                            <td><?php echo $candidato->edad; ?></td>
                            <td><?php echo $candidato->fecha_solicitud; ?></td>
                            <td><?php echo $candidato->telefono; ?></td>
                            <td><?php echo nl2br($candidato->descripcion); ?></td>
                            <td>
                            <a
                                        href="<?php echo constant('URL') . 'candidato/llamarDetalle/' . $candidato->id_candidato; ?>"><img
                                            src="<?php echo constant('URL'); ?>assets/img/edit.png"
                                            title="Comentarios" /></a>    
                            
                            
                                <form action="<?php echo constant('URL'); ?>candidato/alta" method="POST">
                                    <input type="hidden" name="nombre" value="<?php echo $candidato->nombre; ?>">
                                    <input type="hidden" name="id_candidato"
                                        value="<?php echo $candidato->id_candidato; ?>">
                                    <!-- <input type="hidden" name="fecha_nacimiento"
                                        value="<?php //echo $candidato->fecha_nacimiento; ?>"> -->
                                    <input type="image" src="<?php echo constant('URL'); ?>assets/img/alta.png"
                                        value="Nuevo" title="Alta">
                                </form>

                                <a
                                    href="<?php echo constant('URL') . 'candidato/eliminar/'.$candidato->id_candidato; ?>"><button
                                            onclick="return confirmBaja()"><img
                                        src="<?php echo constant('URL'); ?>assets/img/eliminar2.png" title="Eliminar"/></button></a>

                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
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
        if (!empty($this->idDetalle)) 
        {
            ?>
        <a href="#miModalBaja">Abrir Modal</a>
        <div id="miModalBaja" class="modalBaja">

            <div class="modalBaja-contenido">
                <p>
                    <a href="<?php echo constant('URL'); ?>candidato/listar">❌</a>
                </p>
                <form action="<?php echo constant('URL'); ?>candidato/editarComentario" method="post" method="post">
                    <label for="">comentarios</label>
                    <p>
                    <h6><?php echo $this->nombre;?></h6>
                    <!-- <h6><?php echo $this->comentario;?></h6> -->
                    <input type="hidden" name="id_candidato" value="<?php echo $this->idDetalle?>">
                    <!-- <input type="text" name="" readonly value="<?php echo $this->comentario;?>"> -->

                    <textarea name="comentario" id="nota" required rows="2" cols="55" maxlength="200"
                        onkeyup="check(event);"><?php echo $this->comentario;?></textarea>
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