<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VolBaL</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/default.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
</head>

<body>
    <header>
        <div class="logo">
            <div class="btn-menu">
                <label for="btn-menu">
                    <h2>☰</h2>
                </label>
            </div>
            <img src="<?php echo constant('URL'); ?>assets/img/logoBlanco.png" alt="Logo Bamex">
        </div>
        <div class="cont-lateral">
            <nav>
                <ul>
                    <a href="<?php echo constant('URL'); ?>personal/listarPersonal">Voluntariado</a>
                    <a href="<?php echo constant('URL'); ?>candidato/listar">Candidata</a>
                    <a href="<?php echo constant('URL'); ?>curso/listar">Curso</a>
                    <a href="<?php echo constant('URL'); ?>peticion/listar">Peticiones</a>
                    <a href="<?php echo constant('URL'); ?>reporteSemanal/verReportePeriodo">Reportes</a>
                </ul>
            </nav>
        </div>
    </header>
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="<?php echo constant('URL'); ?>usuario/listar">Usuarios</a>
                <a href="<?php echo constant('URL'); ?>inicio/cerrar_sesion">Cerrar sesion</a>
                <iframe src="<?php echo constant('URL'); ?>manualUsuario.pdf" style="width:750%; height:700px;" frameborder="0" ></iframe>
            </nav>
            <label for="btn-menu">✖️</label>
        </div>
    </div>
</body>

</html>