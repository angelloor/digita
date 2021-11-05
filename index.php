<?php 
  session_start();
  if(isset($_GET['logout'])){
      session_destroy();
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
    <link rel="icon" type="image/png" href="./app/assets/img/favicon.svg"/>
    <link rel="stylesheet" href="./app/assets/css/bootstrap.min.css">
    <script src="./app/assets/js/jquery.js"></script>
    <script src="./app/assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./app/assets/css/all.min.css">
    <link href="./app/assets/css/dark.css" rel="stylesheet">
    <script src="./app/assets/js/sweetalert2.min.js"></script>
    <script src="./app/assets/js/all.min.js"></script>
    <script src="./app/assets/js/jquery.js"></script>
    <script src="./app/js/login.js"></script>
    <link rel="stylesheet" href="./app/assets/css/main.css">
  </head>
  <style >
    .containerLogin {
    height: calc(100vh );
    width: calc(100vw );
    padding: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #f1f5f9;
      }
    .containerLogin > .containerCard {
      width: 100%;
      max-width: 72rem !important;
      border-radius: 1rem;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2), 0 1px 3px 0 rgba(0, 0, 0, 0.1),
        0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
      overflow: hidden !important;
      display: flex;
      background-color: rgba(255, 255, 255, 1) !important;
    }

    .containerLogin > .containerCard > .containerSectionForm {
      width: 27% !important;
      padding: 4rem;
    }

    .containerLogin
      > .containerCard
      > .containerSectionForm
      > .containerForm
      > .titleAuth {
      font-size: 20px;
      letter-spacing: -0.025em !important;
      margin-top: 2rem !important;
      line-height: 1.25 !important;
      font-weight: 800 !important;
    }

    .containerLogin
      > .containerCard
      > .containerSectionForm
      > .containerForm
      > .descriptionAuth {
      font-size: 14px;
      margin-top: 0.125rem !important;
      font-weight: 300 !important;
    }

    .containerLogin
      > .containerCard
      > .containerSectionForm
      > .containerForm
      > .form {
      margin-top: 10px;
    }

    .containerLogin
      > .containerCard
      > .containerSectionForm
      > .containerForm
      > .form
      > .imputForm {
      width: 100%;
      padding: 10px 0px;
    }

    .containerLogin
      > .containerCard
      > .containerSectionForm
      > .containerForm
      > .form
      > .btnFormLogin {
      margin-top: 15px;
      height: 48px;
      background-color: #166534;
      width: 100%;
      border-radius: 25px;
    }


    .containerLogin > .containerCard > .containerSectionInfo {
      padding: 4rem !important;
      padding-left: 7rem !important;
      padding-right: 7rem !important;
      display: flex !important;
      flex-direction: column;
      position: relative !important;
      overflow: hidden !important;
      height: auto !important;
      min-height: 500px;
      max-height: 600px;
      flex: 1 1 auto !important;
      justify-content: center !important;
      align-items: center !important;
      background-color: rgba(30, 41, 59, 1);
    }

    .containerLogin > .containerCard > .containerSectionInfo > .svg1 {
      top: 0px !important;
      right: 0px !important;
      bottom: 0px !important;
      left: 0px !important;
      position: absolute !important;
      pointer-events: none !important;
      color: rgba(51, 65, 85, 0.2) !important;
    }

    .containerLogin > .containerCard > .containerSectionInfo > .svg2 {
      position: absolute !important;
      right: -4rem !important;
      top: -4rem !important;
      color: rgba(51, 65, 85, 1) !important;
    }

    .containerLogin > .containerCard > .containerSectionInfo > .containerInfo {
      z-index: 10 !important;
      width: 100% !important;
      position: relative !important;
      max-width: 42rem !important;
    }

    .containerLogin
      > .containerCard
      > .containerSectionInfo
      > .containerInfo
      > .title {
      font-size: 3rem;
      font-weight: 700;
      color: white;
      line-height: 1 !important;
    }

    .containerLogin
      > .containerCard
      > .containerSectionInfo
      > .containerInfo
      > .Sustitle {
      margin-top: 5px;
      font-size: 1.5rem;
      font-weight: 500;
      color: rgba(148, 163, 184, 1) !important;
      line-height: 1 !important;
    }

    .containerLogin
      > .containerCard
      > .containerSectionInfo
      > .containerInfo
      > .description {
      margin-top: 1.5rem !important;
      letter-spacing: -0.025em !important;
      line-height: 1.5rem !important;
      font-size: 1rem !important;
      color: rgba(148, 163, 184, 1) !important;
    }

  </style>
  <body>
  <div class="containerLogin">
    <div class="containerCard">
        <div class="containerSectionForm">
            <div class="containerForm">
                <div class="ng-tns-c175-21">
                    <img src="./app/assets/img/logo.svg" width="200px">
                </div>
                <div class="titleAuth" style="font-size: 20px">Ingresar</div>
                <div class="descriptionAuth">
                    <div>Ingrese sus credenciales para continuar</div>
                </div>
                <div class="form">
                  <div class="row">
                      <div class="col-md-12 mt-2">
                          <label for="usuario">Usuario</label>
                          <input type="text" id="usuario" name="usuario" onkeypress="enter(1)" class="form-control br" >
                      </div>
                      <div class="col-md-12 mt-2">
                          <label for="clave" class="margen">Contraseña</label>
                          <input type="password" id="clave" name="clave" onkeypress="enter(2)" class="form-control br">
                      </div>
                      <div class="col-md-12 mt-2">
                          <button class="btn btn-success mt-2" style="width: 100%;"type="submit" onclick="iniciarSesion();">&nbsp&nbspIngresar</button>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="containerSectionInfo">
            <svg class="svg1" viewBox="0 0 960 540" width="100%" height="100%" preserveAspectRatio="xMidYMax slice"
                xmlns="http://www.w3.org/2000/svg">
                <g class="text-gray-700 opacity-25" fill="none" stroke="currentColor" stroke-width="100">
                    <circle r="234" cx="196" cy="23"></circle>
                    <circle r="234" cx="790" cy="491"></circle>
                </g>
            </svg>
            <svg class="svg2" viewBox="0 0 220 192" width="220" height="192" fill="none">
                <defs>
                    <pattern id="837c3e70-6c3a-44e6-8854-cc48c737b659" x="0" y="0" width="20" height="20"
                        patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" fill="currentColor"></rect>
                    </pattern>
                </defs>
                <rect width="220" height="192" fill="url(#837c3e70-6c3a-44e6-8854-cc48c737b659)"></rect>
            </svg>
            <div class="containerInfo">
                <div class="title">DIGITA</div>
                <div class="Sustitle">Sistema de adiestramiento para digitadores</div>
                <div class="description">Universidad Regional Autónoma de Los Andes<br>
                    ¡UNIANDES a la altura de tus sueños!</div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>