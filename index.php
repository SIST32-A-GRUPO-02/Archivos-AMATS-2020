<?php 
@session_start();
include_once "Clases/BD.php";
$conn= new baseD();

if(isset($_SESSION['rol'])){
  switch ($_SESSION['rol']) {
    case 1:
       header("location: Docente/index.php");
     break;
      case 2:
         header("location: Alumno/index.php");
       break;
    case 3:
       header("location: Administrador/index.php");
     break;
   }
  }
  else{
    header("location: login.php");
  }
?>
