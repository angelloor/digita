<?php

    require '../model/digitacion.model.php';

    if($_POST){
        $digitacion = new digitacion();
        switch($_POST["accion"]){
            case "INICIAR":
                $idUsuario = $_POST['idUsuario'];
                $totalActas = $_POST['totalActas'];
                echo json_encode($digitacion->iniciar($idUsuario,$totalActas));
            break;
            case "PARAMETROS":
                echo json_encode($digitacion->parametros());
            break;
            case "FINALIZAR":
                $idSesion = $_POST['idSesion'];
                echo json_encode($digitacion->finalizar($idSesion));
            break;
            case "NUEVO":
                echo json_encode($digitacion->nuevo());
            break;
            case "GUARDAR":
                $idUsuario = $_POST['idUsuario'];
                $idSesion = $_POST['idSesion'];
                $numActa = $_POST['numActa'];
                $errores = $_POST['errores'];
                echo json_encode($digitacion->guardar($idUsuario,$idSesion,$numActa,$errores));
            break;
            case "VERIFICARACTAS":
                echo json_encode($digitacion->verificarActas());
            break;
        }
    }
?>