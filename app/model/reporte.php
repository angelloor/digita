<?php
    require 'conexion.php';
    $conexion = new Conexion();

    $fechaInicio = $_GET['fechaInicio'];
    $fechaFinal = $_GET['fechaFinal'];
    $accion = $_GET['accion'];

    $fia = explode("T",$fechaInicio);
    $fi = $fia[0]." ".$fia[1];
    $fechaInicialReporte = $fia[0]." ".$fia[1];
    $ffa = explode("T",$fechaFinal);
    $ff = $ffa[0]." ".$ffa[1];
    $fechaFinalReporte = $ffa[0]." ".$ffa[1];
    
    $dia=date("d");
    $mes_inicial=date("F");
    $año=date("Y");
    function mes_format($mes_inicial){
        if ($mes_inicial == "January") $mes = "Enero";
        if ($mes_inicial == "February") $mes = "Febrero";
        if ($mes_inicial == "March") $mes = "Marzo";
        if ($mes_inicial == "April") $mes = "Abril";
        if ($mes_inicial == "May") $mes = "Mayo";
        if ($mes_inicial == "June") $mes = "Junio";
        if ($mes_inicial == "July") $mes = "Julio";
        if ($mes_inicial == "August") $mes = "Agosto";
        if ($mes_inicial == "September") $mes = "Setiembre";
        if ($mes_inicial == "October") $mes = "Octubre";
        if ($mes_inicial == "November") $mes = "Noviembre";
        if ($mes_inicial == "December") $mes = "Diciembre";
        return $mes;
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

    $mes = mes_format($mes_inicial);
    $fechaActual = $dia." de ".$mes." del ".$año;
    
    if ($accion == "pdf") {
        require('../fpdf/fpdf.php');
        class PDF extends FPDF
    {
        // Cabecera de página
        function Header()
        {
            $this->Image('../assets/img/logo.png',80,15,60);
            $this->SetFont('Courier','B',11);
            $this->Ln(20);
        }
        
        function parrafo($texto)
        {
            $txt = $texto;
            $this->SetFont('Courier','',12);
            $this->SetRightMargin(25);
            $this->SetLeftMargin(25);    
            $this->MultiCell(0,5,utf8_decode($txt)  );
            $this->SetFont('','I');
        }
    }
    //Total de sesiones
    $stmt = $conexion->prepare("SELECT count(*) FROM sesion s INNER JOIN usuario u ON s.usuario_id = u.id_usuario WHERE s.fecha_sesion BETWEEN :fechaInicio AND :fechaFinal;");
    $stmt->bindValue(":fechaInicio",$fi, PDO::PARAM_STR);
    $stmt->bindValue(":fechaFinal",$ff, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalSesiones = $results['count(*)'];

    // l Horientacion Horizontal
    $pdf = new PDF('P','mm','A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTextColor(44,62,80);
    $pdf->SetFont('Courier','B',12);
    $pdf->Cell(0,10,utf8_decode('EVALUACIÓN DE RENDIMIENTO DE LOS DIGITADORES'),0,1,'C');
    $pdf->Ln(3);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Courier','',12);
    $pdf->MultiCell(0,5,utf8_decode("Fecha: $dia de $mes del $año \nSesiones: $totalSesiones \nIntervalo de consulta: $fechaInicialReporte - $fechaFinalReporte")  );
    $pdf->SetTextColor(44,62,80);
    $pdf->SetFont('Courier','B',10);
    $pdf->Ln(3);
    
    //Cabecera del reporte
    $pdf->Cell(20,10, "ID SESION", 0,0,'C',0);
    $pdf->Cell(45,10, "USUARIO", 0,0,'C',0);
    $pdf->Cell(20,10, "ACTAS", 0,0,'C',0);
    $pdf->Cell(35,10, "HORA INICIO", 0,0,'C',0);
    $pdf->Cell(35,10, "HORA FINAL", 0,0,'C',0);
    $pdf->Cell(35,10, "TIEMPO TOTAL", 0,1,'C',0);

    $stmt = $conexion->prepare("SELECT s.id_sesion, s.hora_inicio, s.hora_final, s.tiempo_total, u.nombre_usuario, s.fecha_sesion, s.total_actas FROM sesion s INNER JOIN usuario u ON s.usuario_id = u.id_usuario WHERE s.fecha_sesion BETWEEN :fechaInicio AND :fechaFinal;");
    $stmt->bindValue(":fechaInicio",$fi, PDO::PARAM_STR);
    $stmt->bindValue(":fechaFinal",$ff, PDO::PARAM_STR);
    $stmt->execute();
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Courier','',10);
    foreach ($datos as $row) {
      $idSesion = $row['id_sesion'];
      $tiempoTotal = $row['tiempo_total'];
      $pdf->Cell(20,10, $row['id_sesion'], 0,0,'C',0);
      $pdf->Cell(45,10, $row['nombre_usuario'], 0,0,'C',0);
      $pdf->Cell(20,10, $row['total_actas'], 0,0,'C',0);
      $pdf->Cell(35,10, $row['hora_inicio'], 0,0,'C',0);
      $pdf->Cell(35,10, $row['hora_final'], 0,0,'C',0);
      $pdf->Cell(35,10, $row['tiempo_total'], 0,1,'C',0);

      $pdf->SetTextColor(44,62,80);
      $pdf->SetFont('Courier','B',10);

      $pdf->Cell(20,10, "TPA", 0,0,'C',0);

      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Courier','',10);
      //TIEMPO POR ACTA

      $stmt = $conexion->prepare("SELECT 	TOTAL_ACTAS FROM sesion WHERE ID_SESION = :idSesion");
      $stmt->bindValue(":idSesion",$idSesion, PDO::PARAM_INT);
      $stmt->execute();
      $results = $stmt->fetch(PDO::FETCH_ASSOC);
      $totalActas = $results['TOTAL_ACTAS'];

      $pdf->Cell(45,10, calculoTpa($tiempoTotal,$totalActas), 0,0,'C',0);
      $pdf->SetTextColor(44,62,80);
      $pdf->SetFont('Courier','B',10);
      
      $pdf->Cell(55,10, "ERRORES =>", 0,0,'C',0);
      $pdf->Cell(35,10, "ACTA", 0,0,'C',0);
      $pdf->Cell(35,10, "CANTIDAD", 0,1,'C',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Courier','',10);


      $stmt = $conexion->prepare("select acta_id, cantidad from usuario_error where sesion_id = :idSesion");
      $stmt->bindValue(":idSesion",$idSesion, PDO::PARAM_INT);
      $stmt->execute();
      $Errores = $stmt->fetchAll(PDO::FETCH_ASSOC);

      //CANTIDAD DE ERRORES (FOR)
      $totalErrores = 0;
      foreach ($Errores as $rowErrores) {
        $pdf->Cell(120,10, "", 0,0,'C',0);
        $pdf->Cell(35,10, $rowErrores['acta_id'], 0,0,'C',0);
        $pdf->Cell(35,10, $rowErrores['cantidad'], 0,1,'C',0);
        $totalErrores = $totalErrores + $rowErrores['cantidad'];
      }
      //PIE DE REGISTRO

      $pdf->SetTextColor(44,62,80);
      $pdf->SetFont('Courier','B',10);
      $pdf->Cell(120,10, "", 0,0,'C',0);
      $pdf->Cell(35,10, "TOTAL ERRORES", 0,0,'C',0);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Courier','',10);
      $pdf->Cell(35,10, $totalErrores, 0,1,'C',0);



      $pdf->Ln(15);
      
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Courier','',10);

  }

    $pdf->Output(); 
    }else{
        header('Content-type:application/xls');
        header('Content-Disposition: attachment; filename=reporteSesion.xls');

        $stmt = $conexion->prepare("SELECT s.id_sesion, s.hora_inicio, s.hora_final, s.tiempo_total, u.nombre_usuario, s.fecha_sesion FROM sesion s INNER JOIN usuario u ON s.usuario_id = u.id_usuario WHERE s.fecha_sesion BETWEEN :fechaInicio AND :fechaFinal;");
        $stmt->bindValue(":fechaInicio",$fi, PDO::PARAM_STR);
        $stmt->bindValue(":fechaFinal",$ff, PDO::PARAM_STR);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $mostrar_columnas = false;

        foreach($datos as $row) {
          if(!$mostrar_columnas) {
            echo implode("\t", array_keys($row)) . "\n";
            $mostrar_columnas = true;
          }
          echo implode("\t", array_values($row)) . "\n";
        }
    }
?>