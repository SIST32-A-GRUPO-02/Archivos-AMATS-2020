<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
    $conn = new baseD();
    //consulta a utilizar en el foreach para acceder a la tabla
    $consulta = $conn->busquedaFree("SELECT
    `especialidad`.`idEspecialidad`,
    `especialidad`.`nombreEspecialidad`
    FROM  `dawproyecto`.`especialidad`;");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'REPORTE DE ESPECIALIDAD',0,0,'C');
    $pdf->Ln(30);
    
    //inicio de tabla
		$pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(100,6,'ESPEACIDADES',1,1,'C',1);

        if($consulta!=true){
            
        }else{
            foreach($consulta as $datos){
            
                $pdf->Cell(100,6, $datos['nombreEspecialidad'],1,0,'C',0);
            }
        }
        $pdf->Output();
        ?>