<!DOCTYPE html>
 <html>
 <head>
   <title>Cursos</title>
<style>
  td, th{
    text-align: center;
  }
  .select:hover{
    background-color: #C9C9C9 ;
    color: #000000 ;
  }
</style>
  </head>

 <body>
   <h2>Cursos</h2>
   <a href="../pdf/A_cursospdf.php" class="btn btn-danger">Reportes</a><br><br>
     <!-- Data -->
  
       <form action="" method="post">
         <table class="table">
           <thead class="thead-dark">
             <tr>
             <th scope="col">Nombre del Curso</th>
               <th scope="col">identificador</th>
               <th scope="col">Responsable</th>
             </tr>
           </thead>
           <tbody>

             <?php
             require_once "../Clases/BD.php";
             $conn = new baseD();
              $consulta = $conn->busquedaFree("SELECT

                `curso`.`idCurso`,
                `curso`.`nombreCurso`,
                `curso`.`identificador`,
                `curso`.`responsable`
FROM
  `dawproyecto`.`curso`;
");
              foreach ($consulta as $datos) {
                $id = $datos['idCurso'];
                $nombre = $datos['nombreCurso'];
                $identificador = $datos['identificador'];
                $responsable = $datos['responsable'];
                echo " <tr class='select'>
                <td>$nombre</td>
                <td>$identificador</td>
                <td>$responsable</td>
        </tr>";
              }

              ?>
           </tbody>
       </form>
     </div>
 </body>
 </html>
            