<?php
@session_start();

include "../Clases/BD.php";

$conn= new baseD();
$conn->comprobar_sesion($_SESSION['rol']);
?>