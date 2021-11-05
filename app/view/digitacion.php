<?php
    require '../model/login.model.php';
    if($_SESSION['nombre_persona'] == ""){
    	header('Location: ../');
    }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="descriptions" content="Sistema de adiestramiento para digitadores">
    <meta name="author" content="JOSUE ISRAEL CHAVEZ VARGAS">
    <title>DIGITA</title>
    <link rel="icon" type="image/png" href="../assets/img/favicon.svg"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link href="../assets/css/dark.css" rel="stylesheet">
    <script src="../assets/js/sweetalert2.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../js/digitacion.js"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
  </head>
  <body>
  <?php
      require 'header.php';
  ?>
<div class="container-fluid text-center">
  <div class="row align-items-center">
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-2">
        <nav aria-label="breadcrumb bg-light">
      <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item active">Proceso</li>
        <li class="breadcrumb-item active" aria-current="page">Digitación</li>
      </ol>
    </nav>
    </div>
  </div>
</div>
<div class="container">
        <div class="card">
            <div class="card-header bg-primary text-color-white btn-space-digitacion">
                  <button class="btn btn-success" id="iniciar" onclick="iniciar();"><span class="fa fa-play-circle"></span>&nbsp&nbspIniciar</button>
                  <label id="indicadorActa">1 / 1</label>
                  <button class="btn btn-success" id="finalizar" onclick="finalizar();"><span class="fa fa-flag"></span>&nbsp&nbspFinalizar</button>
            </div>
        </div>
        <div class="row">
          <div class="col-6 col-sm-6 col-md-7 col-lg-7 col-xl-7 mt-4 ml-5">
              <button class="btn btn-success" id="Nuevo"  onclick="Nuevo();"><span class="fa fa-pencil-alt"></span>&nbsp&nbspNuevo&nbsp&nbsp ->&nbsp&nbsp alt + q</button>
              <button class="btn btn-success" id="Guardar" onclick="Guardar();"><span class="fa fa-save"></span>&nbsp&nbspGuardar&nbsp&nbsp ->&nbsp&nbsp alt + n</button>
              <button class="btn btn-success" id="Liberar" onclick="Liberar();"><span class="fa fa-times-circle"></span>&nbsp&nbspLiberar&nbsp&nbsp ->&nbsp&nbsp alt + r</button>
          </div>
          <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 mt-4">
              <label for="novedad" class="label-nov">Novedades&nbsp&nbsp&nbsp&nbsp
              <select name="novedad" id="novedad" class="form-control br">
                <option value="Acta valida">Acta valida</option>
                <option value="Inconsistencia numérica">Inconsistencia numérica</option>
                <option value="Acta no visible">Acta no visible</option>
              </select>
              </label>
          </div>
        </div>
        <div class="container-acta">
          <div class="container-seccion-acta">
            <div class="header-acta">
                <label class="uno" for="">Corte Imagen</label>          
                <label class="dos" for="">Valor</label>          
            </div>
            <div class="content-acta" id="content-acta">
            </div>
          </div>
        </div>
        <div class="footer">
        <div class="row">
          <div class="col-6 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
              <button class="btn btn-success" disabled="true"><span class="fa fa-pencil-alt"></span>&nbsp&nbspNuevo&nbsp&nbsp ->&nbsp&nbsp alt + q</button>
              <button id="buttonFinal" class="btn btn-success" disabled="true"><span class="fa fa-save"></span>&nbsp&nbspGuardar&nbsp&nbsp ->&nbsp&nbsp alt + n</button>
              <button class="btn btn-success" disabled="true"><span class="fa fa-times-circle"></span>&nbsp&nbspLiberar&nbsp&nbsp ->&nbsp&nbsp alt + r</button>
          </div>
        </div>
        </div>
    </div>
</html>



 






















