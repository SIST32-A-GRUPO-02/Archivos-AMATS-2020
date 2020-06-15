<?php
@session_start();


?>
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
      <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Entrar</button>

    </form>
  </div>
</body>
<script>
  document.write(
    '<script src="http://' +
    (location.host || '${1:localhost}').split(':')[0] +
    ':${2:35729}/livereload.js?snipver=1"></' +
    'script>'
  );
</script>
<html>
<?php
@session_start();
include_once "Clases/BD.php";
$conn = new baseD();

if(isset($_SESSION['rol'])){
  header("location: index.php");
}
else{
  if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $resultado = $conn->busquedaFree("SELECT * FROM usuarios where usuario='$usuario' AND contra='$clave' LIMIT 1");
    $rol="";
    //Validacion para saber si hay resultados 
    if ($resultado == true) {
      foreach ($resultado as $value) {
        $rol=$value['idRol'];
        $participante=$value['idParticipante'];
        $docen=$value['idDocente'];
      }
  
      //Validación para saber que tipo de usuario
      if($docen==true){
        $nombreusu=$conn->busquedaFree("SELECT
        `nombres`, `apellidos` FROM `dawproyecto`.`docente` WHERE idDocente=$docen LIMIT 1;");
      }
      elseif($participante==true){
        $_SESSION['id']=$participante;
        $nombreusu=$conn->busquedaFree("SELECT `nombres`, `apellidos` FROM `dawproyecto`.`participante` WHERE idParticipante=$participante LIMIT 1;");
      }
      foreach ($nombreusu as $value) {
        $_SESSION['Nombre']=strtoupper($value['nombres']." ".$value['apellidos']);
      }
        $_SESSION['rol']=$rol;
        header ("location: index.php");
  
    }else {
      echo "<script>alert('Usuario o contraseña incorrectos.')</script>";
    }
  }
}
?>