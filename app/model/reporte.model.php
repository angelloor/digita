<?php
    require 'conexion.php';
    class Reporte{
        public function visualizar($fechaInicio,$fechaFinal){
            $conexion =  new Conexion();
            $fia = explode("T",$fechaInicio);
            $fi = $fia[0]." ".$fia[1];
            $ffa = explode("T",$fechaFinal);
            $ff = $ffa[0]." ".$ffa[1];
            $stmt = $conexion->prepare("SELECT s.id_sesion, s.hora_inicio, s.hora_final, s.tiempo_total, u.nombre_usuario, s.fecha_sesion FROM sesion s INNER JOIN usuario u ON s.usuario_id = u.id_usuario WHERE s.fecha_sesion BETWEEN :fechaInicio AND :fechaFinal;");
            $stmt->bindValue(":fechaInicio",$fi, PDO::PARAM_STR);
            $stmt->bindValue(":fechaFinal",$ff, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        public function consultar(){
            $conexion =  new Conexion();
            $stmt = $conexion->prepare("SELECT s.id_sesion, s.hora_inicio, s.hora_final, s.tiempo_total, u.nombre_usuario, s.fecha_sesion FROM sesion s INNER JOIN usuario u ON s.usuario_id = u.id_usuario;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    }
?>