<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
    $conn = new baseD();
    //consulta a utilizar en el foreach para acceder a la tabla
    $consulta = $conn->busquedaFree("SELECT
    `modulo`.`idModulo`,
     `modulo`.`nombreModulo`,
     `modulo`.`descripcionModulo`,
     `modulo`.`horasModulo`,
     `docente`.`nombres`,
     `curso`.`nombreCurso`
     FROM
     `dawproyecto`.`modulo`
     INNER JOIN `dawproyecto`.`docente`
       ON (
         `modulo`.`idDocente` = `docente`.`idDocente`
       ) 
       INNER JOIN `dawproyecto`.`curso`
       ON (
         `modulo`.`idCurso` = `curso`.`idCurso`
       ) 
       ;");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'REPORTE DE MODULOS',0,0,'C');
    $pdf->Ln(30);
    
    //inicio de tabla
		$pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(45,6,'NOMBRE',1,0,'C',1);
        $pdf->Cell(50,6,'DESCRIPCION',1,0,'C',1);
		$pdf->Cell(30,6,'HORAS',1,0,'C',1);
		$pdf->Cell(40,6,'DOCENTES',1,0,'C',1);
        $pdf->Cell(25,6,'CURSOS',1,1,'C',1);
        
        $pdf->SetFont('Arial','',10);
        //datos a mostrar de la tabla
        if ($consulta!=true) {
            $pdf->Cell(190,6,'No hay datos',1,1,'C',0);
        }else{
            foreach($consulta as $datos){
                $pdf->Cell(45,6,$datos['nombreModulo'],1,0,'C',0);
                $pdf->Cell(50,6,$datos['descripcionModulo'],1,0,'C',0);
                $pdf->Cell(30,6,$datos['horasModulo'],1,0,'C',0);
                $pdf->Cell(40,6,$datos['nombres'],1,0,'C',0);
                $pdf->Cell(25,6,$datos['nombreCurso'],1,1,'C',0);
            }
        }
        $pdf->Output();
        ?>