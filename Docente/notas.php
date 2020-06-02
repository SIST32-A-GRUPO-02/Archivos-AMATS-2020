<?php
@session_start();

include_once "../Clases/BD.php";

$conn= new baseD();
$conn->comprobar_sesion($_SESSION['rol']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>notas</title>
</head>
<body>

<table class="table">
               <thead class="thead-dark">
                 <tr>
                   <th scope="col">Nombres</th>
                   <th scope="col">Apellidos</th>
                   <th scope="col">Nota</th>
                   <th scope="col">Módulo</th>
                   <th scope="col">Evaluación</th>
                 </tr>
               </thead>
    <?php
    include_once "../Clases/BD.php";
    $conn = new baseD();
    
    $consulta_notas = $conn->busquedaFree("
    	SELECT
    `participante`.`nombres`
    , `participante`.`apellidos`
    , `nota`.`nota`
    , `modulo`.`nombrerModulo`
    , `evaluaciones`.`nombreEvaluacion`
FROM
    `dawproyecto`.`participantemodulo`
    INNER JOIN `dawproyecto`.`participante` 
        ON (`participantemodulo`.`idParticipante` = `participante`.`idParticipante`)
    INNER JOIN `dawproyecto`.`modulo` 
        ON (`participantemodulo`.`idModulo` = `modulo`.`idModulo`)
    INNER JOIN `dawproyecto`.`nota` 
        ON (`nota`.`idModulo` = `modulo`.`idModulo`)
    INNER JOIN `dawproyecto`.`evaluaciones` 
        ON (`nota`.`idEvaluacion` = `evaluaciones`.`idEvaluciones`) AND (`nota`.`idParticipanteModulo` = `participantemodulo`.`idParticipanteModulo`);");

    foreach ($consulta_notas as $datos) {
       
        $nombre = $datos['nombres'];
        $apellidos = $datos['apellidos'];
        $nota = $datos['nota'];
         $nombreModulo = $datos['nombreModulo'];
          $nombreEvaluacion = $datos['nombreEvaluacion'];
        ?>
        <tr>
            
            <td>echo $nombre;</td>
            <td>echo $apellidos;</td>
            <td>echo $nota;</td>
            <td>echo $nombreModulo;</td>
            <td>echo $nombreEvaluacion;</td>
        </tr>
      
        <?php
    }
    ?>
</table>
</body>
</html>