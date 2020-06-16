<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
    $conn = new baseD();
    //consulta a utilizar en el foreach para acceder a la tabla
    $consulta = $conn->busquedaFree("SELECT idnota,nota,participante.nombres,participante.apellidos,nombreEvaluacion,nombreModulo FROM nota 
    INNER JOIN participantecurso ON nota.idParticipanteCurso = participantecurso.idParticipanteCurso 
    INNER JOIN participante ON participantecurso.idParticipante = participante.idParticipante
  INNER JOIN evaluaciones ON nota.idEvaluaciones = evaluaciones.idEvaluaciones
  INNER JOIN modulo ON nota.idModulo = modulo.idModulo;");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'Reporte De Notas',0,0,'C');
    $pdf->Ln(30);
    
    //inicio de tabla
		$pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(45,6,'NOMBRES',1,0,'C',1);
        $pdf->Cell(45,6,'APELLIDOS',1,0,'C',1);
		$pdf->Cell(40,6,'MODULO',1,0,'C',1);
		$pdf->Cell(40,6,'EVALUACION',1,0,'C',1);
        $pdf->Cell(25,6,'NOTA',1,1,'C',1);
        
        $pdf->SetFont('Arial','',10);
        //datos a mostrar de la tabla
        if($consulta==true){
           foreach($consulta as $datos){
            $pdf->Cell(45,6,$datos['nombres'],1,0,'C');
            $pdf->Cell(45,6,$datos['apellidos'],1,0,'C');
            $pdf->Cell(40,6,$datos['nombreModulo'],1,0,'C');
            $pdf->Cell(40,6,$datos['nombreEvaluacion'],1,0,'C');
            $pdf->Cell(25,6,$datos['nota'],1,1,'C');
           }
        }else{
            $pdf->Cell(180,6,'No hay datos',1,1,'C');
        }

        $pdf->Output();
        ?>