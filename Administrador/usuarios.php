<!DOCTYPE html>
 <html>

 <head>
   <title>Usuarios</title>
 </head>

 <body>
   <div style="margin-bottom: 5px; margin-left:16px;">
     <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
     <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-primary" >Mantenimiento</button>
     <a href="../pdf/usuariospdf.php" class="btn btn-danger">Reportes</a>
     <div style="float: right; margin-right:40px;">
            <form action="" method="post">
                <input type="text" style="border-radius: 5px;" name="busqueda" required>
                <input type="submit" value="Buscar" class="btn btn-info" name="send_busqueda"></input>
            </form>
        </div>
   </div>

   <!-- Inicio Modal -->
   <div class="w3-container">
     <div id="id01" class="w3-modal">
       <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
         <div class="w3-center"><br>
           <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
           <p>Registrar Usuarios</p>
         </div>
         <form class="w3-container" method="post" action="mant_usuarios.php">
           <div class="w3-section">
             <label><b>Usuario</b></label>
             <input class="w3-input w3-border " type="text" placeholder="Escriba el usuario" name="usuario" required>
             <label><b>Contraseña</b></label>
             <input class="w3-input w3-border" type="text" placeholder="1234" name="contraseña" required>
             <label><b>Seleccione el Tipo (Docente o Alumno)</b></label>
             <select name="tipo" id="tipo" class="w3-input w3-border">
                 <option value="1" selected>Alumno</option>
                 <option value="2">Docente</option>
             </select>
             <div id="participante">
             <label><b>Alumno</b></label> 
             <select name="participante" id="" class="w3-input w3-border">
             <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("participante");

                foreach ($consulta as $datos) {
                  $id = $datos['idParticipante'];
                  $nombreParticipante = $datos['nombres'];
                  $apellidoParticipante = $datos['apellidos'];

                ?>
                 <option value="<?php echo $nombreParticipante; ?>"><?php echo $nombreParticipante . " " . $apellidoParticipante ?></option>
                 
               <?php
                }
                ?>
             </select>
             </div>
             <div id="docente" style="display: none;">
             <label><b>Docente</b></label>
             <select name="docente" id="" class="w3-input w3-border">
               <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("docente");

                foreach ($consulta as $datos) {
                  $id = $datos['idDocente'];
                  $nombreDocente = $datos['nombres'];
                  $apellidoDocente = $datos['apellidos'];
                ?>
                 <option value="<?php echo $id; ?>"><?php echo $nombreDocente . " " .$apellidoDocente ?></option>
                
                 <?php
                }
                ?>
             </select>
             </div>
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
           <p>Mantenimiento de Usuarios</p>
         </div>
         <form class="w3-container" method="post" action="mant_usuarios.php">
           <div class="w3-section">
             <table class="table">
               <thead class="thead-dark">
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Usuario</th>
                   <th scope="col">Rol</th>
                   <th scope="col">Nombre</th>
                 </tr>
               </thead>
               <tbody>

                 <?php
                  $conn = new baseD();
                  $consulta_usuarios = $conn->busquedaFree("SELECT
                `usuarios`.`idUsuario`,
                `usuarios`.`usuario`,
                `rol`.`nombreRol`,
                `participante`.`nombres`,
                `participante`.`apellidos`
              FROM
                `dawproyecto`.`usuarios`
                INNER JOIN `dawproyecto`.`rol`
                  ON (
                    `usuarios`.`idRol` = `rol`.`idRol`
                  ) 
                INNER JOIN `dawproyecto`.`participante`
                  ON (
                    `usuarios`.`idParticipante` = `participante`.`idParticipante`
                  )   
                  ;
              ");
                   $consulta_docentes = $conn->busquedaFree("SELECT
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
                     ;
                 ");
                  foreach ($consulta_usuarios as $datos) {
                    $id_del = $datos['idUsuario'];
                    $usuario = $datos['usuario'];
                    $rol = $datos['nombreRol'];
                    $nombreParticipante = $datos['nombres'];
                    $apellidoParticipante = $datos['apellidos'];
                   
                  ?>
                   <tr>
                     <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                     <td> <?php echo $usuario; ?></td>
                     <td><?php echo $rol; ?></td>
                     <td><?php echo $nombreParticipante ." ". $apellidoParticipante; ?></td>

                   </tr>

                 <?php
                  }
                  foreach ($consulta_docentes as $datos) {
                    $id_del = $datos['idUsuario'];
                    $usuario = $datos['usuario'];
                    $rol = $datos['nombreRol'];
                    $nombreDocente = $datos['nombres'];
                    $apellidoDocente = $datos['apellidos'];
                  ?>
                   <tr>
                     <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                     <td> <?php echo $usuario; ?></td>
                     <td><?php echo $rol; ?></td>
                     <td><?php echo $nombreDocente ." ".$apellidoDocente; ?></td>

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
                   <th scope="col">Usuario</th>
                   <th scope="col">Rol</th>
                   <th scope="col">Nombre</th>
             </tr>
           </thead>
           <tbody>

           <?php
           if (isset($_POST['send_busqueda'])) {
            $busqueda = $_POST['busqueda'];
            if ($busqueda == 'Docente') {
              $busqueda2 = 1;
            }elseif ($busqueda == 'Participante') {
              $busqueda2 = 2;
            }else{
              $busqueda2 = $busqueda;
            }
            if ($busqueda2 != "") {
              $consulta_docentes = $conn->busquedaFree("SELECT
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
            Where usuario LIKE '%$busqueda%'  OR rol.nombreRol = '$busqueda'
            ");
            
             foreach ($consulta_docentes as $datos) {
               $id_del = $datos['idUsuario'];
               $usuario = $datos['usuario'];
               $rol = $datos['nombreRol'];
               $nombreDocente = $datos['nombres'];
               $apellidoDocente = $datos['apellidos'];
             ?>
              <tr>
                <td> <?php echo $usuario; ?></td>
                <td><?php echo $rol; ?></td>
                <td><?php echo $nombreDocente ." ".$apellidoDocente; ?></td>

              </tr>
            <?php
             }
            }
          }else{
                  
                   $consulta_docentes = $conn->busquedaFree("SELECT
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
                     ;
                 ");
                 
                  foreach ($consulta_docentes as $datos) {
                    $id_del = $datos['idUsuario'];
                    $usuario = $datos['usuario'];
                    $rol = $datos['nombreRol'];
                    $nombreDocente = $datos['nombres'];
                    $apellidoDocente = $datos['apellidos'];
                  ?>
                   <tr>
                     <td> <?php echo $usuario; ?></td>
                     <td><?php echo $rol; ?></td>
                     <td><?php echo $nombreDocente ." ".$apellidoDocente; ?></td>

                   </tr>
                 <?php
                  }
                }
                  ?>
           </tbody>
         </table>
       </form>
     </div>

     <script>
  $( function() {
    $("#tipo").change( function() {
        if ($(this).val() == 1) {
            $("#docente").hide();
            $("#participante").show();
        }else{
            $("#participante").hide();
            $("#docente").show();
        }
    });
});
</script>
 </body>
 </html>