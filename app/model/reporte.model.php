<?php
    require 'conexion.php';
    class Reporte{
        public function visualizar($fechaInicio,$fechaFinal){
            $conexion =  new Conexion();
            $fia = explode("T",$fechaInicio);
            $fi = $fia[0]." ".$fia[1];
            $ffa = explode("T",$fechaFinal);
            $ff = $ffa[0]." ".$ffa[1];
            
            $stmt = $conexion->prepare("select s.id_sesion, s.hora_inicio, s.hora_final, s.tiempo_total, u.nombre_usuario, s.fecha_sesion, s.total_actas, SUM(ue.cantidad) as errores, SEC_TO_TIME(FLOOR(TIME_TO_SEC(s.TIEMPO_TOTAL) / s.TOTAL_ACTAS)) as tpa from sesion s inner join usuario u on s.usuario_id = u.id_usuario inner join usuario_error ue on s.id_sesion = ue.sesion_id where s.fecha_sesion between :fechainicio and :fechafinal GROUP BY s.id_sesion;");
            $stmt->bindValue(":fechainicio",$fi, PDO::PARAM_STR);
            $stmt->bindValue(":fechafinal",$ff, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function consultaSesion($fechaInicio,$fechaFinal){
            $conexion =  new Conexion();

            $stmt = $conexion->prepare("select count(*) from sesion s inner join usuario u on s.usuario_id = u.id_usuario where s.fecha_sesion between :fechainicio and :fechafinal;");
            $stmt->bindValue(":fechainicio",$fechaInicio, PDO::PARAM_STR);
            $stmt->bindValue(":fechafinal",$fechaFinal, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalSesiones = $results['count(*)'];

            return $totalSesiones;
        }

        public function consultarDatos($fechaInicio,$fechaFinal){
            $conexion =  new Conexion();

            $stmt = $conexion->prepare("select s.id_sesion, s.hora_inicio, s.hora_final, s.tiempo_total, u.nombre_usuario, s.fecha_sesion, s.total_actas from sesion s inner join usuario u on s.usuario_id = u.id_usuario where s.fecha_sesion between :fechainicio and :fechafinal order by s.id_sesion   ;");
            $stmt->bindValue(":fechainicio",$fechaInicio, PDO::PARAM_STR);
            $stmt->bindValue(":fechafinal",$fechaFinal, PDO::PARAM_STR);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $datos;
        }

        public function errores($idSesion){
            $conexion =  new Conexion();

            $stmt = $conexion->prepare("select acta_id, cantidad from usuario_error where sesion_id = :idSesion");
            $stmt->bindValue(":idSesion",$idSesion, PDO::PARAM_INT);
            $stmt->execute();
            $errores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $errores;
        }
    }
?>