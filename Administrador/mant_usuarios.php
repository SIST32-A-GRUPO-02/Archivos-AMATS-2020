<?php
require_once "../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.

if (isset($_POST['send_insert'])) {
  //Send_Insert respondera a la función de AGREGAR usuarios.
  //Leer todos los datos del formulario
  $usuario = $_POST['usuario'];
  $contra = $_POST['contraseña'];
  $rol = $_POST['tipo'];
  $participante = $_POST['participante'];
  $docente = $_POST['docente'];
  //If para saber si vienen datos de docente o participante
  if($rol != 1){
  //Inicio de consulta SQL, datos requerido por la función insetar(tabla,datos)
  $conn->insertar(
    "usuarios(usuario,contra,idRol,idParticipante)",
    "'$usuario','$contra','$rol','$participante'");
  }else{
  //Inicio de consulta SQL, datos requerido por la función insetar(tabla,datos)
  $conn->insertar("usuarios(usuario, contra, idRol, idDocente)",
    "'$usuario','$contra','$rol','$docente'");
  }
 
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro INGRESADO con exito");</script>';
  //Redirección a interfaz de MODULO(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=usuarios.php')</script>";
  //Fin de AGREGAR un Usuario
} elseif (isset($_POST['send_dl'])) {
  //Send_dl respondera a la función de ELIMINAR un USUARIO.
  //Obtener el ID del   modulo a Eliminar
  $id_del = $_POST['id_us'];
  //Inicio de consulta SQL, datos requerido por la función borrar(tabla,condicion)
  $conn->borrar("usuarios", "idUsuario = $id_del");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ELIMINADO con exito");</script>';
  //Redirección a interfaz de Usuario(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=usuarios.php')</script>";
  //Fin de ELIMINAR un MODULO
} elseif (isset($_POST['send_update'])) {
  //Send_dl respondera a la función de ACTUALIZAR un Usuario.
?>
<!-- Estilos del Modal -->
  <head>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  </head>
<!-- Fin de los estilos del Modal -->
<!-- Activar el MODAL al CARGAR el sitio completo -->
  <style>
    #id01 {
      display: block;
    }
  </style>
  <!-- Inicio de Modal de Actualizar -->
  <div class="w3-container">
    <div id="id01" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
        <div class="w3-center"><br>
          <a href="index.php?x=usuarios.php"> <span class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span></a>
          <p>Actualizar Usuarios</p>
        </div>
        <form class="w3-container" method="post" action="">
          <div class="w3-section">
            <?php
            //Inicio de Consulta filtrada para mostrar los datos de Usuarios a Actualizar
            $id_update = $_POST['id_us'];
            $parti ="";
            $doc="";
             //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
            $busqueda = $conn->busquedaFree("SELECT * FROM usuarios WHERE idUsuario = $id_update");
            foreach ($busqueda as $datos) {
              //Asignación de datos a la variables para mostrar los valores en los inputs
              $id = $datos['idUsuario'];
              $usuario = $datos['usuario'];
              $contraseña = $datos['contra'];
              $rol = $datos['idRol'];
              $participante = $datos['idParticipante'];
              $docente = $datos['idDocente'];
        
            ?>
            <!-- Llenado de los Valores(propiedad Value) de los Inputs -->
              <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
              <label><b>Nombre del Usuario</b></label>
              <input class="w3-input w3-border " type="text" Value="<?php echo $usuario; ?>" name="usuario" required>
              <label><b>Contraseña</b></label>
              <input class="w3-input w3-border" type="password" placeholder="ingrese su contraseña" name="contra" required>
              <label><b>Seleccione el Tipo (Docente o Alumno)</b></label>
             <select name="tipo" id="tipo" class="w3-input w3-border">
             <?php
             if ($rol == 1) {
                 echo ' <option value="1" selected=true>Alumno</option>
                        <option value="2">Docente</option>';
                        $parti= "block";
                        $doc="none";
             }else{
                echo ' <option value="1">Alumno</option>
                <option value="2" selected=true>Docente</option>';
                    $parti= "none";
                        $doc="block";    
             }
             ?>
             </select>
             <div id="participante" style="display:<?php echo $parti?>;">
             <label><b>Alumno</b></label> 
             <select name="participante" id="" class="w3-input w3-border">
                <?php
                //Consulta para llenar el SELECT de curso
                $consulta = $conn->busqueda("participante");

                foreach ($consulta as $datos) {
                  $id = $datos['idParticipante'];
                  $nombres = $datos['nombres'];
                  $apellidos = $datos['apellidos'];
                  if ($id == $participante) {
                    echo '<option value="' . $id . '" selected="true">'.$nombres." ".$apellidos.'</option>';
                  } else {
                    echo '<option value="' . $id . '">'.$nombres." ".$apellidos.'</option>';
                  }
                }
                ?>
              </select>
             </div>
             <div id="docente" style="display:<?php echo $doc?>;">
             <label><b>Docente</b></label>
             <select name="docente" id="" class="w3-input w3-border">
             <?php
                //Consulta para llenar el SELECT de curso
                $consulta = $conn->busqueda("docente");

                foreach ($consulta as $datos) {
                  $id = $datos['idDocente'];
                  $nombres = $datos['nombres'];
                  $apellidos = $datos['apellidos'];
                  if ($id == $docente) {
                    echo '<option value="' . $id . '" selected="true">'.$nombres." ".$apellidos.'</option>';
                  } else {
                    echo '<option value="' . $id . '">'.$nombres." ".$apellidos.'</option>';
                  }
                }
                ?>
             </select>
             </div>
            <?php
            //Cierre del Foreach
            }
            ?>

            <input type="submit" class="w3-button w3-block w3-blue w3-section w3-padding" value="Actualizar" name="send_update2">
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <a href="index.php?x=usuarios.php" class="w3-button w3-red">Cancel</a>
        </div>
      </div>
    </div>
    <!-- FIN del MODAL -->
    <script>
  $( function() {
    $("#tipo").change( function() {
        if ($(this).val() == 1) {
            $("#docente").hide();
            $("#participante").show();
        }else{
            $("#participante").hide();
            $("#docente").show();
        }
    });
});
</script>
  <?php

} elseif (isset($_POST['send_update2'])) {
  //Inicio del proceso de ACTUALIZAR en DB
  //Recibir datos del Formulario(En teoria viene nuevos datos en algun input)
  $id_update = $_POST['id_update'];
  $usuario = $_POST['usuario'];
  $contra = $_POST['contra'];
  $rol = $_POST['tipo'];
  $participante = $_POST['participante'];
  $docente = $_POST['docente'];
 
  if($docente == ""){
    //Inicio de consulta SQL, datos requerido por la función actualizar(tabla,datos,condicion)
    $consulta = $conn->actualizar("usuarios","usuario='$usuario',contra='$contra',idRol='$rol',idParticipante='$participante'","idUsuario='$id_update'");
    }else{
    //Inicio de consulta SQL, datos requerido por la función actualizar(tabla,datos,condicion)
    $consulta = $conn->actualizar("usuarios","usuario='$usuario',contra='$contra',idRol='$rol',idDocente='$docente'","idUsuario='$id_update'");
    }
  //Inicio de Consulta SQL, datos requeridos por la función actualizar(tabla,campos,condicion)
  //Mensaje de UPDATE a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
  //Redirección a interfaz de USUARIOS(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=usuarios.php')</script>";


}
 
  ?>