<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VolBaL</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
</head>
<body>
    <div class="main-login">
        <form action="<?php echo constant('URL'); ?>inicio/iniciarSesion" method="POST">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/logo1.png">
            <h2>Bienvenido Sistema VolBaL V1.4</h2>
            <input type="text" name="nombre_usuario" placeholder="👤Usuario">
            <input type="password" name="password" placeholder="🔐Contraseña">
            <input type="submit" value="Ingresar">
        </form>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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