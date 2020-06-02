
<?php 
@session_start();
include_once "Clases/BD.php";
$conn= new baseD();

if(isset($_POST['sesion'])){
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$rol=0;
$docen=0;
$resultado=$conn->busquedaFree("SELECT * FROM usuarios where usuario='$usuario' AND contra='$clave' LIMIT 1");

  if($resultado==true){

        //Para acceder a los resultados de la consulta y poder usarlo en sesiones
        foreach ($resultado as $value) {
          $rol=$value['idRol'];
          $docen=$value['idDocente'];
        }
          $_SESSION['rol']=$rol;
        switch ($_SESSION['rol']) {
           case 1:
              header("location: Administrador/index.php");
             $nameusu=$conn->busquedaFree("SELECT nombres, apellidos FROM docente WHERE idDocente=(SELECT idDocente FROM usuarios WHERE idDocente=$docen LIMIT 1) LIMIT 1;");

              foreach ($nameusu as $value) {
                $_SESSION['Nombre']=$value['nombres']." ".$value['apellidos'];
              }
            break;
             case 2:
                header("location: Docente/index.php");
              break;
           case 3:
              header("location: Alumno/index.php");
            break;
             default: 
          }

         
  }
  else{
    
  }
 }
 else{
  header("location: login.php");
 }
?>
