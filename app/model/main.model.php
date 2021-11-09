<?php

    require 'conexion.php';
    class Main{
        public function traerConfiguracion(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select total_actas, numero_candidatos, estado_generacion from configuracion where id_configuracion = 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function traerUsuarios(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select count(*) from usuario;");
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalUsuarios = $datos['count(*)'];   
            return $totalUsuarios;
        }

        public function traerSesiones(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select count(*) from sesion;");
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalSesiones = $datos['count(*)'];    
            return $totalSesiones;
        }

        public function traerErrores($idUsuario){
            $totalErrores = 0;
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select cantidad from usuario_error where usuario_id = :idusuario");
            $stmt->bindValue(":idusuario",$idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datos as $row) {
                $totalErrores = $totalErrores + intval($row['cantidad']);
            }
            return $totalErrores;
        }

        public function traerMejorTiempo($idUsuario){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select tiempo_total from sesion where usuario_id = :idusuario order by tiempo_total asc limit 1;");
            $stmt->bindValue(":idusuario",$idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function tpa($idUsuario){
            $tpaf = "23:59:59";
            $conexion = new Conexion();
            $stmt = $conexion->prepare("select tiempo_total, total_actas from sesion where usuario_id = :idusuario");
            $stmt->bindValue(":idusuario",$idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($datos as $row) {
                $tpa = calculoTpa($row['tiempo_total'], $row['total_actas']);
                if ($tpa <= $tpaf) {
                    $tpaf = $tpa;
                }
            }
            if ($tpaf == "23:59:59") {
                $tpaf = "00:00:00";
            }
            return $tpaf;
        }

        
    }

    function calculoTpa($tiempoTotal,$totalActas){
        $tiempo = explode(":",$tiempoTotal);
        $hora = intval($tiempo[0]);
        $minutos = intval($tiempo[1]);
        $segundos =intval($tiempo[2]);
        $totalSegundos = 0;
        $sh = $hora*60*60;
        $sm = $minutos*60;
        $totalSegundos = $sh+$sm+$segundos;
        $tpas = $totalSegundos/$totalActas;
        $tpa = gmdate("H:i:s", $tpas);
        return $tpa;
    }
?>