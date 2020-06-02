<?php
@session_start();

$conn= new baseD();
$conn->comprobar_sesion($_SESSION['rol']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<table class="table">
               <thead class="thead-dark">
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Nombre</th>
                   <th scope="col">Apellido</th>
                   <th scope="col">Especialidad</th>
                 </tr>
               </thead>
    <?php
    include_once "../Clases/BD.php";
    $conn = new baseD();
    
    $consulta_docentes = $conn->busquedaFree("");

    foreach ($consulta_docentes as $datos) {
        $id_del = $datos['idDocente'];
        $nombre = $datos['nombres'];
        $apellidos = $datos['apellidos'];
        $especialidad = $datos['nombreEspecialidad'];
        ?>
        <tr>
            <td>echo $id_del;</td>
            <td>echo $nombre;</td>
            <td>echo $apellidos;</td>
            <td>echo $especialidad;</td>
        </tr>
      
        <?
    }
    ?>
</table>
</body>
</html>
          