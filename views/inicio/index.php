<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VolBaL</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/login.css">
</head>
<body>
    <div class="main-login">
<form action="<?php echo constant('URL'); ?>inicio/iniciarSesion" method="POST">
    <input type="image" class="logo-img" src="<?php echo constant('URL'); ?>assets/img/logo1.png" style="width: 200px; display: block; margin: 0 auto;">
    <h2>Bienvenido Sistema VolBaL V1.5</h2>

    <!-- Usuario -->
    <div style="position: relative; width: 100%;">
        <input type="text" name="nombre_usuario" placeholder="👤Usuario" style="padding-right: 0px;">
    </div>

    <!-- Contraseña -->
    <div style="position: relative; width: 100%;">
        <input id="password" type="password" name="password" placeholder="🔐Contraseña" style="padding-right: 0px;">
        <span id="togglePassword"
            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
                   cursor: pointer; user-select: none; font-size: 20px;">👁️</span>
    </div>

    <input type="submit" value="Ingresar">
</form>


    </div>
    <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Cambiar icono entre ojo y monito
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>

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