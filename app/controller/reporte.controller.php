<?php
    require '../model/reporte.model.php';

    if($_POST){
        $reporte = new Reporte();
        switch($_POST['accion']){
            case "VISUALIZAR":
                $fechaInicio = $_POST['fechaInicio'];
                $fechaFinal = $_POST['fechaFinal'];
                $respuesta = $reporte->visualizar($fechaInicio,$fechaFinal);
                echo json_encode($respuesta);
            break;
            case "CONSULTA_SESION":
                $fechaInicio = $_POST['fechaInicio'];
                $fechaFinal = $_POST['fechaFinal'];
                $respuesta = $reporte->consultaSesion($fechaInicio,$fechaFinal);
                echo json_encode($respuesta);
            break;
            case "CONSULTA_DATOS":
                $fechaInicio = $_POST['fechaInicio'];
                $fechaFinal = $_POST['fechaFinal'];
                $respuesta = $reporte->consultarDatos($fechaInicio,$fechaFinal);
                echo json_encode($respuesta);
            break;
            case "ERRORES":
                $idSesion = $_POST['idSesion'];
                $respuesta = $reporte->errores($idSesion);
                echo json_encode($respuesta);
            break;
        }
    }
?>