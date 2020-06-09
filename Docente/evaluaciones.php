<?php 
require_once "../Clases/BD.php";
$conn= new baseD();
?>
<!DOCTYPE html>
 <html>

 <head>
   <title>Evaluaciones</title>
 </head>

 <body>


     <!-- Data -->
     <div>
       <form action="" method="post">
         <table class="table">
           <thead class="thead-dark">
             <tr>
             <th scope="col">Nombre</th>
             <th scope="col">Porcentaje</th>
            <th scope="col">Modulo</th>
             </tr>
           </thead>
           <tbody>

             <?php
              $consulta2 = $conn->busquedaFree("SELECT
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
                  ;
              ");
              foreach ($consulta2 as $datos) {
                $id_del = $datos['idEvaluaciones'];
                $nombre = $datos['nombreEvaluacion'];
                $porcentaje = $datos['porcentaje'];
                $modulo =$datos['idModulo'];

                echo " <tr>
          <td>$nombre</td>
          <td>$porcentaje</td>
          <td>$modulo</td>";
          
          echo "</tr>";
              }

              ?>
           </tbody>
         </table>
       </form>
     </div>
 </body>
 </html>