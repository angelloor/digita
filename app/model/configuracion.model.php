<?php

    require 'conexion.php';

    class Configuracion{
        public function listarConfiguracion(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select * from configuracion where id_configuracion = :idconfiguracion");
            $stmt->bindValue(":idconfiguracion", 1, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function guardar($totalActas,$numeroCandidatos,$totalPosiblesActas){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("update `configuracion`
                                    set `total_actas` = :totalactas,
                                    `numero_candidatos` = :numerocandidatos,
                                    `total_posibles_actas` = :totalposiblesactas
                                    where `id_configuracion` = :idusuario;");
            $stmt->bindValue(":totalactas",$totalActas, PDO::PARAM_INT);
            $stmt->bindValue(":numerocandidatos",$numeroCandidatos, PDO::PARAM_INT);
            $stmt->bindValue(":totalposiblesactas",$totalPosiblesActas, PDO::PARAM_INT);
            $stmt->bindValue(":idusuario", 1 , PDO::PARAM_INT);
            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al guardar la información";
            }
        }

        public function restablecer(){
            $conexion = new Conexion();

            $stmt1 = $conexion->prepare("select nombre_persona, clave, nombre_usuario, rol_usuario from usuario where id_usuario =1;");
            $stmt1->execute();
            $results = $stmt1->fetch(PDO::FETCH_ASSOC);
            $nombrePersona = $results['nombre_persona'];
            $clave = $results['clave'];
            $nombreUsuario = $results['nombre_usuario'];
            $rolUsuario = $results['rol_usuario'];

            $stmt2 = $conexion->prepare("set foreign_key_checks=0;");
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
            $stmt10 = $conexion->prepare("set foreign_key_checks=1");
            $stmt10->execute();
            
            $stmt11 = $conexion->prepare("insert into `usuario`
                                (`nombre_persona`,
                                `nombre_usuario`,
                                `clave`,
                                `rol_usuario`)
                    values (:nombrepersona,
                            :nombreusuario,
                            :clave,
                            :rolusuario);");

            $stmt11->bindValue(":nombrepersona", $nombrePersona, PDO::PARAM_STR);
            $stmt11->bindValue(":nombreusuario", $nombreUsuario, PDO::PARAM_STR);
            $stmt11->bindValue(":clave", $clave, PDO::PARAM_STR);
            $stmt11->bindValue(":rolusuario", $rolUsuario, PDO::PARAM_STR);
            $stmt11->execute();

            $stmt12 = $conexion->prepare("insert into `configuracion`
                                (`total_actas`,
                                `numero_candidatos`,
                                `total_posibles_actas`,
                                `estado_generacion`)
                    values (:totalactas,
                            :numerocandidatos,
                            :totalposiblesactas,
                            :estadogeneracion);");
            $stmt12->bindValue(":totalactas", 20, PDO::PARAM_INT);
            $stmt12->bindValue(":numerocandidatos", 10, PDO::PARAM_INT);
            $stmt12->bindValue(":totalposiblesactas", 50, PDO::PARAM_INT);
            $stmt12->bindValue(":estadogeneracion", 0, PDO::PARAM_INT);

            if($stmt12->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al restablecer el sistema";
            }
        }
    }
?>