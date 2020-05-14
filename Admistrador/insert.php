<?php
   require_once "../Clases/BD.php";
   $conn = new baseD();
if (isset($_GET['send'])) {
    echo '<script>alert("Entra");</script>';
    $nombreDo = $_GET['nombre'];
    $ApellidoDo = $_GET['apellido'];
    $dui = $_GET['dui'];
    $nit = $_GET['nit'];
    $especialidad = $_REQUEST['especialidad'];
    $direccion = $_GET['direccion'];
    $sexo = $_GET['sexo'];
    /* $fechaNac = $_GET['fecha']; */
    $fechaNac = date('Y-m-d', strtotime($_GET['fecha']));
    $conn->insertar(
      "docente( nombres, apellidos, fechaNacimiento, sexo, dui, nit, direccion, idEspecialidad)",
      "'$nombreDo','$ApellidoDo','$fechaNac','$sexo','$dui','$nit','$direccion','$especialidad'"
    );
   echo " <script>window.location.replace('./index.php?x=docentes.php')</script>";
  } 
?>