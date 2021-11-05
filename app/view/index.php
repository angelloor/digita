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
    <link rel="icon" type="image/svg" href="../assets/img/favicon.svg"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link href="../assets/css/dark.css" rel="stylesheet">
    <script src="../assets/js/sweetalert2.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <img src="../assets/img/favicon.svg" class="card-img-top img-nav" alt="Imagen">
      <a class="navbar-brand" href="index.php">&nbsp&nbsp&nbspDIGITA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
        <?php
        if($_SESSION['rol_usuario'] == "ADMINISTRADOR"){
          echo '<li class="nav-item dropdown">';
          echo '<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sistema</a>';
          echo '<div class="dropdown-menu" aria-labelledby="dropdown01">';
          echo '<a class="dropdown-item" href="configuracion.php">Configuracion</a>';
          echo '<a class="dropdown-item" href="acta.php">Actas</a>';
          echo '<a class="dropdown-item" href="usuario.php">Usuarios</a>';
          echo '<a class="dropdown-item" href="reporte.php">Reportes</a>';
          echo '</div>';
          echo '</li>';
        }
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proceso</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="digitacion.php">Digitacion</a>
          </div>
        </li>
          </ul>
          <div class="form-inline my-2 my-lg-0">
          <div class="container-usuario">
            <label><?php echo $_SESSION['nombre_persona'];  ?></label>
            <label><?php echo $_SESSION['rol_usuario'];  ?></label>
            <label id="idUsuario" hidden><?php echo $_SESSION['id_usuario'];  ?></label>
          </div>
        </div>
          <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-success my-2 my-sm-0" href="../../index.php?logout=true"><span class="fa fa-sign-out-alt"></span>&nbsp&nbspSalir<span class="sr-only">(current)</span></a>
          </form>
        </div>
      </nav>
      <main>
        <div class="container-main">
          <div class="container-main-title">
            <h4>
              Configuración Actual
            </h4>
          </div>
          <div class="container-element">
              <!-- element -->
              <div class="element">
                <div class="section-1">
                  <div class="element-value">
                    <h3 id="totalActas"></h3>
                  </div>
                  <div class="element-description">
                    <h4>Actas a Digitar</h4>
                  </div>
                </div>
                <div class="section-2">
                  <div class="element-img">
                    <img src="../assets/img/actas.svg" alt="logo" class="img70">
                  </div>
                </div>
                <div class="element-footer">
                  <h4></h4>
                </div>
              </div>
              <!-- element -->
              
              <!-- element -->
              <div class="element color-dos">
                <div class="section-1">
                  <div class="element-value">
                    <h3 id="totalCandidatos"></h3>
                  </div>
                  <div class="element-description">
                    <h4>Total Candidatos</h4>
                  </div>
                </div>
                <div class="section-2">
                  <div class="element-img">
                    <img src="../assets/img/candi.svg" alt="logo" class="img70">
                  </div>
                </div>
                <div class="element-footer color-dos-footer">
                  <h4></h4>
                </div>
              </div>
              <!-- element -->
              <!-- element -->
              <div class="element color-tres">
                <div class="section-1">
                  <div class="element-value">
                    <h3 id="estadoGeneracion"></h3>
                  </div>
                  <div class="element-description">
                    <h4>Estado Generación</h4>
                  </div>
                </div>
                <div class="section-2">
                  <div class="element-img">
                    <img src="../assets/img/generacion.svg" alt="logo" class="img70">
                  </div>
                </div>
                <div class="element-footer color-tres-footer">
                  <h4></h4>
                </div>
              </div>
              <!-- element -->
              <!-- element -->

              <?php
        if($_SESSION['rol_usuario'] == "ADMINISTRADOR"){
          echo '
          <div class="element color-cuatro">
          <div class="section-1">
            <div class="element-value">
              <h3 id="totalUsuarios"></h3>
            </div>
            <div class="element-description">
              <h4>Total Usuarios</h4>
            </div>
          </div>
          <div class="section-2">
            <div class="element-img">
              <img src="../assets/img/user.svg" alt="logo" class="img70">
            </div>
          </div>
          <div class="element-footer color-cuatro-footer">
            <h4></h4>
          </div>
        </div>
          ';
        }
        ?>
              <!-- element -->
              
              <!-- element -->
              <?php
        if($_SESSION['rol_usuario'] == "ADMINISTRADOR"){
          echo '
          <div class="element color-cinco">
                <div class="section-1">
                  <div class="element-value">
                    <h3 id="totalSesiones"></h3>
                  </div>
                  <div class="element-description">
                    <h4>Total Sesiones</h4>
                  </div>
                </div>
                <div class="section-2">
                  <div class="element-img">
                    <img src="../assets/img/sesion.svg" alt="logo" class="img70">
                  </div>
                </div>
                <div class="element-footer color-cinco-footer">
                  <h4></h4>
                </div>
              </div>
          ';
        }
        ?>
              <!-- element -->
          </div>
          <div class="container-main-title">
            <h4>
              Mi Puntuación
            </h4>
          </div>
          <!-- score -->
          <div class="container-element">
              <!-- element -->
              <div class="element width-33 color-tres">
                <div class="section-1">
                  <div class="element-value">
                    <h3 id="mejorTiempo"></h3>
                  </div>
                  <div class="element-description">
                    <h4>Mejor Tiempo</h4>
                  </div>
                </div>
                <div class="section-2">
                  <div class="element-img">
                    <img src="../assets/img/score.svg" alt="logo" class="img70"> 
                  </div>
                </div>
                <div class="element-footer color-tres-footer">
                  <h4></h4>
                </div>
              </div>
              <!-- element -->
              
              <!-- element -->
              <div class="element width-33 color-dos">
                <div class="section-1">
                  <div class="element-value">
                    <h3 id="tpa"></h3>
                  </div>
                  <div class="element-description">
                    <h4>Mejor TPA</h4>
                  </div>
                </div>
                <div class="section-2">
                  <div class="element-img">
                    <img src="../assets/img/tpa.svg" alt="logo" class="img70">
                  </div>
                </div>
                <div class="element-footer color-dos-footer">
                  <h4></h4>
                </div>
              </div>
              <!-- element -->
              <!-- element -->
              <div class="element width-33">
                <div class="section-1">
                  <div class="element-value">
                    <h3 id="errores"></h3>
                  </div>
                  <div class="element-description">
                    <h4>Total Errores</h4>
                  </div>
                </div>
                <div class="section-2">
                  <div class="element-img">
                    <img src="../assets/img/error.svg" alt="logo" class="img70">
                  </div>
                </div>
                <div class="element-footer">
                  <h4></h4>
                </div>
              </div>
              <!-- element -->
          </div>
          <!-- score -->
        </div>
      </main>
  </body>
</html>




















