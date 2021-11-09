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
    <script src="../js/usuario.js"></script>
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
        <li class="breadcrumb-item active">Usuarios</li>
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
      </ol>
    </nav>
    </div>
  </div>
</div>
<div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-color-white">
                  <h5>Gestionar Usuarios</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-xl-8 mt-2">
                        <div class="btn-group-sm">
                            <button class="btn btn-success" id="guardar"  onclick="Guardar();"><span class="fa fa-save"></span>&nbsp&nbspGuardar</button>
                            <button class="btn btn-success" id="modificar" onclick="Modificar();"><span class="fa fa-pencil-alt"></span>&nbsp&nbspModificar</button>
                            <button class="btn btn-primary" id="cancelar" onclick="Cancelar();"><span class="fa fa-ban"></span>&nbsp&nbspCancelar</button>
                            <button class="btn btn-danger" id="borrarUsuarios" onclick="borrarUsuarios();"><span class="fa fa-trash-alt"></span>&nbsp&nbspEliminar Usuarios</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-xl-4 input-group mt-2">
                      <button class="btn btn-success mr-2" type="submit" onclick="mostrarTodo();"><span class="fa fa-search"></span>&nbsp&nbspMostrar Todo</button>
                      <input type="text" class="form-control" name="idUsuario"  id="idUsuario" onKeyUp="EscucharConsulta(this.value)"  placeholder="Buscar por Nombre" autofocus>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label for="NombrePersona">Nombre de Persona</label>
                        <input type="text"  name="NombrePersona" class="form-control br" id="NombrePersona" style="text-transform: uppercase;">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="nombreUsuario">Nombre de usuario</label>
                        <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="clave">Clave</label>
                        <input type="text" name="clave" id="clave" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="rolUsuario">Rol de Usuario</label>
                        <select name="rolUsuario" class="form-control br" id="rolUsuario">
                            <option value="DIGITADOR">DIGITADOR</option>
                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                       </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <table class="table tabled-bordered table-sm" id="tablaUsuario">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre de Persona</th>
                            <th>Nombre de usuario</th>
                            <th>Clave</th>
                            <th>Rol del Usuario</th>
                            <th class="th-text-align-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="datos">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</html>




















