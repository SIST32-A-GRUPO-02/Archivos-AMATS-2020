<?php
	require '../fpdf/fpdf.php';
	require '../Clases/BD.php';
    $conn = new baseD();
    //consulta a utilizar en el foreach para acceder a la tabla
    $consulta = $conn->busquedaFree("SELECT
    `docente`.`idDocente`,
    `docente`.`nombres`,
    `docente`.`apellidos`,
    `docente`.`fechaNacimiento`,
    `docente`.`sexo`,
    `docente`.`dui`,
    `docente`.`nit`,
    `docente`.`direccion`,
    `especialidad`.`nombreEspecialidad`
  FROM
    `dawproyecto`.`docente`
    INNER JOIN `dawproyecto`.`especialidad`
      ON (
        `docente`.`idEspecialidad` = `especialidad`.`idEspecialidad`
      );");

	$pdf = new FPDF();
	$pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../images/logo.png', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'REPORTE DE DOCENTES',0,0,'C');
    $pdf->Ln(30);
    
    //inicio de tabla
		$pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(40,6,'NOMBRES',1,0,'C',1);
        $pdf->Cell(40,6,'APELLIDOS',1,0,'C',1);
        $pdf->Cell(30,6,'NACIMIENTO',1,0,'C',1);
        $pdf->Cell(20,6,'SEXO',1,0,'C',1);
        $pdf->Cell(23.75,6,'DUI',1,0,'C',1);
        $pdf->Cell(30,6,'ESPECIALIDAD',1,1,'C',1);

        if($consulta!=true){
            
        }else{
            foreach($consulta as $datos){
            
                $pdf->Cell(40,6, $datos['nombres'],1,0,'C',0);
                $pdf->Cell(40,6, $datos['apellidos'],1,0,'C',0);
                $pdf->Cell(30,6, $datos['fechaNacimiento'],1,0,'C',0);
                $pdf->Cell(20,6, $datos['sexo'],1,0,'C',0);
                $pdf->Cell(23.75,6, $datos['dui'],1,0,'C',0);
                $pdf->Cell(30,6, $datos['nombreEspecialidad'],1,0,'C',0);
              
            }
        }
        $pdf->Output();
        ?>