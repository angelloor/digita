<?php

    require 'conexion.php';

    class Configuracion{
        public function listarConfiguracion(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select * from configuracion where id_configuracion = :idConfiguracion");
            $stmt->bindValue(":idConfiguracion", 1, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function guardar($totalActas,$numeroCandidatos,$totalPosiblesActas){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("UPDATE `configuracion`
                                    SET `TOTAL_ACTAS` = :totalActas,
                                    `NUMERO_CANDIDATOS` = :numeroCandidatos,
                                    `TOTAL_POSIBLES_ACTAS` = :totalPosiblesActas
                                    WHERE `ID_CONFIGURACION` = :idUsuario;");
            $stmt->bindValue(":totalActas",$totalActas, PDO::PARAM_INT);
            $stmt->bindValue(":numeroCandidatos",$numeroCandidatos, PDO::PARAM_INT);
            $stmt->bindValue(":totalPosiblesActas",$totalPosiblesActas, PDO::PARAM_INT);
            $stmt->bindValue(":idUsuario", 1 , PDO::PARAM_INT);
            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al guardar la información";
            }
        }

        public function restablecer(){
            $conexion = new Conexion();

            $stmt1 = $conexion->prepare("SELECT NOMBRE_PERSONA, CLAVE, NOMBRE_USUARIO, ROL_USUARIO FROM usuario WHERE ID_USUARIO =1;");
            $stmt1->execute();
            $results = $stmt1->fetch(PDO::FETCH_ASSOC);
            $nombrePersona = $results['NOMBRE_PERSONA'];
            $clave = $results['CLAVE'];
            $nombreUsuario = $results['NOMBRE_USUARIO'];
            $rolUsuario = $results['ROL_USUARIO'];

            $stmt2 = $conexion->prepare("SET FOREIGN_KEY_CHECKS=0;");
            $stmt2->execute();
            $stmt4 = $conexion->prepare("truncate table sesion");
            $stmt4->execute();
            $stmt5 = $conexion->prepare("truncate table usuario_error");
            $stmt5->execute();
            $stmt6 = $conexion->prepare("truncate table acta");
            $stmt6->execute();
            $stmt7 = $conexion->prepare("truncate table acta_img_voto");
            $stmt7->execute();
            $stmt8 = $conexion->prepare("truncate table usuario");
            $stmt8->execute();
            $stmt9 = $conexion->prepare("truncate table configuracion");
            $stmt9->execute();
            $stmt10 = $conexion->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt10->execute();
            
            $stmt11 = $conexion->prepare("INSERT INTO `usuario`
                                (`NOMBRE_PERSONA`,
                                `NOMBRE_USUARIO`,
                                `CLAVE`,
                                `ROL_USUARIO`)
                    VALUES (:NombrePersona,
                            :nombreUsuario,
                            :clave,
                            :rolUsuario);");

            $stmt11->bindValue(":NombrePersona", $nombrePersona, PDO::PARAM_STR);
            $stmt11->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
            $stmt11->bindValue(":clave", $clave, PDO::PARAM_STR);
            $stmt11->bindValue(":rolUsuario", $rolUsuario, PDO::PARAM_STR);
            $stmt11->execute();

            $stmt12 = $conexion->prepare("INSERT INTO `configuracion`
                                (`TOTAL_ACTAS`,
                                `NUMERO_CANDIDATOS`,
                                `TOTAL_POSIBLES_ACTAS`,
                                `ESTADO_GENERACION`)
                    VALUES (:totalActas,
                            :numeroCandidatos,
                            :totalPosiblesActas,
                            :estadoGeneracion);");
            $stmt12->bindValue(":totalActas", 20, PDO::PARAM_INT);
            $stmt12->bindValue(":numeroCandidatos", 10, PDO::PARAM_INT);
            $stmt12->bindValue(":totalPosiblesActas", 50, PDO::PARAM_INT);
            $stmt12->bindValue(":estadoGeneracion", 0, PDO::PARAM_INT);

            if($stmt12->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al restablecer el sistema";
            }
        }
    }
?>