<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div class="container-fluid">
        <div class="center-form">
            <h1 class="center">Asignar Voluntariado</h1>
            <h1 class="center"><?php echo $_SESSION['nombreCurso'];?></h1>
            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center">
                <form action="<?php echo constant('URL'); ?>personal/listarPersonal/ <?php echo $this->idCurso ?>"
                    method="POST">
                    <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo"checked onchange="this.form.submit()">Activo';
                        break;
                    // case "Candidato":
                    //     echo '<input type="radio" id="" name="radio_busqueda" value="Activo" onchange="this.form.submit()">Activo
                    //     <input type="radio" id="" name="radio_busqueda" value="Candidato"checked onchange="this.form.submit()">Candidato';
                    //     break;
                }?>
                    <p>
                        <input type="search" name="caja_busqueda" id="caja_busqueda"
                            value="<?php echo $this->consulta; ?>" autofocus>
                        <input type="submit" value="🔍Buscar">
                    </p>
                </form>
            </div>
            <form action="<?php echo constant('URL'); ?>capacitaciones/asignarCapacitacion" method="POST">
                <div id="div2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estatus</th>
                                <th>SELECCIONAR</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-personal">
                            <?php
                    include_once 'models/personalBanco.php';
                    foreach($this->personal as $row){
                        $personal = new PersonalBanco();
                        $personal = $row; 
                ?>
                            <tr id="fila-<?php echo $personal->id_personal; ?>">
                                <td><?php echo $personal->id_personal; ?></td>
                                <td><?php echo $personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre; ?>
                                </td>
                                <td><?php echo $personal->estatus; ?></td>
                                <td><input type="checkbox" value="<?php echo $personal->id_personal; ?>"
                                        name="personal[]" onclick="reload()"></td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="estado" value="<?php echo $this->estado; ?>">
                <input type="hidden" name="id" value="<?php echo $this->idCurso; ?>">
                <input type="hidden" name="nombreCurso" value="<?php echo $_SESSION['nombreCurso'];?>">
                <input type="submit" name="seleccion" value="Agregar" />
            </form>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
</body>
</html>