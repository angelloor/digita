<?php
    require '../model/configuracion.model.php';

    if($_POST){
        $configuracion = new Configuracion();

        switch($_POST['accion']){
            case "LISTARCONFIGURACION":
                $respuesta = $configuracion->listarConfiguracion();
                echo json_encode($respuesta);
            break;
            case "GUARDAR":
                $totalActas = $_POST['totalActas'];
                $numeroCandidatos = $_POST['numeroCandidatos'];
                $totalPosiblesActas = $_POST['totalPosiblesActas'];
                $respuesta = $configuracion->guardar($totalActas,$numeroCandidatos,$totalPosiblesActas);
                echo json_encode($respuesta);
            break;
            case "RESTABLECER":
                $respuesta = $configuracion->restablecer();
                echo json_encode($respuesta);
            break;
        }

    }
?>