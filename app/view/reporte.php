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
    <script src="../js/reporte.js"></script>
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
        <li class="breadcrumb-item active" aria-current="page">Reportes</li>
      </ol>
    </nav>
    </div>
  </div>
</div>
<div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-color-white">
                  <h5>Reportes</h5>
            </div>
            <div class="card-body">
          <div class="row">
               <div class="col-12 col-sm-12 col-md-8 col-xl-8 mt-2">
                   <div class="btn-group-sm">
                       <button class="btn btn-success" id="visualizar"  onclick="visualizar();"><span class="fas fa-file-alt"></span>&nbsp&nbspVisualizar</button>
                       <button class="btn btn-success" id="pdf" onclick="pdf();"><span class="fa fa-file-pdf"></span>&nbsp&nbspPdf</button>
                       <button class="btn btn-success" id="excel" onclick="excel();"><span class="fa fa-file-excel"></span>&nbsp&nbspExcel</button>
                   </div>
               </div>
           </div>
          <div class="row mt-2">
            <div class="col-md-3 mt-2">
                <label for="fechaInicio">Fecha Inicio</label>
                <input type="datetime-local" class="form-control" name="fechaInicio" id="fechaInicio">
            </div>
            <div class="col-md-3 mt-2">
                <label for="fechaFinal">Fecha Final</label>
                <input type="datetime-local" class="form-control" name="fechaFinal" id="fechaFinal">
            </div>
        </div>
        </div>
        <div class="card-footer">
                <table class="table tabled-bordered table-sm" id="tablaReporte">
                    <thead>
                        <tr>
                            <th>Id Sesion</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Total Actas</th>
                            <th>Hora Inicio</th>
                            <th>Hora Final</th>
                            <th>Tiempo Total</th>
                            <th>TPA</th>
                            <th>Errores</th>
                        </tr>
                    </thead>
                    <tbody id="datos">

                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</html>




















