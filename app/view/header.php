<html:5>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <img src="../assets/img/favicon.svg" class="card-img-top img-nav" alt="Imagen">
      <a class="navbar-brand" href="index.php">&nbsp&nbsp&nbspDIGITA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto" id="navbarPrincipal2">
          <script type="text/javascript">
            let htmlHeader = `<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sistema</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="configuracion.php">Configuracion</a>
                <a class="dropdown-item" href="acta.php">Actas</a>
                <a class="dropdown-item" href="usuario.php">Usuarios</a>
                <a class="dropdown-item" href="reporte.php">Reportes</a>
                </div>
              </li>`
            if (localStorage.getItem('rol_usuario') == "ADMINISTRADOR") {
                document.getElementById('navbarPrincipal2').innerHTML = htmlHeader;
            }   
          </script>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proceso</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="digitacion.php">Digitacion</a>
          </div>
        </li>
          </ul>
          <div class="form-inline my-2 my-lg-0">
          <div class="container-usuario">
            <label id="_nombre_persona"><script type="text/javascript">document.getElementById('_nombre_persona').innerText = localStorage.getItem('nombre_persona')</script></label>
            <label id="_rol_usuario"><script type="text/javascript">document.getElementById('_rol_usuario').innerText = localStorage.getItem('rol_usuario')</script></label>
            <label id="idUsuario" hidden><script type="text/javascript">document.getElementById('idUsuario').innerText = localStorage.getItem('id_usuario')</script></label>
          </div>
        </div>
          <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-success my-2 my-sm-0" href="../../index.php?logout=true"><span class="fa fa-sign-out-alt"></span>&nbsp&nbspSalir<span class="sr-only">(current)</span></a>
          </form>
        </div>
      </nav>
</html:5>