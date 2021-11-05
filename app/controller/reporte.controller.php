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
            case "CONSULTAR":
                $respuesta = $reporte->consultar();
                echo json_encode($respuesta);
            break;
        }
    }
?>