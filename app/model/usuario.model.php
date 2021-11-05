<?php

    require 'conexion.php';

    class Usuario{

        public function ConsultarTodo(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select * from usuario");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function ConsultarPorId($idUsuario){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select * from usuario where id_usuario = :idUsuario");
            $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function ConsultarPorIdRow($idUsuario){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select * from usuario where nombre_persona like :patron");
            $stmt->bindValue(":patron", "%".$idUsuario."%", PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function Guardar($NombrePersona, $nombreUsuario, $clave, $rolUsuario){
            $conexion = new Conexion();
            
            $stmt = $conexion->prepare("select count(*) from usuario where nombre_usuario = :nombreUsuario;");
            $stmt->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $existeUsuario = $results['count(*)'];

            if($existeUsuario >= 1 ){
                return "el nombre de usuario ya existe";
            }

            if($rolUsuario == "ADMINISTRADOR") {
                return "Solo pueda haber un Administrador";
            }else{
                            $stmt = $conexion->prepare("insert into `usuario`
                            (`nombre_persona`,
                            `nombre_usuario`,
                            `clave`,
                            `rol_usuario`)
                VALUES (:NombrePersona,
                        :nombreUsuario,
                        :clave,
                        :rolUsuario);");
                $stmt->bindValue(":NombrePersona", $NombrePersona, PDO::PARAM_STR);
                $stmt->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
                $stmt->bindValue(":clave", $clave, PDO::PARAM_STR);
                $stmt->bindValue(":rolUsuario", $rolUsuario, PDO::PARAM_STR);
                if($stmt->execute()){
                return "OK";
                }else{
                return "Error: se ha generado un error al guardar la información";
                }
                }
            }
            
        public function Modificar($idUsuario, $NombrePersona, $nombreUsuario, $clave, $rolUsuario){
            $conexion = new Conexion();

            $stmt = $conexion->prepare("select count(*) from usuario where nombre_usuario = :nombreUsuario;");
            $stmt->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $existeUsuario = $results['count(*)'];

            $stmt = $conexion->prepare("select nombre_usuario from usuario where id_usuario = :idUsuario;");
            $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $nombreUsuarioBD = $results['nombre_usuario'];

            if ($nombreUsuario == $nombreUsuarioBD) {
                if($idUsuario == 1){
                    $stmt = $conexion->prepare("UPDATE `usuario`
                                SET `NOMBRE_PERSONA` = :NombrePersona,
                                `NOMBRE_USUARIO` = :nombreUsuario,
                                `CLAVE` = :clave,
                                `ROL_USUARIO` = :rolUsuario
                                WHERE `ID_USUARIO` = :idUsuario;");
                    $stmt->bindValue(":NombrePersona", $NombrePersona, PDO::PARAM_STR);
                    $stmt->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
                    $stmt->bindValue(":clave", $clave, PDO::PARAM_STR);
                    $stmt->bindValue(":rolUsuario", $rolUsuario, PDO::PARAM_STR);
                    $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
                    if($stmt->execute()){
                    return "OK";
                    }else{
                    return "Error: se ha generado un error al modificar la información";
                    }
                }else{
                    if($rolUsuario == "ADMINISTRADOR") {
                        return "Solo pueda haber un Administrador";
                    }else{
                        $stmt = $conexion->prepare("UPDATE `usuario`
                                        SET `NOMBRE_PERSONA` = :NombrePersona,
                                        `NOMBRE_USUARIO` = :nombreUsuario,
                                        `CLAVE` = :clave,
                                        `ROL_USUARIO` = :rolUsuario
                                        WHERE `ID_USUARIO` = :idUsuario;");
                        $stmt->bindValue(":NombrePersona", $NombrePersona, PDO::PARAM_STR);
                        $stmt->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
                        $stmt->bindValue(":clave", $clave, PDO::PARAM_STR);
                        $stmt->bindValue(":rolUsuario", $rolUsuario, PDO::PARAM_STR);
                        $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
                        if($stmt->execute()){
                        return "OK";
                        }else{
                        return "Error: se ha generado un error al modificar la información";
                        }
                    }
                }
            }else{
                if($existeUsuario >= 1){
                    return "el nombre de usuario ya existe";
                }else{
                    if($idUsuario == 1){
                        $stmt = $conexion->prepare("UPDATE `usuario`
                                    SET `NOMBRE_PERSONA` = :NombrePersona,
                                    `NOMBRE_USUARIO` = :nombreUsuario,
                                    `CLAVE` = :clave,
                                    `ROL_USUARIO` = :rolUsuario
                                    WHERE `ID_USUARIO` = :idUsuario;");
                        $stmt->bindValue(":NombrePersona", $NombrePersona, PDO::PARAM_STR);
                        $stmt->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
                        $stmt->bindValue(":clave", $clave, PDO::PARAM_STR);
                        $stmt->bindValue(":rolUsuario", $rolUsuario, PDO::PARAM_STR);
                        $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
                        if($stmt->execute()){
                        return "OK";
                        }else{
                        return "Error: se ha generado un error al modificar la información";
                        }
                    }else{
                        if($rolUsuario == "ADMINISTRADOR") {
                            return "Solo pueda haber un Administrador";
                        }else{
                            $stmt = $conexion->prepare("UPDATE `usuario`
                                            SET `NOMBRE_PERSONA` = :NombrePersona,
                                            `NOMBRE_USUARIO` = :nombreUsuario,
                                            `CLAVE` = :clave,
                                            `ROL_USUARIO` = :rolUsuario
                                            WHERE `ID_USUARIO` = :idUsuario;");
                            $stmt->bindValue(":NombrePersona", $NombrePersona, PDO::PARAM_STR);
                            $stmt->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
                            $stmt->bindValue(":clave", $clave, PDO::PARAM_STR);
                            $stmt->bindValue(":rolUsuario", $rolUsuario, PDO::PARAM_STR);
                            $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
                            if($stmt->execute()){
                            return "OK";
                            }else{
                            return "Error: se ha generado un error al modificar la información";
                            }
                        }
                    }
                }

            }
        }

        public function Eliminar($idUsuario){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select count(*) from usuario");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalUsuarios = $results['count(*)'];
            $stmt = $conexion->prepare("select rol_usuario from usuario where id_usuario = :idUsuario");
            $stmt->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $existeRolUsuario = $results['rol_usuario'];
            if($totalUsuarios == 1){
                return "No puede eliminar todos los usuarios";
            }else {
                if($existeRolUsuario == "ADMINISTRADOR"){
                    return "No puede eliminar al Administrador";
                }else{
                    $stmtdel = $conexion->prepare("delete from usuario where id_usuario = :idUsuario");
                    $stmtdel->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
                    if($stmtdel->execute()){
                        return "OK";
                    }else{
                        return "Error: se ha generado un error al eliminar el registro";
                    }
                }
            }
        }

        public function borrarUsuarios(){
            $conexion = new Conexion();
            $stmt1 = $conexion->prepare("select nombre_persona, clave, nombre_usuario, rol_usuario from usuario where id_usuario = 1;");
            $stmt1->execute();
            $results = $stmt1->fetch(PDO::FETCH_ASSOC);
            $nombrePersona = $results['nombre_persona'];
            $clave = $results['clave'];
            $nombreUsuario = $results['nombre_usuario'];
            $rolUsuario = $results['rol_usuario'];
            $stmt2 = $conexion->prepare("SET FOREIGN_KEY_CHECKS=0");
            $stmt2->execute();
            $stmt3 = $conexion->prepare("truncate table usuario");
            $stmt3->execute();
            $stmt4 = $conexion->prepare("SET FOREIGN_KEY_CHECKS=1");
            $stmt4->execute();
            $stmt5 = $conexion->prepare("INSERT INTO `usuario`
                            (`NOMBRE_PERSONA`,
                            `NOMBRE_USUARIO`,
                            `CLAVE`,
                            `ROL_USUARIO`)
                VALUES (:NombrePersona,
                        :nombreUsuario,
                        :clave,
                        :rolUsuario);");
            $stmt5->bindValue(":NombrePersona", $nombrePersona, PDO::PARAM_STR);
            $stmt5->bindValue(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
            $stmt5->bindValue(":clave", $clave, PDO::PARAM_STR);
            $stmt5->bindValue(":rolUsuario", $rolUsuario, PDO::PARAM_STR);
            if($stmt5->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al eliminar el registro";
            }
        }
    }
?>