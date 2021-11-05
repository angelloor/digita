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
            
            $stmt = $conexion->prepare("SELECT MAX(id_sesion) ultimo FROM sesion;");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $ultimo = $results['ultimo'];
            
            $actual = $ultimo + 1;

            $stmt = $conexion->prepare("INSERT INTO `sesion` (`ID_SESION`,`HORA_INICIO`,`USUARIO_ID`, `TOTAL_ACTAS`) VALUES (:actual, :horaInicio, :idUsuario, :totalActas);");
            $stmt->bindValue(":actual",$actual, PDO::PARAM_INT);
            $stmt->bindValue(":horaInicio",$horaInicio, PDO::PARAM_STR);
            $stmt->bindValue(":idUsuario",$idUsuario, PDO::PARAM_INT);
            $stmt->bindValue(":totalActas",$totalActas, PDO::PARAM_INT);
            $stmt->execute();

            return $actual;
          
        }

        public function parametros(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("SELECT TOTAL_ACTAS, NUMERO_CANDIDATOS FROM configuracion WHERE ID_CONFIGURACION = 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        
        public function nuevo(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select TOTAL_POSIBLES_ACTAS from configuracion;");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalPosiblesActas = $results['TOTAL_POSIBLES_ACTAS'];

            // numero de acta
            $acta = rand(1,$totalPosiblesActas);

            $stmt = $conexion->prepare("select IMG_VOTO_ID, ACTA_ID from acta_img_voto where ACTA_ID = :idActa");
            $stmt->bindValue(":idActa", $acta , PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function finalizar($idSesion){
            $conexion = new Conexion();

            $stmt = $conexion->prepare("select HORA_INICIO from sesion where id_sesion = :idSesion");
            $stmt->bindValue(":idSesion",$idSesion, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $horaInicio = $results['HORA_INICIO'];

            $fecha = getdate();
            $hora = $fecha['hours'];
            $minuto = $fecha['minutes'];
            $segundo = $fecha['seconds'];
            $horaFinal = $hora.":".$minuto.":".$segundo;

            $fechaUno=new DateTime($horaInicio);
            $fechaDos=new DateTime($horaFinal);
            
            $dateInterval = $fechaUno->diff($fechaDos);

            $stmt = $conexion->prepare("UPDATE `sesion` SET `HORA_FINAL`= :horaFinal ,`TIEMPO_TOTAL`= :tiempoTotal WHERE `ID_SESION` = :idSesion");
            $stmt->bindValue(":horaFinal",$horaFinal, PDO::PARAM_STR);
            $stmt->bindValue(":tiempoTotal",$dateInterval->format('%H:%i:%s'), PDO::PARAM_STR);
            $stmt->bindValue(":idSesion",$idSesion, PDO::PARAM_INT);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al guardar la información";
            }
        }

        public function guardar($idUsuario,$idSesion,$numActa,$errores){
            $conexion = new Conexion();
            
            if ($errores>=1) {
                $stmt = $conexion->prepare("INSERT INTO `usuario_error` (`USUARIO_ID`,`SESION_ID`,`ACTA_ID`,`CANTIDAD`) 
                                        VALUES (:idUsuario,:idSesion,:numActa,:errores);");
                $stmt->bindValue(":idUsuario",$idUsuario, PDO::PARAM_INT);
                $stmt->bindValue(":idSesion",$idSesion, PDO::PARAM_INT);
                $stmt->bindValue(":numActa",$numActa, PDO::PARAM_INT);
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