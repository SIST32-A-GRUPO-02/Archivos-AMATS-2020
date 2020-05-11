<?php
   require_once "../../Clases/BD.php";
   $conn = new baseD();
if (isset($_GET['send'])) {
    echo '<script>alert("Entra");</script>';
    $id_del = $_GET['id_us'];
    $conn->borrar(
      "docente",
      "$id_del"
    );
   echo " <script>window.location.replace('./index.php?x=DocenteAd.php')</script>";
  } 
?>