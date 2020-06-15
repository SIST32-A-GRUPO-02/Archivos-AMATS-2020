<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
	$conn = new baseD();
    $consulta_cursos= $conn->busqueda("curso");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'Reporte De Cursos',0,0,'C');
	$pdf->Ln(30);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(60,6,'Nombre',1,0,'C',1);
    $pdf->Cell(60,6,'Identificador',1,0,'C',1);
    $pdf->Cell(60,6,'Responsable',1,1,'C',1);
   
	$pdf->SetFont('Arial','',10);
	
	foreach ($consulta_cursos as $datos) {
		$pdf->Cell(60,6,$datos['nombreCurso'],1,0,'C');
        $pdf->Cell(60,6,$datos['identificador'],1,0,'C');
        $pdf->Cell(60,6,$datos['responsable'],1,1,'C');
    }
    
	$pdf->Output();
?>
