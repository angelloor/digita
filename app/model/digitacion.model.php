<?php

    require 'conexion.php';
    setlocale(LC_ALL, 'es_EC');

    class digitacion{
        public function iniciar($idUsuario,$totalActas){
            $conexion = new Conexion();

            $fecha = getdate();
            $hora = $fecha['hours'];
            $minuto = $fecha['minutes'];
            $segundo = $fecha['seconds'];
            $horaInicio = $hora.":".$minuto.":".$segundo;
            
            $stmt = $conexion->prepare("select max(id_sesion) ultimo from sesion;");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $ultimo = $results['ultimo'];

            $actual = $ultimo + 1;

            $dia=date("d");
            $mes_inicial=date("m");
            $año=date("Y");

            if ($mes_inicial < 10 ) {
                $mes_inicial = "0".$mes_inicial;
            }
            
            $fechaInicio = $año."-".$mes_inicial."-".$dia." ".$horaInicio;

            $stmt = $conexion->prepare("insert into `sesion` (`id_sesion`,`hora_inicio`,`usuario_id`, `fecha_sesion`,`total_actas`) values (:actual, :horainicio, :idusuario, :fechasesion, :totalactas);");
            $stmt->bindValue(":actual",$actual, PDO::PARAM_INT);
            $stmt->bindValue(":horainicio",$horaInicio, PDO::PARAM_STR);
            $stmt->bindValue(":idusuario",$idUsuario, PDO::PARAM_INT);
            $stmt->bindValue(":fechasesion",$fechaInicio, PDO::PARAM_STR);
            $stmt->bindValue(":totalactas",$totalActas, PDO::PARAM_INT);
            $stmt->execute();
            
            return $actual;
          
        }

        public function parametros(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select total_actas, numero_candidatos from configuracion where id_configuracion = 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        
        public function nuevo(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select total_posibles_actas from configuracion;");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalPosiblesActas = $results['total_posibles_actas'];

            // numero de acta
            $acta = rand(1,$totalPosiblesActas);

            $stmt = $conexion->prepare("select img_voto_id, acta_id from acta_img_voto where acta_id = :idacta");
            $stmt->bindValue(":idacta", $acta , PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function finalizar($idSesion){
            $conexion = new Conexion();

            $stmt = $conexion->prepare("select hora_inicio from sesion where id_sesion = :idsesion");
            $stmt->bindValue(":idsesion",$idSesion, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $horaInicio = $results['hora_inicio'];

            $fecha = getdate();
            $hora = $fecha['hours'];
            $minuto = $fecha['minutes'];
            $segundo = $fecha['seconds'];
            $horaFinal = $hora.":".$minuto.":".$segundo;

            $fechaUno=new DateTime($horaInicio);
            $fechaDos=new DateTime($horaFinal);
            
            $dateInterval = $fechaUno->diff($fechaDos);

            $stmt = $conexion->prepare("update `sesion` set `hora_final`= :horafinal ,`tiempo_total`= :tiempototal where `id_sesion` = :idsesion");
            $stmt->bindValue(":horafinal",$horaFinal, PDO::PARAM_STR);
            $stmt->bindValue(":tiempototal",$dateInterval->format('%H:%i:%s'), PDO::PARAM_STR);
            $stmt->bindValue(":idsesion",$idSesion, PDO::PARAM_INT);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al guardar la información";
            }
        }

        public function guardar($idUsuario,$idSesion,$numActa,$errores){
            $conexion = new Conexion();
            
            if ($errores>=1) {
                $stmt = $conexion->prepare("insert into `usuario_error` (`usuario_id`,`sesion_id`,`acta_id`,`cantidad`) 
                                        values (:idusuario,:idsesion,:numacta,:errores);");
                $stmt->bindValue(":idusuario",$idUsuario, PDO::PARAM_INT);
                $stmt->bindValue(":idsesion",$idSesion, PDO::PARAM_INT);
                $stmt->bindValue(":numacta",$numActa, PDO::PARAM_INT);
                $stmt->bindValue(":errores",$errores, PDO::PARAM_INT);
                if($stmt->execute()){
                    return "OK";
                }else{
                    return "Error: se ha generado un error al guardar la información";
                }
            }else{
                return "OK";
            }
            
        }

        public function verificarActas(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select estado_generacion from configuracion where id_configuracion = 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>