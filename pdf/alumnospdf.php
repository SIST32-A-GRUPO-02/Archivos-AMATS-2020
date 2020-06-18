<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
    $conn = new baseD();
    //consulta a utilizar en el foreach para acceder a la tabla
    $consulta_alumnos = $conn->busqueda("participante");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'Reporte De Alumnos',0,0,'C');
    $pdf->Ln(30);
    //inicio de tabla
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,6,'Nombre',1,0,'C',1);
    $pdf->Cell(40,6,'Apellido',1,0,'C',1);
    $pdf->Cell(25,6,'Fecha',1,0,'C',1);
    $pdf->Cell(30,6,'DUI',1,0,'C',1);
    $pdf->Cell(60,6,'Direccion',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	//datos a mostrar de la tabla
	foreach ($consulta_alumnos as $datos) {
		$pdf->Cell(40,6,$datos['nombres'],1,0,'C');
        $pdf->Cell(40,6,$datos['apellidos'],1,0,'C');
        $pdf->Cell(25,6,$datos['fechaNacimiento'],1,0,'C');
		$pdf->Cell(30,6,$datos['dui'],1,0,'C');
		$pdf->Cell(60,6,$datos['direccion'],1,1,'C');
    }
    
	$pdf->Output();
?>
