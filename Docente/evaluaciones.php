<?php
@session_start();

include_once "../Clases/BD.php";

$conn= new baseD();
$conn->comprobar_sesion($_SESSION['rol']);
?>