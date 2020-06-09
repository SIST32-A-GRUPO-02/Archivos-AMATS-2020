<?php
@session_start();


$conn= new baseD();
$conn->comprobar_sesion($_SESSION['rol']);
?>

<!DOCTYPE html>
 <html>

 <head>
   <title>Participante</title>
 </head>

 <body>
   <div style="margin-bottom: 5px; margin-left:16px;">
     <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
     <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-info" >Mantenimiento</button>

   </div>

   <!-- Inicio Modal -->
   <div class="w3-container">
     <div id="id01" class="w3-modal">
       <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
         <div class="w3-center"><br>
           <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
           <p>Registrar Alumno</p>
         </div>
         <form class="w3-container" method="post" action="mant_alumnos.php">
           <div class="w3-section">
             <label><b>Nombre</b></label>
             <input class="w3-input w3-border " type="text" placeholder="Escriba el Nombre" name="nombre" required>
             <label><b>Apellido</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba los Apellidos" name="apellido" required>
             <label><b>Telefono celular</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el Telefono" name="telefono_personal" id="telp" required>
             <label><b>Telefono fijo</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el Telefono" name="telefono_fijo" id="telc" required>
             <label><b>Dirección</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba la dirección" name="direccion" required>
             <label><b>Sexo</b></label>
             <select name="sexo" id="" class="w3-input w3-border">
               <option value="Hombre"><b>Hombre</b></option>
               <option value="Mujer"><b>Mujer</b></option>
             </select>
             <label><b>Convocatoria</b></label>
             <select name="convocatoria" id="" class="w3-input w3-border">
               <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("convocatoria");

                foreach ($consulta as $datos) {
                  $id = $datos['idConvocatoria'];
                  $nombre = $datos['nombreConvocatoria'];
                ?>
                 <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
               <?php
                }
                ?>

             </select>
             <label><b>DUI</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el número de DUI" name="dui" required>
             <label><b>NIT</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el número de NIT" name="nit" required>
             <label><b>Fecha de Nacimiento</b></label>
             <input class="w3-input w3-border" type="date" placeholder="Escriba la Fecha de Nacimiento" name="fecha" required>
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
           <p>Mantenimiento de Alumnos</p>
         </div>
         <form class="w3-container" method="post" action="mant_alumnos.php">
           <div class="w3-section">
             <table class="table">
               <thead class="thead-dark">
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Nombre</th>
                   <th scope="col">Apellido</th>
                   <th scope="col">Convocatoria</th>
                 </tr>
               </thead>
               <tbody>

                 <?php
                  $conn = new baseD();
                  $consulta_participante = $conn->busquedaFree("SELECT
                `participante`.`idParticipante`,
                `participante`.`nombres`,
                `participante`.`apellidos`,
                `participante`.`fechaNacimiento`,
                `participante`.`sexo`,
                `participante`.`dui`,
                `participante`.`nit`,
                `participante`.`direccion`,
                `convocatoria`.`nombreConvocatoria`
              FROM
                `dawproyecto`.`participante`
                INNER JOIN `dawproyecto`.`convocatoria`
                  ON (
                    `participante`.`idConvocatoria` = `convocatoria`.`idConvocatoria`
                  ) 
                  ;
              ");

                  foreach ($consulta_participante as $datos) {
                    $id_del = $datos['idParticipante'];
                    $nombre = $datos['nombres'];
                    $apellidos = $datos['apellidos'];
                    $convocatoria = $datos['nombreConvocatoria'];
                  ?>
                   <tr>
                     <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                     <td> <?php echo $nombre; ?></td>
                     <td><?php echo $apellidos; ?></td>
                     <td><?php echo $convocatoria; ?></td>
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
               <th scope="col">Nombre</th>
               <th scope="col">Apellido</th>
               <th scope="col">Telefono</th>
               <th scope="col">Fecha de Nacimiento</th>
               <th scope="col">Sexo</th>
               <th scope="col">Dui</th>
               <th scope="col">Nit</th>
               <th scope="col">Dirección</th>
               <th scope="col">Convocatoria</th>
             </tr>
           <tbody>

             <?php
              $consulta = $conn->busquedaFree("SELECT
  `participante`.`idParticipante`,
  `participante`.`nombres`,
  `participante`.`apellidos`,
  `participante`.`fechaNacimiento`,
  `participante`.`sexo`,
  `participante`.`dui`,
  `participante`.`nit`,
  `participante`.`direccion`,
  `convocatoria`.`nombreConvocatoria`,
  `telefonoparticipante`.`numeroTelefono`
FROM
  `dawproyecto`.`participante`
  INNER JOIN `dawproyecto`.`convocatoria`
    ON (
      `participante`.`idConvocatoria` = `convocatoria`.`idConvocatoria`
    )
    INNER JOIN `dawproyecto`.`telefonoparticipante`
                  ON (
                    `participante`.`idParticipante` = `telefonoparticipante`.`idParticipante`
                  ) Where idTelefono = 2;
");
              foreach ($consulta as $datos) {
                $id = $datos['idParticipante'];
                $nombre = $datos["nombres"];
                $apellido = $datos['apellidos'];
                $fecha = $datos['fechaNacimiento'];
                $sexo = $datos['sexo'];
                $dui = $datos['dui'];
                $nit = $datos['nit'];
                $direccion = $datos['direccion'];
                $convocatoria = $datos['nombreConvocatoria'];
                $telefono = $datos['numeroTelefono'];
                echo " <tr>
          <td>$nombre</td>
          <td>$apellido</td>
          <td>$telefono</td>
          <td>$fecha</td>
          <td>$sexo</td>
          <td>$dui</td>
          <td>$nit</td>
          <td>$direccion</td>
          <td>$convocatoria</td>
        </tr>";
              }

              ?>
           </tbody>
       </form>
     </div>
 </body>
<script>
  $( function() {
    $("#telp").change( function() {
        if ($(this).val() !== "") {
            $("#telc").removeAttr("required");
        }else{
          $('#telc').prop("required", true);
        }
    });
    $("#telc").change( function() {
        if ($(this).val() !== "") {
            $("#telp").removeAttr("required");
        }else{
          $('#telp').prop("required", true);
        }
    });
});
</script>
 </html>
            