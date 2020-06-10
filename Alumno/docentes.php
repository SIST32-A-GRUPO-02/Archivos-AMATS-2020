 <?php
  //include_once("menuAdmi.php");
  ?>
 <!DOCTYPE html>
 <html>

 <head>
   <title>Docente</title>
   <style>
     td, th{
       text-align: center;
     }
   </style>
 </head>

 <body>
 
<h3>Docentes</h3><br>
     <!-- Data -->
     <div>
       <form action="" method="post">
         <table class="table">
           <thead class="thead-dark">
             <tr>
               <th scope="col">Nombre</th>
               <th scope="col">Apellido</th>
               <th scope="col">Especialidad</th>
             </tr>
           <tbody>

             <?php
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
    );
");
              foreach ($consulta as $datos) {
                $id = $datos['idDocente'];
                $nombre = $datos["nombres"];
                $apellido = $datos['apellidos'];
                $fecha = $datos['fechaNacimiento'];
                $sexo = $datos['sexo'];
                $dui = $datos['dui'];
                $nit = $datos['nit'];
                $direccion = $datos['direccion'];
                $especialidad = $datos['nombreEspecialidad'];
                echo "<tr class='select'>
          <td>$nombre</td>
          <td>$apellido</td>
          <td>$especialidad</td>
        </tr>";
              }

              ?>
           </tbody>
       </form>
     </div>
 </body>

 </html>