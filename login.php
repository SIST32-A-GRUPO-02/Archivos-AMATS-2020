<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login">
	<h1>Iniciar sesión</h1>
    <form method="post" action="login.php">
    	<input type="text" name="usuario" placeholder="Usuario" required="required" />
        <input type="password" name="clave" placeholder="Contraseña" required="required" />
        <button type="submit" name="sesion" class="btn btn-primary btn-block btn-large">Entrar</button>
    </form>
</div>
</body>
<html>
<?php 
include_once "Clases/BD.php";
$conn= new baseD();

if(isset($_POST['sesion'])){
$usuario=$_POST['usuario'];
$clave=filter_var($_POST['clave']);
$resultado=$conn->busquedaFree("SELECT * FROM usuarios where usuario=$usuario AND contra=$clave");
if($resultado!==false){
    foreach ($resultado as $datos) {
        if($datos["idRol"]==1){
            $IDdocente=$datos['idDocente'];
            $_SESSION['usuario']=$IDdocente;
            header("Location: /Administrador/index.php");
        }
        elseif($datos["idRol"]==2){
            $IDdocente=$datos['idDocente'];
            $_SESSION['usuario']=$IDdocente;
            header("Location: /Docente/index.php");
        }else{
            echo 
        }
    }
}else {
                
}
}else{
}
?>
