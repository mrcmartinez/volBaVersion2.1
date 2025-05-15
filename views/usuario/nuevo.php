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
        <h1 class="center">Sección de usuarios</h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>usuario/crear" method="POST">

            <p>
                <label for="nombre_usuario">Usuario</label><br>
                <input type="text" name="nombre_usuario" id="" required autofocus>
            </p>
            <p>
                <label for="password">Contraseña</label><br>
                <input type="password" name="password" id="" required>
            </p>
            <p>
                <label for="rol">Rol</label><br>
                <select id="rol" name="rol">
                    <option value="Administrador">Administrador</option>
                    <option value="Supervisor">Supervisor</option>
                </select>
            </p>
            <p>
            <input type="hidden" name="estatus" value="Activo">
                <input type="submit" value="Registrar">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>