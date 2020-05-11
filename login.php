<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login">
	<h1>Iniciar sesión</h1>
    <form method="post">
    	<input type="text" name="usuario" placeholder="Usuario" required="required" />
        <input type="password" name="clave" placeholder="Contraseña" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Entrar</button>
    </form>
</div>
</body>
<html>
<?php
require_once "Clases/BD.php";

$conn= new baseD();

$consulta= $conn->busqueda("rol");

	foreach($consulta as $dato){
		echo $dato['idRol']."<br />";
	}



?>
