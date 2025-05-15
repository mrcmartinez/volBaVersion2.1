<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<h1><?php echo $this->mensaje; ?></h1>
    <form action="<?php echo constant('URL'); ?>peticion/consultaSQL" method="POST">
        <label for="cosnulta">Consulta BD</label><br>
        <input type="text" name="consulta"><br>
        <label for="cosnulta">buscarBD BD</label><br>
        <input type="text" name="buscar"><br>
        <input type="submit" value="Consultar"><br>
    </form>

</body>

</html>