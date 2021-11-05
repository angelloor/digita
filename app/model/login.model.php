<?php
    require 'conexion.php';
    session_start();
    class Login{
        public function consultarUsuario($usuario, $clave){

            $conexion =  new Conexion();

            $stmt = $conexion->prepare("SELECT COUNT(*) FROM usuario WHERE NOMBRE_USUARIO = :usuario");
            $stmt->bindValue(":usuario",$usuario,PDO::PARAM_STR);
            $stmt->execute();
            $usuarioExiste = $stmt->fetch(PDO::FETCH_ASSOC);

            if($usuarioExiste['COUNT(*)'] == 0 ){
                return "El usuario no existe";
            }else{
                $stmt = $conexion->prepare("select id_usuario, nombre_persona, nombre_usuario, clave, rol_usuario from usuario where nombre_usuario = :usuario");
                $stmt->bindValue(":usuario",$usuario,PDO::PARAM_STR); 
                $stmt->execute();
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
                if($datos['clave'] == $clave){
                    $_SESSION['nombre_persona'] = $datos['nombre_persona'];
                    $_SESSION['rol_usuario'] = $datos['rol_usuario'];
                    $_SESSION['id_usuario'] = $datos['id_usuario'];
                    return "OK";
                }else{
                    return "Contraseña incorrecta";
                }
            }
        }
    }

?>