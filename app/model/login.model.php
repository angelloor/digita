<?php
    require 'conexion.php';
    session_start();
    class Login{
        public function consultarUsuario($usuario, $clave){

            $conexion =  new Conexion();

            $stmt = $conexion->prepare("select count(*) from usuario where nombre_usuario = :usuario");
            $stmt->bindValue(":usuario",$usuario,PDO::PARAM_STR);
            $stmt->execute();
            $usuarioExiste = $stmt->fetch(PDO::FETCH_ASSOC);

            if($usuarioExiste['count(*)'] == 0 ){
                return "El usuario no existe";
            }else{
                $stmt = $conexion->prepare("select id_usuario, nombre_persona, nombre_usuario, clave, rol_usuario from usuario where nombre_usuario = :usuario");
                $stmt->bindValue(":usuario",$usuario,PDO::PARAM_STR); 
                $stmt->execute();
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
                if($datos['clave'] == $clave){
                    return $datos;
                }else{
                    return "Contraseña incorrecta";
                }
            }
        }
    }

?>