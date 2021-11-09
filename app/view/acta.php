<script type="text/javascript">
    if (!(localStorage.getItem('nombre_persona'))) {
      window.location.href = "../../index.php";
    } 
</script>
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
    <script src="../js/acta.js"></script>
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
        <li class="breadcrumb-item active">Sistema</li>
        <li class="breadcrumb-item active" aria-current="page">Actas</li>
      </ol>
    </nav>
    </div>
  </div>
</div>
<div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-color-white">
                  <h5>Gestionar Actas</h5>
            </div>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                        <div class="btn-group-sm">
                            <button class="btn btn-success" id="generarActas"  onclick="generarActas();"><span class="fa fa-redo-alt"></span>&nbsp&nbspGenerar Actas</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
    </div>
</html>




















