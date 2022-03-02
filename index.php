<?php 
  if(isset($_GET['logout'])){
    ?>
      <script type="text/javascript">
        localStorage.removeItem('nombre_persona');  
        localStorage.removeItem('rol_usuario');  
        localStorage.removeItem('id_usuario');  
      </script>
    <?php
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
            <svg xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 279.66 166.45" width="280" height="280" style="position: absolute; bottom: 10px; right: 25px; color: rgba(51, 65, 85, 1);">
              <g data-name="Capa 2">
                <g data-name="Capa 1">
                  <path fill="currentColor" d="M3 165.7a5.54 5.54 0 0 1-2.18-2.06 6.05 6.05 0 0 1 0-6A5.64 5.64 0 0 1 3 155.59a6.56 6.56 0 0 1 3.12-.74 6.53 6.53 0 0 1 2.63.51 5.22 5.22 0 0 1 2 1.48L9 158.37a3.6 3.6 0 0 0-2.82-1.31 3.67 3.67 0 0 0-1.86.46 3.26 3.26 0 0 0-1.28 1.27 4.07 4.07 0 0 0 0 3.72 3.26 3.26 0 0 0 1.28 1.27 3.67 3.67 0 0 0 1.86.46A3.59 3.59 0 0 0 9 162.91l1.66 1.54a5.28 5.28 0 0 1-2 1.49 6.61 6.61 0 0 1-2.64.51A6.43 6.43 0 0 1 3 165.7Zm11.49 0a5.81 5.81 0 0 1-2.19-8 5.55 5.55 0 0 1 2.19-2.08 6.55 6.55 0 0 1 3.15-.75 6.53 6.53 0 0 1 3.14.75 5.62 5.62 0 0 1 2.22 2.06 5.91 5.91 0 0 1 0 5.94 5.69 5.69 0 0 1-2.19 2.08 6.53 6.53 0 0 1-3.14.75 6.55 6.55 0 0 1-3.18-.75Zm4.94-1.92a3.21 3.21 0 0 0 1.26-1.27 4 4 0 0 0 0-3.72 3.21 3.21 0 0 0-1.26-1.27 3.48 3.48 0 0 0-1.79-.46 3.55 3.55 0 0 0-1.8.46 3.25 3.25 0 0 0-1.25 1.27 4 4 0 0 0 0 3.72 3.25 3.25 0 0 0 1.25 1.27 3.55 3.55 0 0 0 1.8.46 3.48 3.48 0 0 0 1.79-.46ZM36 155v11.22h-2.12l-5.59-6.81v6.81h-2.56V155h2.15l5.57 6.81V155Zm3.79 11.09a5.91 5.91 0 0 1-2-.94l.88-2a6.28 6.28 0 0 0 1.72.85 6.51 6.51 0 0 0 2 .32A3.17 3.17 0 0 0 44 164a1 1 0 0 0 .53-.88.84.84 0 0 0-.32-.66 2.25 2.25 0 0 0-.8-.43c-.32-.1-.76-.22-1.32-.35a16.94 16.94 0 0 1-2.1-.61 3.38 3.38 0 0 1-1.4-1 2.65 2.65 0 0 1-.58-1.8 3.14 3.14 0 0 1 .52-1.77 3.61 3.61 0 0 1 1.6-1.26 6.5 6.5 0 0 1 2.6-.46 8.17 8.17 0 0 1 2.1.26 6.34 6.34 0 0 1 1.8.73l-.81 2a6.3 6.3 0 0 0-3.1-.88 2.93 2.93 0 0 0-1.61.35 1.08 1.08 0 0 0-.52.93.91.91 0 0 0 .6.86 9.13 9.13 0 0 0 1.83.55 20.53 20.53 0 0 1 2.1.61 3.66 3.66 0 0 1 1.4 1 2.58 2.58 0 0 1 .59 1.78 3.07 3.07 0 0 1-.54 1.76A3.7 3.7 0 0 1 45 166a6.58 6.58 0 0 1-2.61.47 9.12 9.12 0 0 1-2.6-.38Zm17.79-1.92v2.09h-8.69V155h8.48v2.08h-5.9v2.44h5.21v2h-5.21v2.59Zm2.04 1.83a3.83 3.83 0 0 1-1.56-1.21l1.44-1.73a2.58 2.58 0 0 0 2.08 1.24q1.59 0 1.59-1.86v-5.34h-3.94V155h6.52v7.27a4.27 4.27 0 0 1-1 3.11 4.1 4.1 0 0 1-3 1 5 5 0 0 1-2.13-.38Zm10.97-.3a5.81 5.81 0 0 1-2.19-8 5.62 5.62 0 0 1 2.19-2.08 6.6 6.6 0 0 1 3.15-.75 6.53 6.53 0 0 1 3.14.75 5.72 5.72 0 0 1 2.2 2.08 5.91 5.91 0 0 1 0 5.94 5.79 5.79 0 0 1-2.2 2.08 6.53 6.53 0 0 1-3.14.75 6.6 6.6 0 0 1-3.15-.77Zm4.94-1.92a3.21 3.21 0 0 0 1.26-1.27 4 4 0 0 0 0-3.72 3.21 3.21 0 0 0-1.26-1.27 3.71 3.71 0 0 0-3.58 0 3.21 3.21 0 0 0-1.26 1.27 4 4 0 0 0 0 3.72 3.21 3.21 0 0 0 1.31 1.27 3.71 3.71 0 0 0 3.58 0ZM96.65 155v11.22h-2.13l-5.59-6.81v6.81h-2.57V155h2.15l5.58 6.81V155Zm10.04 8.85h-5.2l-1 2.41h-2.66l5-11.22h2.57l5 11.22h-2.72Zm-.81-2-1.78-4.29-1.78 4.29Zm7.81 3.85a5.48 5.48 0 0 1-2.18-2.06 6.05 6.05 0 0 1 0-6 5.57 5.57 0 0 1 2.18-2.07 6.52 6.52 0 0 1 3.11-.74 6.61 6.61 0 0 1 2.64.51 5.38 5.38 0 0 1 2 1.48l-1.67 1.53a3.6 3.6 0 0 0-2.82-1.31 3.72 3.72 0 0 0-1.86.46 3.23 3.23 0 0 0-1.27 1.27 4 4 0 0 0 0 3.72 3.23 3.23 0 0 0 1.27 1.27 3.72 3.72 0 0 0 1.86.46 3.59 3.59 0 0 0 2.82-1.33l1.67 1.54a5.36 5.36 0 0 1-2 1.49 6.61 6.61 0 0 1-2.64.51 6.38 6.38 0 0 1-3.11-.73Zm9.47-10.7h2.6v11.22h-2.6Zm7.54 10.7a5.81 5.81 0 0 1-2.19-8 5.55 5.55 0 0 1 2.19-2.08 7 7 0 0 1 6.29 0 5.62 5.62 0 0 1 2.19 2.08 5.91 5.91 0 0 1 0 5.94 5.69 5.69 0 0 1-2.18 2.06 7 7 0 0 1-6.29 0Zm4.94-1.92a3.21 3.21 0 0 0 1.26-1.27 4 4 0 0 0 0-3.72 3.21 3.21 0 0 0-1.26-1.27 3.48 3.48 0 0 0-1.79-.46 3.55 3.55 0 0 0-1.8.46 3.25 3.25 0 0 0-1.25 1.27 4 4 0 0 0 0 3.72 3.25 3.25 0 0 0 1.25 1.27 3.55 3.55 0 0 0 1.8.46 3.48 3.48 0 0 0 1.79-.46Zm16.58-8.78v11.22h-2.13l-5.59-6.81v6.81h-2.56V155h2.15l5.57 6.81V155Zm10.05 8.85h-5.21l-1 2.41h-2.66l5-11.22h2.6l5 11.22h-2.72Zm-.82-2-1.78-4.29-1.77 4.29Zm5.7-6.85h2.6v9.1h5.62v2.12h-8.22Zm22.9 9.17v2.09h-8.69V155h8.48v2.08h-5.9v2.44h5.21v2h-5.21v2.59Zm2.06-9.17h2.6v9.1h5.62v2.12h-8.22Zm18.36 9.17v2.09h-8.68V155h8.47v2.08h-5.89v2.44h5.2v2h-5.2v2.59Zm4.3 1.53a5.45 5.45 0 0 1-2.17-2.06 6 6 0 0 1 0-6 5.54 5.54 0 0 1 2.17-2.07 7 7 0 0 1 5.75-.23 5.22 5.22 0 0 1 2 1.48l-1.66 1.53a3.6 3.6 0 0 0-2.82-1.31 3.67 3.67 0 0 0-1.86.46 3.17 3.17 0 0 0-1.27 1.27 4 4 0 0 0 0 3.72 3.17 3.17 0 0 0 1.27 1.27 3.67 3.67 0 0 0 1.86.46 3.59 3.59 0 0 0 2.82-1.33l1.66 1.54a5.24 5.24 0 0 1-2 1.49 6.63 6.63 0 0 1-2.65.51 6.43 6.43 0 0 1-3.1-.73Zm11.69-8.54h-3.59V155h9.78v2.12h-3.59v9.1h-2.6Zm9.7 8.54a5.81 5.81 0 0 1-2.19-8 5.55 5.55 0 0 1 2.19-2.08 6.6 6.6 0 0 1 3.15-.75 6.53 6.53 0 0 1 3.14.75 5.62 5.62 0 0 1 2.19 2.08 5.91 5.91 0 0 1 0 5.94 5.69 5.69 0 0 1-2.19 2.08 6.53 6.53 0 0 1-3.14.75 6.6 6.6 0 0 1-3.15-.77Zm4.94-1.92a3.21 3.21 0 0 0 1.26-1.27 4 4 0 0 0 0-3.72 3.21 3.21 0 0 0-1.26-1.27 3.48 3.48 0 0 0-1.79-.46 3.55 3.55 0 0 0-1.8.46 3.25 3.25 0 0 0-1.25 1.27 4 4 0 0 0 0 3.72 3.25 3.25 0 0 0 1.25 1.27 3.55 3.55 0 0 0 1.8.46 3.48 3.48 0 0 0 1.79-.46Zm13.44 2.48-2.16-3.13H250v3.13h-2.6V155h4.85a6.23 6.23 0 0 1 2.59.5 3.7 3.7 0 0 1 2.28 3.57 3.64 3.64 0 0 1-2.3 3.54l2.51 3.61Zm-.65-8.6a2.72 2.72 0 0 0-1.78-.5H250v3.91h2.12a2.72 2.72 0 0 0 1.78-.52 2 2 0 0 0 0-2.89Zm12.67 6.19h-5.21l-1 2.41h-2.65l5-11.22h2.56l5 11.22h-2.73Zm-.82-2-1.74-4.26-1.77 4.29Zm5.71-6.85H274v9.1h5.62v2.12h-8.21ZM31.47 88.86c1.22-10 4.81-18.18 9.16-25.9 15.41-27.35 37.58-47 67.5-57.17a103.51 103.51 0 0 1 72.79 1.7c31.52 12.34 53.34 34.82 66.3 66 1.92 4.63 1 8.06-2.64 9.16-4.17 1.28-6.49-1-8.09-4.62-10.56-24.31-27-43.54-50.69-55.66-27.7-14.18-56.55-14.61-85.69-4.61-25.6 8.77-43.95 26.15-57.81 49.18-3.29 5.46-4.58 9.21-7 15-.62 1.48-1.3 5.06-3.83 6.92Z" />
                  <path fill="currentColor" d="M53.3 81.94a15.67 15.67 0 0 1 1.7-6.8c10.1-18.74 23.5-33.9 42.61-44.46 16-8.86 32.5-12.87 50.45-11.91C173.82 20.15 195 31.44 212.3 50a92.18 92.18 0 0 1 23.36 46.09c.25 1.3.53 2.61.7 3.92.51 4-.69 7.12-5 7.72s-6.13-2.23-6.87-6.15c-2.22-11.83-5.89-23.18-12.67-33.24-24-35.55-70-52.51-111.34-33.64-11.9 5.43-21.12 13.9-30.14 23.09C64.17 64 59.3 72.94 53.3 81.94Z" />
                  <path fill="currentColor" d="M80.3 70.94c1.7-4.81 9.84-11.83 13.28-14.65 24.9-20.44 59.22-24.4 86.61-8.26s40.47 40.58 39.08 72.5c-.09 2-.14 4.08-1.52 5.69-1.86 2.15-4.35 3.16-7.07 2.29a5.84 5.84 0 0 1-4.07-6.51c2.2-10.5-.42-20.39-3.32-30.18-2.79-9.44-7-16.26-13-23.88-3.93-5-11-10.15-16.8-13.36-13.86-7.7-28.5-10-44.37-8.1-16.82 2.05-30.9 9.11-43.62 19.69-.17.14-4.5 4.77-5.2 4.77Z" />
                  <path fill="currentColor" d="M99.3 76.94a60.26 60.26 0 0 1 15.58-11.82c20.77-10 41.33-9.43 60.62 3.25 23.67 15.56 29.51 42.32 21.8 67.33-1.09 3.52-3 6.94-7.88 5.46-3.95-1.21-4.83-3.84-3.1-9.38 5.66-18.1 4.28-35.25-8-50.33C160.92 60 132.46 56 109.06 70.94c-2.06 1.31-9.5 6.32-9.76 6ZM33 113.49c.17-1.23.26-2.47.51-3.68 2-9.86 7.73-16.66 17.28-19.81 8.49-2.8 16.66-1.75 24 3.6 5.52 3.34 9.69 13.58 9.9 14.45a1.09 1.09 0 0 1 0 .2l-15.2 1.11c-.46 0-2.27-2.22-3.77-3.63a9.66 9.66 0 0 0-8.21-2.41c-6.29.79-9.92 6.49-9.32 12.7a10.9 10.9 0 0 0 3.27 7.11 10.61 10.61 0 0 0 8.89 2.77c5.05-.55 9.06-6.11 9.16-6.74l15.46.45A47.2 47.2 0 0 1 78.45 132a22.62 22.62 0 0 1-14.62 8.22 27.28 27.28 0 0 1-14.64-1.47c-8.85-3.58-14.08-10.17-15.79-19.55-.19-1-.27-2.08-.4-3.11Z" />
                  <path fill="currentColor" d="M129.62 140.63h-15.08v-31.86a13.76 13.76 0 0 0-.37-3.19 2.57 2.57 0 0 0-2.57-2.07c-1.56-.07-2.68.5-3.11 1.84a10.35 10.35 0 0 0-.46 3c-.05 4.23 0 8.45 0 12.68v19.51H92.9v-33.03a20.29 20.29 0 0 1 2.58-10.34 16.89 16.89 0 0 1 12.24-8.28 21.56 21.56 0 0 1 11 .72c5.7 2 9 6.13 10.22 11.93a35.13 35.13 0 0 1 .61 7c.06 10.47 0 20.94 0 31.41Zm38.68-52.1v14.9h-9.8a10.24 10.24 0 0 0-2.52.32 2.16 2.16 0 0 0-1.58 2.45c0 1.4.53 2.09 1.78 2.33a14.87 14.87 0 0 0 2.74.26h8.33v11.63h-11.06a2.54 2.54 0 0 0-2.8 2.56 2.34 2.34 0 0 0 2.49 2.66h12.39v14.87a2.79 2.79 0 0 1-.43.06h-13.48a17.27 17.27 0 0 1-6.56-1.12 14.26 14.26 0 0 1-9.05-11.33 20.51 20.51 0 0 1-.28-3.23v-21a18 18 0 0 1 1.14-6.57c1.89-4.84 5.6-7.44 10.57-8.4a24.81 24.81 0 0 1 4.39-.41c4.4-.06 8.8 0 13.2 0Z" />
                </g>
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
                <div class="Sustitle">Sistema de entrenamiento para digitadores</div>
                <div class="description">Consejo Nacional Electoral<br>
                    ¡Ecuador unido en democracia!</div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>