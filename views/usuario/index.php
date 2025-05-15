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
        <h1 class="center">Usuarios</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>
        <form action="<?php echo constant('URL'); ?>usuario/nuevo" method="POST">
            <input type="submit" value="Nuevo">
        </form>
        <div id="respuesta" class="center"></div>

        <table width="100%">
            <thead>
                <tr>
                    <th>Id usuario</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estatus</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbody-usuario">
                <?php
                    include_once 'models/usuarios.php';
                    foreach($this->usuario as $row){
                        $usuario = new Usuarios();
                        $usuario = $row; 
                ?>
                <tr id="fila-<?php echo $usuario->id_usuario; ?>">
                    <td><?php echo $usuario->id_usuario; ?></td>
                    <td><?php echo $usuario->nombre_usuario; ?></td>
                    <td><?php echo $usuario->rol; ?></td>
                    <td><?php echo $usuario->estatus; ?></td>

                    <td><a
                            href="<?php echo constant('URL') . 'usuario/verUsuario/' . $usuario->id_usuario; ?>">Editar</a>
                        <a
                            href="<?php echo constant('URL') . 'usuario/eliminarUsuario/' . $usuario->id_usuario.'/'.$usuario->estatus; ?>"><button
                                onclick="return confirmBaja()"><?php if ($usuario->estatus=="Activo") { 
                            ?>Baja</button><?php
                            }else{
                                ?>Activar</button><?php
                            } ?></a>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>

</body>

</html>