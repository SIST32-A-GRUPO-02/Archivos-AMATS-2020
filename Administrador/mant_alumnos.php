<?php
require_once "../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.

if (isset($_POST['send_insert'])) {
  //Send_Insert respondera a la función de AGREGAR un PARTICIPANTE.
  //Leer todos los datos del formulario
  $nombreAlum = $_POST['nombre'];
  $ApellidoAlum = $_POST['apellido'];
  $dui = $_POST['dui'];
  $nit = $_POST['nit'];
  $convocatoria = $_REQUEST['convocatoria'];
  $direccion = $_POST['direccion'];
  $sexo = $_POST['sexo'];
  $telefono_personal = $_POST['telefono_personal'];
  $telefono_fijo = $_POST['telefono_fijo'];
  /* $fechaNac = $_GET['fecha']; */
  //Arriba manera convencional DD/MM/AAAA, pero en mysql el formato date se ordena AAAA/MM/DD = (Y-m-d)
  $fechaNac = date('Y-m-d', strtotime($_POST['fecha']));
  //Inicio de consulta SQL, datos requerido por la función insetar(tabla,datos)
  $conn->insertar(
    "participante( nombres, apellidos, fechaNacimiento, sexo, dui, nit, direccion, idConvocatoria)",
    "'$nombreAlum','$ApellidoAlum','$fechaNac','$sexo','$dui','$nit','$direccion','$convocatoria'"
  );
  /*Inicia validacion para telefonos*/
  $consulta_alumnos = $conn->busqueda("participante");

  foreach ($consulta_alumnos as $datos) {
    $id = $datos['idParticipante'];
  }
    $id_participante = $id;
    
  if ($telefono_fijo == "" ) {
      $conn->insertar("telefonoparticipante(numeroTelefono,idTelefono,idParticipante)",
      "'$telefono_personal',2,$id_participante");
  }elseif($telefono_personal == "" ){
    $conn->insertar("telefonoparticipante(numeroTelefono,idTelefono,idParticipante)",
    "'$telefono_fijo',1,$id_participante");
  }else{
    $conn->insertar("telefonoparticipante(numeroTelefono,idTelefono,idParticipante)",
    "'$telefono_fijo',1,$id_participante");
    $conn->insertar("telefonoparticipante(numeroTelefono,idTelefono,idParticipante)",
    "'$telefono_personal',2,$id_participante");
  }
  /*finaliza validacion para telefonos*/
  
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro INGRESADO con exito");</script>';
  //Redirección a interfaz de PARTICIPANTES(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=alumnos.php')</script>";
  //Fin de AGREGAR un Participante
} elseif (isset($_POST['send_dl'])) {
  //Send_dl respondera a la función de ELIMINAR un Participante.
  //Obtener el ID del PARTICIPANTE a Eliminar
  $id_del = $_POST['id_us'];
  //Inicio de consulta SQL, datos requerido por la función borrar(tabla,condicion)
  $conn->borrar("participante", "idParticipante = $id_del");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ELIMINADO con exito");</script>';
  //Redirección a interfaz de PARTICIPANTES(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=alumnos.php')</script>";
  //Fin de ELIMINAR un Usuario
} elseif (isset($_POST['send_update'])) {
  //Send_dl respondera a la función de ACTUALIZAR un Participante.
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
          <a href="index.php?x=alumnos.php"> <span class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span></a>
          <p>Actualizar Usuario</p>
        </div>
        <form class="w3-container" method="post" action="">
          <div class="w3-section">
            <?php
            //Inicio de Consulta filtrada para mostrar los datos del PARTICIPANTE a Actualizar
            $id_update = $_POST['id_us'];
             //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
            $busqueda = $conn->busquedaFree("SELECT * FROM participante WHERE idParticipante = $id_update");
            foreach ($busqueda as $datos) {
              //Asignación de datos a la variables para mostrar los valores en los inputs
              $id = $datos['idParticipante'];
              $nombre = $datos['nombres'];
              $apellidos = $datos['apellidos'];
              $direccion = $datos['direccion'];
              $dui = $datos['dui'];
              $nit = $datos['nit'];
              $fecha = $datos['fechaNacimiento'];

            ?>
            <!-- Llenado de los Valores(propiedad Value) de los Inputs -->
              <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
              <label><b>Nombre</b></label>
              <input class="w3-input w3-border " type="text" Value="<?php echo $nombre; ?>" name="nombre" required>
              <label><b>Apellido</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $apellidos; ?>" name="apellido" required>
              <label><b>Telefono celular</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el Telefono" name="telefono_personal" id="telp" required>
             <label><b>Telefono fijo</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el Telefono" name="telefono_fijo" id="telc" required>
              <label><b>Dirección</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $direccion; ?>" name="direccion" required>
              <label><b>Sexo</b></label>
              <select name="sexo" id="" class="w3-input w3-border">
                <option value="Hombre"><b>Hombre</b></option>
                <option value="Mujer"><b>Mujer</b></option>
              </select>
              <label><b>convocatoria</b></label>
              <select name="convocatoria" id="" class="w3-input w3-border">
                <?php
                //Consulta para llenar el SELECT de especialidad
                $consulta = $conn->busqueda("convocatoria");

                foreach ($consulta as $datos) {
                  $id = $datos['idConvocatoria'];
                  $nombre = $datos['nombreConvocatoria'];
                ?>
                  <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                <?php
                }
                ?>

              </select>
              <label><b>DUI</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $dui; ?>" name="dui" required>
              <label><b>NIT</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $nit; ?>" name="nit" required>
              <label><b>Fecha de Nacimiento</b></label>
            <?php
            //Cierre del Foreach
            }
            ?>
            <input class="w3-input w3-border" type="date" Value="<?php echo $fecha; ?>" name="fecha" required>
            <input type="submit" class="w3-button w3-block w3-blue w3-section w3-padding" value="Actualizar" name="send_update2">
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <a href="index.php?x=alumnos.php" class="w3-button w3-red">Cancel</a>
        </div>
      </div>
    </div>
    <script>
  $( function() {
    $("#telp").change( function() {
        if ($(this).val() !== "") {
            $("#telc").removeAttr("required");
        }else{
          $('#telc').prop("required", true);
        }
    });
    $("#telc").change( function() {
        if ($(this).val() !== "") {
            $("#telp").removeAttr("required");
        }else{
          $('#telp').prop("required", true);
        }
    });
});
</script>
    <!-- FIN del MODAL -->
  <?php

} elseif (isset($_POST['send_update2'])) {
  //Inicio del proceso de ACTUALIZAR en DB
  //Recibir datos del Formulario(En teoria viene nuevos datos en algun input)
  $id_update = $_POST['id_update'];
  $nombreAlum = $_POST['nombre'];
  $apellidoAlum = $_POST['apellido'];
  $dui = $_POST['dui'];
  $nit = $_POST['nit'];
  $convocatoria = $_REQUEST['convocatoria'];
  $direccion = $_POST['direccion'];
  $sexo = $_POST['sexo'];
  $telefono_personal = $_POST['telefono_personal'];
  $telefono_fijo = $_POST['telefono_fijo'];
  /* $fechaNac = $_GET['fecha']; */
  //Arriba manera convencional DD/MM/AAAA, pero en mysql el formato date se ordena AAAA/MM/DD = (Y-m-d)
  $fechaNac = date('Y-m-d', strtotime($_POST['fecha']));
  //Inicio de Consulta SQL, datos requeridos por la función actualizar(tabla,campos,condicion)
  $consulta = $conn->actualizar("participante", "nombres='$nombreAlum',apellidos='$apellidoAlum',fechaNacimiento='$fechaNac',sexo='$sexo',dui='$dui',nit='$nit',direccion='$direccion',idConvocatoria=$convocatoria", "idParticipante=$id_update");
  //Mensaje de UPDATE a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
  //Redirección a interfaz de PARTYICIPANTES(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=alumnos.php')</script>";
 /*Inicia validacion para telefonos*/   
 if ($telefono_fijo == "" ) {
    //Inicio de Consulta SQL, datos requeridos por la función actualizar(tabla,campos,condicion)
    $consulta = $conn->actualizar("telefonoparticipante","numeroTelefono='$telefono_personal'","idParticipante=$id_update And idTelefono = 2");
    }elseif($telefono_personal == "" ){
      $conn-> $conn->actualizar("telefonoparticipante","numeroTelefono='$telefono_fijo'","idParticipante=$id_update And idTelefono = 1");
    }else{
      $consulta = $conn->actualizar("telefonoparticipante","numeroTelefono='$telefono_fijo'","idParticipante=$id_update And idTelefono = 1");
      $consulta = $conn->actualizar("telefonoparticipante","numeroTelefono='$telefono_personal'","idParticipante=$id_update And idTelefono = 2");
    }
    /*finaliza validacion para telefonos*/
}
 
  ?>