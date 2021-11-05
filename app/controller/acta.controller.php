<?php

    require '../model/acta.model.php';

    if($_POST){
        $acta = new Acta();
        switch($_POST["accion"]){
            case "GENERARACTAS":
                echo json_encode($acta->generarActas());
            break;
            case "COMPROBACION":
                echo json_encode($acta->comprobacionGeneracion());
            break;
        }
    }
?>