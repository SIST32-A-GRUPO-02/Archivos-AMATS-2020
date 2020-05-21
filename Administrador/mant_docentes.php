<?php
require_once "../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.

if (isset($_POST['send_insert'])) {
  //Send_Insert respondera a la función de AGREGAR un Docente.
  //Leer todos los datos del formulario
  $nombreDo = $_POST['nombre'];
  $ApellidoDo = $_POST['apellido'];
  $dui = $_POST['dui'];
  $nit = $_POST['nit'];
  $especialidad = $_REQUEST['especialidad'];
  $direccion = $_POST['direccion'];
  $sexo = $_POST['sexo'];
  /* $fechaNac = $_GET['fecha']; */
  //Arriba manera convencional DD/MM/AAAA, pero en mysql el formato date se ordena AAAA/MM/DD = (Y-m-d)
  $fechaNac = date('Y-m-d', strtotime($_POST['fecha']));
  //Inicio de consulta SQL, datos requerido por la función insetar(tabla,datos)
  $conn->insertar(
    "docente( nombres, apellidos, fechaNacimiento, sexo, dui, nit, direccion, idEspecialidad)",
    "'$nombreDo','$ApellidoDo','$fechaNac','$sexo','$dui','$nit','$direccion','$especialidad'"
  );
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro INGRESADO con exito");</script>';
  //Redirección a interfaz de DOCENTES(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=docentes.php')</script>";
  //Fin de AGREGAR un Docente
} elseif (isset($_POST['send_dl'])) {
  //Send_dl respondera a la función de ELIMINAR un Docente.
  //Obtener el ID del DOCENTE a Eliminar
  $id_del = $_POST['id_us'];
  //Inicio de consulta SQL, datos requerido por la función borrar(tabla,condicion)
  $conn->borrar("docente", "idDocente = $id_del");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ELIMINADO con exito");</script>';
  //Redirección a interfaz de DOCENTES(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=docentes.php')</script>";
  //Fin de ELIMINAR un Usuario
} elseif (isset($_POST['send_update'])) {
  //Send_dl respondera a la función de ACTUALIZAR un Docente.
?>
<!-- Estilos del Modal -->
  <head>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
          <a href="index.php?x=docentes.php"> <span class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span></a>
          <p>Actualizar Usuario</p>
        </div>
        <form class="w3-container" method="post" action="">
          <div class="w3-section">
            <?php
            //Inicio de Consulta filtrada para mostrar los datos del DOCENTE a Actualizar
            $id_update = $_POST['id_us'];
             //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
            $busqueda = $conn->busquedaFree("SELECT * FROM docente WHERE idDocente = $id_update");
            foreach ($busqueda as $datos) {
              //Asignación de datos a la variables para mostrar los valores en los inputs
              $id = $datos['idDocente'];
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
              <label><b>Telefono</b></label>
              <input class="w3-input w3-border" type="text" placeholder="Escriba el Telefono" name="telefono" required>
              <label><b>Dirección</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $direccion; ?>" name="direccion" required>
              <label><b>Sexo</b></label>
              <select name="sexo" id="" class="w3-input w3-border">
                <option value="Hombre"><b>Hombre</b></option>
                <option value="Mujer"><b>Mujer</b></option>
              </select>
              <label><b>Epecialidad</b></label>
              <select name="especialidad" id="" class="w3-input w3-border">
                <?php
                //Consulta para llenar el SELECT de especialidad
                $consulta = $conn->busqueda("especialidad");

                foreach ($consulta as $datos) {
                  $id = $datos['idEspecialidad'];
                  $nombre = $datos['nombreEspecialidad'];
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
          <a href="index.php?x=docentes.php" class="w3-button w3-red">Cancel</a>
        </div>
      </div>
    </div>
    <!-- FIN del MODAL -->
  <?php

} elseif (isset($_POST['send_update2'])) {
  //Inicio del proceso de ACTUALIZAR en DB
  //Recibir datos del Formulario(En teoria viene nuevos datos en algun input)
  $id_update = $_POST['id_update'];
  $nombreDo = $_POST['nombre'];
  $apellidoDo = $_POST['apellido'];
  $dui = $_POST['dui'];
  $nit = $_POST['nit'];
  $especialidad = $_REQUEST['especialidad'];
  $direccion = $_POST['direccion'];
  $sexo = $_POST['sexo'];
  /* $fechaNac = $_GET['fecha']; */
  //Arriba manera convencional DD/MM/AAAA, pero en mysql el formato date se ordena AAAA/MM/DD = (Y-m-d)
  $fechaNac = date('Y-m-d', strtotime($_POST['fecha']));
  //Inicio de Consulta SQL, datos requeridos por la función actualizar(tabla,campos,condicion)
  $consulta = $conn->actualizar("docente", "nombres='$nombreDo',apellidos='$apellidoDo',fechaNacimiento='$fechaNac',sexo='$sexo',dui='$dui',nit='$nit',direccion='$direccion',idEspecialidad=$especialidad", "idDocente=$id_update");
  //Mensaje de UPDATE a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
  //Redirección a interfaz de DOCENTES(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=docentes.php')</script>";
}
  ?>