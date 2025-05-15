<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VolBaL</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
</head>
<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <h1 class="center">Nuevo voluntariado</h1>
    </div>
    <div class="container-modal">
        <div class="container">
        <form class="row g-1">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="inputEmail4">
  </div>
  <div class="col-md-3">
    <label for="inputPassword4" class="form-label">Apellido paterno</label>
    <input type="text" class="form-control" id="inputPassword4">
  </div>

  <div class="col-md-3">
    <label for="inputEmail4" class="form-label">Apellido paterno</label>
    <input type="text" class="form-control" id="inputEmail4">
  </div>

  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Calle</label>
    <input type="text" class="form-control" id="inputPassword4">
  </div>
  <div class="col-md-4">
    <label for="inputAddress" class="form-label">Colonia</label>
    <input type="text" class="form-control" id="inputAddress" >
  </div>
  <div class="col-md-2">
    <label for="inputAddress2" class="form-label">numero</label>
    <input type="number" class="form-control" id="inputAddress2" >
  </div>

  <div class="col-md-4">
    <label for="inputCity" class="form-label">Estado civil</label>
    <select class="form-select" id="specificSizeSelect">
        <option value="casada">Casada</option>
        <option value="soltera">soltera</option>
        <option value="viuda">Viuda</option>
        <option value="concubinato">Concubinato</option>
        <option value="union libre">Union Libre</option>
    </select>
  </div>
  <div class="col-md-4">
    <label for="inputCity" class="form-label">Numero de hijos</label>
    <input type="number" class="form-control" id="inputCity">
  </div>
  <div class="col-md-4">
    <label for="inputZip" class="form-label">Escolaridad</label>
    <input type="text" class="form-control" id="inputZip">
  </div>

  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Edad</label>
    <input type="number" class="form-control" id="inputEmail4">
  </div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Fecha Nacimiento</label>
    <input type="date" class="form-control" id="inputPassword4">
  </div>

  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Estatus</label>
    <select class="form-select" id="specificSizeSelect">
        <option value="casada">Activo</option>
        <option value="soltera">Temporal</option>
    </select>

  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
  </div>
</form>

        </div>

    </div>
    <?php require 'views/footer.php'; ?>
</body>
</html>