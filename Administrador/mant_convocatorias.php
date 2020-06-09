<?php
require_once "../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.

if (isset($_POST['send_insert'])) {
  //Send_Insert respondera a la función de AGREGAR una CONVOCATORIA.
  //Leer todos los datos del formulario
  $nombreConv = $_POST['nombre'];
  $identificador = $_POST['identificador'];
  $responsable = $_POST['responsable'];
  $sede = $_POST['sede'];
  /* $fechaNac = $_GET['fecha']; */
  //Arriba manera convencional DD/MM/AAAA, pero en mysql el formato date se ordena AAAA/MM/DD = (Y-m-d)
  $fechai = date('Y-m-d', strtotime($_POST['fechai']));
  $fechaf = date('Y-m-d', strtotime($_POST['fechaf']));
  //Inicio de consulta SQL, datos requerido por la función insetar(tabla,datos)
  $conn->insertar(
    "convocatoria(nombreConvocatoria, fechaInicio, idSede, fechaFin, identificador, responsable,estado)",
    "'$nombreConv','$fechai','$sede','$fechaf','$identificador','$responsable','0'");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro INGRESADO con exito");</script>';
  //Redirección a interfaz de CONVOCATORIA(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=convocatorias.php')</script>";
  //Fin de AGREGAR una CONVOCATORIA
} elseif (isset($_POST['send_dl'])) {
  //Send_dl respondera a la función de ELIMINAR una CONVOCATORIA.
  //Obtener el ID de la CONVOCATORIA a Eliminar
  $id_del = $_POST['id_us'];
  //Inicio de consulta SQL, datos requerido por la función borrar(tabla,condicion)
  $conn->borrar("convocatoria", "idConvocatoria = $id_del");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ELIMINADO con exito");</script>';
  //Redirección a interfaz de CONVOCATORIA(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=convocatorias.php')</script>";
  //Fin de ELIMINAR un Usuario
} elseif (isset($_POST['send_update'])) {
  //Send_dl respondera a la función de ACTUALIZAR una CONVOCATORIA.
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
          <a href="index.php?x=convocatorias.php"> <span class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span></a>
          <p>Actualizar Convocatoria</p>
        </div>
        <form class="w3-container" method="post" action="">
          <div class="w3-section">
            <?php
            //Inicio de Consulta filtrada para mostrar los datos de la CONVOCATORIA a Actualizar
            $id_update = $_POST['id_us'];
             //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
            $busqueda = $conn->busquedaFree("SELECT * FROM convocatoria WHERE idConvocatoria = $id_update");
            foreach ($busqueda as $datos) {
              //Asignación de datos a la variables para mostrar los valores en los inputs
              $id = $datos['idConvocatoria'];
              $nombre = $datos['nombreConvocatoria'];
              $identificador = $datos['identificador'];
              $responsable = $datos['responsable'];
              $sede = $datos['idSede'];
              $fechai = $datos['fechaInicio'];
              $fechaf = $datos['fechaFin'];

            ?>
            <!-- Llenado de los Valores(propiedad Value) de los Inputs -->
              <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
              <label><b>Nombre de la Convocatoria</b></label>
              <input class="w3-input w3-border " type="text" Value="<?php echo $nombre; ?>" name="nombre" required>
              <label><b>identificador</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $identificador; ?>" name="identificador" required>
              <label><b>Responsable</b></label>
             <input class="w3-input w3-border" type="text" Value="<?php echo $responsable; ?>" name="responsable" id="telp" required>
              <label><b>Estado</b></label>
              <select name="estado" id="" class="w3-input w3-border">
                <option value="0" selected><b>Activo</b></option>
                <option value="1"><b>Finalizado</b></option>
              </select>
              <label><b>sede</b></label>
              <select name="sede" id="" class="w3-input w3-border">
                <?php
                //Consulta para llenar el 
                $consulta = $conn->busqueda("sede");

                foreach ($consulta as $datos) {
                  $id = $datos['idSede'];
                  $nombre = $datos['departamento'];
                ?>
                  <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                <?php
                }
                ?>

              </select>
            <?php
            //Cierre del Foreach
            }
            ?>
            <label><b>Fecha de Inicio</b></label>
            <input class="w3-input w3-border" type="date" Value="<?php echo $fechai; ?>" name="fechai" required>
            <label><b>Fecha de Finalización</b></label>
            <input class="w3-input w3-border" type="date" Value="<?php echo $fechaf; ?>" name="fechaf" required>

            <input type="submit" class="w3-button w3-block w3-blue w3-section w3-padding" value="Actualizar" name="send_update2">
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <a href="index.php?x=convocatorias.php" class="w3-button w3-red">Cancel</a>
        </div>
      </div>
    </div>
    <!-- FIN del MODAL -->
  <?php

} elseif (isset($_POST['send_update2'])) {
  //Inicio del proceso de ACTUALIZAR en DB
  //Recibir datos del Formulario(En teoria viene nuevos datos en algun input)
  $id_update = $_POST['id_update'];
  $nombreConv = $_POST['nombre'];
  $identificador = $_POST['identificador'];
  $responsable = $_POST['responsable'];
  $sede = $_POST['sede'];
  $fechai = date('Y-m-d', strtotime($_POST['fechai']));
  $fechaf = date('Y-m-d', strtotime($_POST['fechaf']));
  $estado = $_POST['estado'];

  //Inicio de Consulta SQL, datos requeridos por la función actualizar(tabla,campos,condicion)
  $consulta = $conn->actualizar("convocatoria","nombreConvocatoria='$nombreConv',identificador='$identificador',responsable='$responsable',idSede='$sede',fechaInicio='$fechai',fechaFin='$fechaf',estado='$estado'","idConvocatoria='$id_update'");
  //Mensaje de UPDATE a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
  //Redirección a interfaz de CONVOCATORIAS(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=convocatorias.php')</script>";
 /*Inicia validacion para telefonos*/   

}
 
  ?>