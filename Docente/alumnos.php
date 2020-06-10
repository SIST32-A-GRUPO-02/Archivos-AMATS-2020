<?php 
@session_start();
require_once "../Clases/BD.php";
$conn = new baseD();
/* if(isset($_SESSION['rol'])){
  $conn->comprobar_posicion($_SESSION['rol']);
}
else{
  header("location: index.php");
} */
?>
<!DOCTYPE html>
 <html>

 <head>
   <title>Participante</title>
 </head>

 <body>
     <!-- Data -->
     <div>
       <form action="" method="post">
         <table class="table">
           <thead class="thead-dark">
             <tr>
             <th scope="col">#</th>
               <th scope="col">Nombre</th>
               <th scope="col">Apellido</th>
               <th scope="col">Fecha de Nacimiento</th>
               <th scope="col">Sexo</th>
               <th scope="col">Convocatoria</th>
             </tr>
           <tbody>

             <?php
              $consulta = $conn->busquedaFree("SELECT
              `participante`.`idParticipante`
              , `participante`.`nombres`
              , `participante`.`apellidos`
              , `participante`.`fechaNacimiento`
              , `participante`.`sexo`
              , `participante`.`dui`
              , `participante`.`nit`
              , `participante`.`direccion`
              , `convocatoria`.`nombreConvocatoria`
          FROM
              `dawproyecto`.`participante`
              INNER JOIN `dawproyecto`.`convocatoria` 
                  ON (`participante`.`idConvocatoria` = `convocatoria`.`idConvocatoria`);
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
            
                echo " <tr class='select'>
          <td>$id</td>
          <td>$nombre</td>
          <td>$apellido</td>
          <td>$fecha</td>
          <td>$sexo</td>
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
            