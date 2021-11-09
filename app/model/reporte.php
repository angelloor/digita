<?php
    require('../fpdf/fpdf.php');
    $data = $_GET['data'];
    $datosDecode = json_decode($data);
    $accion = $_GET['accion'];
    
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
    
    if ($accion == "pdf") {
      $fechaInicio = $_GET['fechaInicio'];
      $fechaFinal = $_GET['fechaFinal'];

      $id_sesion = $datosDecode->{'datosFinal'}[0]->{'id_sesion'};
      $total_sesiones = count($datosDecode->{'datosFinal'});

      $dia=date("d");
      $mes_inicial=date("F");
      $año=date("Y");

      $mes = mes_format($mes_inicial);
      $fechaActual = $dia." de ".$mes." del ".$año;

      class PDF extends FPDF
      {
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

      //Horientacion Horizontal
      $pdf = new PDF('P','mm','A4');
      $pdf->AliasNbPages();
      $pdf->AddPage();
      $pdf->SetTextColor(44,62,80);
      $pdf->SetFont('Courier','B',12);
      $pdf->Cell(0,10,utf8_decode('EVALUACIÓN DE RENDIMIENTO DE LOS DIGITADORES'),0,1,'C');
      $pdf->Ln(3);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Courier','',12);
      $pdf->MultiCell(0,5,utf8_decode("Fecha: $fechaActual \nSesiones: $total_sesiones \nIntervalo de consulta: $fechaInicio - $fechaFinal"));
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

      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Courier','',10);
      foreach ($datosDecode->{'datosFinal'} as $row) {
        $idSesion = $row->{'id_sesion'};
        $tiempoTotal = $row->{'tiempo_total'};
        $pdf->Cell(20,10, $row->{'id_sesion'}, 0,0,'C',0);
        $pdf->Cell(45,10, $row->{'nombre_usuario'}, 0,0,'C',0);
        $pdf->Cell(20,10, $row->{'total_actas'}, 0,0,'C',0);
        $pdf->Cell(35,10, $row->{'hora_inicio'}, 0,0,'C',0);
        $pdf->Cell(35,10, $row->{'hora_final'}, 0,0,'C',0);
        $pdf->Cell(35,10, $row->{'tiempo_total'}, 0,1,'C',0);

        $pdf->SetTextColor(44,62,80);
        $pdf->SetFont('Courier','B',10);

        $pdf->Cell(20,10, "TPA", 0,0,'C',0);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Courier','',10);
        // //TIEMPO POR ACTA
    
        $pdf->Cell(45,10, calculoTpa($tiempoTotal,$row->{'total_actas'}), 0,0,'C',0);
        $pdf->SetTextColor(44,62,80);
        $pdf->SetFont('Courier','B',10);

        $pdf->Cell(55,10, "ERRORES =>", 0,0,'C',0);
        $pdf->Cell(35,10, "ACTA", 0,0,'C',0);
        $pdf->Cell(35,10, "CANTIDAD", 0,1,'C',0);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Courier','',10);
      
        //CANTIDAD DE ERRORES (FOR)
        $totalErrores = 0;
        foreach ($row->{'errores'} as $error) {
          $pdf->Cell(120,10, "", 0,0,'C',0);
          $pdf->Cell(35,10, $error->{'acta_id'}, 0,0,'C',0);
          $pdf->Cell(35,10, $error->{'cantidad'}, 0,1,'C',0);
          $totalErrores = $totalErrores + $error->{'cantidad'};
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
      
      $mostrar_columnas = false;
      $parseArray = (array) $datosDecode;

      foreach($parseArray as $row) {
        $array = (array) $row;
        if(!$mostrar_columnas) {
          echo implode("\t", array_keys($array)) . "\n";
          $mostrar_columnas = true;
        }
        echo implode("\t", array_values($array)) . "\n";
      }
    }
?>