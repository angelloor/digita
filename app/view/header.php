<html:5>
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
</html:5>