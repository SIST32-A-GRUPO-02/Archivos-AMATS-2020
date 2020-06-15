<?php 
@session_start();
?>
<!DOCTYPE html>
 <html>
 <head>
   <title>Notas</title>
 </head>
 <style>
  td, th{
    text-align: center;
  }
  .select:hover{
    background-color: #C9C9C9 ;
    color: #000000 ;
  }
  .alineacion{
    text-align: left;
  }
</style>
 <body>
 <h2>Notas</h2>
   <a href="../pdf/A_notaspdf.php" class="btn btn-danger">Reportes</a><br>
    
     <!-- Data -->
     <br>
       <form action="" method="post">
         <table class="table">
           <thead class="thead-dark">
             <tr>
                 <th scope="col">Modulo</th>
                 <th scope="col">Evaluación</th>
                   <th scope="col">Participante</th>
                   <th scope="col">Nota</th>  
             </tr>
           </thead>
           <tbody>

             <?php
               $consulta_notas = $conn->busquedaFree("SELECT idnota,participante.idParticipante,nota,participante.nombres,participante.apellidos,nombreEvaluacion,nombreModulo FROM nota 
               INNER JOIN participantecurso ON nota.idParticipanteCurso = participantecurso.idParticipanteCurso 
               INNER JOIN participante ON participantecurso.idParticipante = participante.idParticipante
             INNER JOIN evaluaciones ON nota.idEvaluaciones = evaluaciones.idEvaluaciones
             INNER JOIN modulo ON nota.idModulo = modulo.idModulo
             WHERE participante.idParticipante =".$_SESSION['id'].";");

               foreach ($consulta_notas as $datos_notas) {
                 $id_del = $datos_notas['idnota'];
                 $nota = $datos_notas['nota'];
                 $nombre = $datos_notas['nombreModulo'];
                 $nombreEvaluacion = $datos_notas['nombreEvaluacion'];
                 $participante = $datos_notas['nombres'];
                 $apellidosparticipante = $datos_notas['apellidos'];

                echo " <tr class='select'>
          <td>$nombre</td>
          <td>$nombreEvaluacion</td>
          <td>$participante $apellidosparticipante</td>
          <td>$nota</td>";
          echo "</tr>";
              }
              ?>
           </tbody>
         </table>
       </form>
     </div>
 </body>
 </html>