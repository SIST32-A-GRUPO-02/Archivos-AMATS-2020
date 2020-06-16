<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
	$conn = new baseD();
    $resultado= $conn->busquedaFree("SELECT
	`convocatoria`.`idConvocatoria`,
	`convocatoria`.`nombreConvocatoria`,
	`convocatoria`.`fechaInicio`,
	`convocatoria`.`fechaFin`,
	`convocatoria`.`identificador`,
	`convocatoria`.`responsable`,
	`convocatoria`.`estado`,
	`sede`.`departamento`
FROM
`dawproyecto`.`convocatoria`
INNER JOIN `dawproyecto`.`sede`
ON (
`convocatoria`.`idSede` = `sede`.`idSede`)");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'Reportes de convocatorias',0,0,'C');
	$pdf->Ln(30);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(47,6,'Nombre',1,0,'C',1);
	$pdf->Cell(36,6,'Fecha de incio',1,0,'C',1);
	$pdf->Cell(36,6,'Fecha de fin',1,0,'C',1);
	$pdf->Cell(36,6,'Responsable',1,0,'C',1);
    $pdf->Cell(25,6,'Sede',1,1,'C',1);
   
    $pdf->SetFont('Arial','',10);
    if($resultado!=true){
		$pdf->Cell(180,6,'No hay resultados',1,1,'C',0);
	}else{

		
			
	//Datos
	foreach($resultado as $datos){
		$pdf->Cell(47,6,$datos['nombreConvocatoria'],1,0,'c',0);
		$pdf->Cell(36,6,$datos['fechaInicio'],1,0,'c',0);
		$pdf->Cell(36,6,$datos['fechaFin'],1,0,'c',0);
		$pdf->Cell(36,6,$datos['responsable'],1,0,'c',0);
		$pdf->Cell(25,6,$datos['departamento'],1,1,'c',0);
	}
}
    $pdf->Output();
    ?>
    