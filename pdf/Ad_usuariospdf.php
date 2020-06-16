<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
    $conn = new baseD();
    //consulta a utilizar en el foreach para acceder a la tabla
    $consulta = $conn->busquedaFree("SELECT
    `usuarios`.`idUsuario`,
    `usuarios`.`usuario`,
    `rol`.`nombreRol`,
    `docente`.`nombres`,
    `docente`.`apellidos`
  FROM
    `dawproyecto`.`usuarios`
    INNER JOIN `dawproyecto`.`rol`
      ON (
        `usuarios`.`idRol` = `rol`.`idRol`
      ) 
      INNER JOIN `dawproyecto`.`docente`
   ON (
     `usuarios`.`idDocente` = `docente`.`idDocente`
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
    $pdf->Cell(45,6,'USUARIOS',1,0,'C',1);
    $pdf->Cell(45,6,'ROLES',1,0,'C',1);
    $pdf->Cell(45,6,'NOMBRES',1,0,'C',1);
    $pdf->Cell(45,6,'APELLIDOS',1,1,'C',1);
    $pdf->SetFont('Arial','',10);
    //datos
    if($consulta!=true){
        $pdf->Cell(180,6,'No hay datos',1,1,'C',1);
    }else{
        foreach ($consulta as $datos) {
            $pdf->Cell(45,6,$datos['usuario'],1,0,'C',0);
            $pdf->Cell(45,6,$datos['usuario'],1,0,'C',0);
            $pdf->Cell(45,6,$datos['nombres'],1,0,'C',0);
            $pdf->Cell(45,6,$datos['apellidos'],1,1,'C',0);
        }
    }

    $pdf->Output();
    ?>