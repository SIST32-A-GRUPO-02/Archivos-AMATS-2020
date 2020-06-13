<!DOCTYPE html>
 <html>

 <head>
   <title>Notas</title>
 </head>

 <body>
   <div style="margin-bottom: 5px; margin-left:16px;">
     <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
     <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-primary" >Mantenimiento</button>
     <a href="../pdf/notaspdf.php" class="btn btn-danger">Reportes</a>
     <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-info" >Buscar</a>
   </div>

   <!-- Inicio Modal -->
   <div class="w3-container">
     <div id="id01" class="w3-modal">
       <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
         <div class="w3-center"><br>
           <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
           <p>Registrar Notas</p>
         </div>
         <form class="w3-container" method="post" action="mant_notas.php">
         <div class="w3-section">
             <label><b>Nota</b></label>
             <input class="w3-input w3-border " type="text" placeholder="Escriba la nota" name="nota" required>
             <label><b>Modulo</b></label>
             <select name="modulo" id="" class="w3-input w3-border">
               <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("modulo");

                foreach ($consulta as $datos) {
                  $id = $datos['idModulo'];
                  $nombreModulo = $datos['nombreModulo'];
                ?>
                 <option value="<?php echo $id; ?>"><?php echo $nombreModulo; ?></option>
               <?php
                }
                ?>
             </select>
             <label><b>Evaluación</b></label>
             <select name="evaluacion" id="" class="w3-input w3-border">
             <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("evaluaciones");

                foreach ($consulta as $datos) {
                  $id = $datos['idEvaluaciones'];
                  $nombreEvaluacion = $datos['nombreEvaluacion'];
                ?>
                 <option value="<?php echo $id; ?>"><?php echo $nombreEvaluacion; ?></option>
         </div>
       
               <?php
                }
                ?>
             </select>
             <label><b>Participante</b></label> 
             <select name="participante" id="" class="w3-input w3-border">
             <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("participante");

                foreach ($consulta as $datos) {
                  $id = $datos['idparticipante'];
                  $nombreParticipante = $datos['nombres'];
                  $apellidoParticipante = $datos['apellidos'];

                ?>
                 <option value="<?php echo $nombreParticipante; ?>"><?php echo $nombreParticipante . " " . $apellidoParticipante ?></option>
                 
               <?php
                }
                ?>
             </select>
             <input type="submit" class="w3-button w3-block w3-green w3-section w3-padding" value="Registrar" name="send_insert">
           </div>
         </form>
         <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
           <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
         </div>
       </div>
     </div>
    
     <!--  Modal 3 -->
     <div id="id03" class="w3-modal">
       <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
         <div class="w3-center"><br>
           <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
           <p>Mantenimiento de Notas</p>
         </div>
         <form class="w3-container" method="post" action="mant_notas.php">
           <div class="w3-section">
             <table class="table">
               <thead class="thead-dark">
                 <tr>
                 <th scope="col">#</th>
                 <th scope="col">Modulo</th>
                 <th scope="col">Evaluación</th>
                   <th scope="col">Participante</th>
                   <th scope="col">Nota</th>  
                 </tr>
               </thead>
               <tbody>

                 <?php
                  $conn = new baseD();
                  $consulta_notas = $conn->busquedaFree("SELECT idnota,nota,participante.nombres,participante.apellidos,nombreEvaluacion,nombreModulo FROM nota 
                  INNER JOIN participantecurso ON nota.idParticipanteCurso = participantecurso.idParticipanteCurso 
                  INNER JOIN participante ON participantecurso.idParticipante = participante.idParticipante
                INNER JOIN evaluaciones ON nota.idEvaluaciones = evaluaciones.idEvaluaciones
                INNER JOIN modulo ON nota.idModulo = modulo.idModulo");

                  foreach ($consulta_notas as $datos_notas) {
                    $id_del = $datos_notas['idnota'];
                    $nota = $datos_notas['nota'];
                    $nombre = $datos_notas['nombreModulo'];
                    $nombreEvaluacion = $datos_notas['nombreEvaluacion'];
                    $participante = $datos_notas['nombres'];
                    $apellidosparticipante = $datos_notas['apellidos'];
                  ?>
                   <tr>
                     <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                     <td> <?php echo $nombre; ?></td>
                     <td><?php echo $nombreEvaluacion; ?></td>
                     <td><?php echo $participante . " " . $apellidosparticipante; ?></td>
                     <td><?php echo $nota; ?></td>
                    </tr>

                 <?php
                  }
                  ?>
               </tbody>
             </table>
             <div style="text-align: center;">
               <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="Actualizar" name="send_update">
               <input type="submit" class="w3-button w3-red w3-section w3-padding" value="Eliminar" name="send_dl">
             </div>
           </div>
         </form>
         <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
           <button onclick="document.getElementById('id03').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
         </div>
       </div>
     </div>
     <!-- Fin Modal -->

     <!-- Data -->
     <div>
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
               $consulta_notas = $conn->busquedaFree("SELECT idnota,nota,participante.nombres,participante.apellidos,nombreEvaluacion,nombreModulo FROM nota 
               INNER JOIN participantecurso ON nota.idParticipanteCurso = participantecurso.idParticipanteCurso 
               INNER JOIN participante ON participantecurso.idParticipante = participante.idParticipante
             INNER JOIN evaluaciones ON nota.idEvaluaciones = evaluaciones.idEvaluaciones
             INNER JOIN modulo ON nota.idModulo = modulo.idModulo");

               foreach ($consulta_notas as $datos_notas) {
                 $id_del = $datos_notas['idnota'];
                 $nota = $datos_notas['nota'];
                 $nombre = $datos_notas['nombreModulo'];
                 $nombreEvaluacion = $datos_notas['nombreEvaluacion'];
                 $participante = $datos_notas['nombres'];
                 $apellidosparticipante = $datos_notas['apellidos'];

                echo " <tr>
          <td>$nombre</td>
          <td>$nombreEvaluacion</td>
          <td>$participante $apellidoParticipante</td>
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