<?php

    require '../model/main.model.php';

    if($_POST){
        $main = new Main();
        switch($_POST["accion"]){
            case "TRAERCONFIGURACION":
                $respuesta = $main->traerConfiguracion();
                echo json_encode($respuesta);
            break;
            case "TRAERUSUARIOS":
                $respuesta = $main->traerUsuarios();
                echo json_encode($respuesta);
            break;
            case "TRAERSESIONES":
                $respuesta = $main->traerSesiones();
                echo json_encode($respuesta);
            break;
            case "TRAERERRORES":
                $idUsuario = $_POST['idUsuario'];
                $respuesta = $main->traerErrores($idUsuario);
                echo json_encode($respuesta);
            break;
            case "TRAERMEJORTIEMPO":
                $idUsuario = $_POST['idUsuario'];
                $respuesta = $main->traerMejorTiempo($idUsuario);
                echo json_encode($respuesta);
            break;
            case "TPA":
                $idUsuario = $_POST['idUsuario'];
                $respuesta = $main->tpa($idUsuario);
                echo json_encode($respuesta);
            break;
        }
    }
?>