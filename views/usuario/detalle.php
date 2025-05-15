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

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>usuario/actualizarUsuario" method="POST">

            <p>
                <label for="id_usuario">ID</label><br>
                <input type="number" name="id_usuario" readonly value="<?php echo $this->usuario->id_usuario; ?>"
                    required>
            </p>
            <p>
                <label for="nombre_usuario">Usuario</label><br>
                <input type="text" name="nombre_usuario" value="<?php echo $this->usuario->nombre_usuario; ?>" required>
            </p>

            <p>
                <label for="password">Password</label><br>
                <input type="password" name="password" value="<?php echo $this->usuario->password; ?>" readonly>
            </p>
            <p>
                <label for="password_new">Nuevo Password</label><br>
                <input type="password" name="password_new">
            </p>
            <p>
                <label for="rol">Rol</label><br>
                <select id="rol" name="rol">
                    <option value="<?php echo $this->usuario->rol; ?>">✔<?php echo $this->usuario->rol; ?></option>
                    <option value="Administrador">Administrador</option>
                    <option value="Supervisor">Supervisor</option>
                </select>
            </p>
            <p>
                <label for="estatus">Estatus</label><br>
                <input type="text" name="estatus" value="<?php echo $this->usuario->estatus; ?>" readonly>
            </p>
            <p>
                <input type="submit" value="Actualizar usuario">
            </p>
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>