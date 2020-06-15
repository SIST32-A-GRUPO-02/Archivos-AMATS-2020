<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
    $conn = new baseD();
    //consulta a utilizar en el foreach para acceder a la tabla
    $consulta = $conn->busquedaFree("SELECT
    `evaluaciones`.`idEvaluaciones`,
     `evaluaciones`.`nombreEvaluacion`,
     `evaluaciones`.`porcentaje`,
     `modulo`.`idModulo`
     FROM
     `dawproyecto`.`evaluaciones`
     INNER JOIN `dawproyecto`.`modulo`
       ON (
         `evaluaciones`.`idModulo` = `modulo`.`idModulo`
       ) 
       ;");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'Reporte De Evaluaciones',0,0,'C');
    $pdf->Ln(30);
    //inicio de tabla
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(50,6,'NOMBRE',1,0,'C',1);
    $pdf->Cell(50,6,'PORCENTAJE',1,0,'C',1);
    $pdf->Cell(50,6,'MODULO',1,1,'C',1);
    $pdf->SetFont('Arial','',10);
    //datos
    if($consulta==true){
        foreach($consulta as $datos){
            $pdf->Cell(50,6,$datos['nombreEvaluacion'],1,0,'C');
            $pdf->Cell(50,6,$datos['porcentaje'],1,0,'C');
            $pdf->Cell(50,6,$datos['idModulo'],1,1,'C');
        }
    }else{
        $pdf->Cell(160,6,'No hay datos',1,1,'C',1);
    }

    $pdf->Output();
    ?>