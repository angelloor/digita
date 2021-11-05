<?php

    require 'conexion.php';

    class Acta{

        public function generarActas(){
            $conexion = new Conexion();
            
            $stmt = $conexion->prepare("select total_posibles_actas ,numero_candidatos from configuracion where id_configuracion = 1;");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $numeroActas = $results['total_posibles_actas'];
            $numeroCandidatos = $results['numero_candidatos'];

            for ($i=1; $i<=$numeroActas ; $i++) { 
                $tv=0;
                $stmt = $conexion->prepare("insert into acta (total_votos) values(0)");
                $stmt->execute();

                for ($x=1; $x<=$numeroCandidatos+2 ; $x++) { 
                    $voto = rand(1,299);
                    $stmt = $conexion->prepare("insert into acta_img_voto (acta_id, img_voto_id) values($i,$voto)");
                    if(!($stmt->execute())){
                        print $stmt->errorCode();
                    }
                    $tv = $tv + $voto;
                }
                $stmt = $conexion->prepare("update `acta` set `total_votos` = $tv where `id_acta` = $i");
                $stmt->execute();
            }
            $stmt = $conexion->prepare("update `configuracion` set `estado_generacion` = 1 where `id_configuracion` = 1;");
            $stmt->execute();

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al guardar la información";
            }
        }

        public function comprobacionGeneracion(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select estado_generacion from `configuracion` where id_configuracion = 1;");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $estado = $results['estado_generacion'];
            if($estado == 1){
                return "OK";
            }else{
                return "NOT";
            }
        }
    }
?>