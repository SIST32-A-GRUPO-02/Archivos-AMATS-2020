<?php
require_once "../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.

if (isset($_POST['send_insert'])) {
  //Send_Insert respondera a la función de AGREGAR un MODULO.
  //Leer todos los datos del formulario
  $nombreMod = $_POST['nombre'];
  $descripcionModulo = $_POST['descripcion'];
  $horasModulo = $_POST['horas'];
  $nombreDocente = $_POST['docente'];
  $nombreCurso = $_POST['curso'];
  
  //Inicio de consulta SQL, datos requerido por la función insetar(tabla,datos)
  $conn->insertar(
    "modulo(nombreModulo, descripcionModulo, horasModulo, idDocente, idCurso)",
    "'$nombreMod','$descripcionModulo','$horasModulo','$nombreDocente','$nombreCurso'");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro INGRESADO con exito");</script>';
  //Redirección a interfaz de MODULO(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=modulos.php')</script>";
  //Fin de AGREGAR una Evaluacion
} elseif (isset($_POST['send_dl'])) {
  //Send_dl respondera a la función de ELIMINAR un MODULO.
  //Obtener el ID del   modulo a Eliminar
  $id_del = $_POST['id_us'];
  //Inicio de consulta SQL, datos requerido por la función borrar(tabla,condicion)
  $conn->borrar("modulo", "idModulo = $id_del");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ELIMINADO con exito");</script>';
  //Redirección a interfaz de MODULO(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=modulos.php')</script>";
  //Fin de ELIMINAR un MODULO
} elseif (isset($_POST['send_update'])) {
  //Send_dl respondera a la función de ACTUALIZAR un MODULO.
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
          <a href="index.php?x=modulos.php"> <span class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span></a>
          <p>Actualizar modulos</p>
        </div>
        <form class="w3-container" method="post" action="">
          <div class="w3-section">
            <?php
            //Inicio de Consulta filtrada para mostrar los datos del MODULO a Actualizar
            $id_update = $_POST['id_us'];
             //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
            $busqueda = $conn->busquedaFree("SELECT * FROM modulo WHERE idModulo = $id_update");
            foreach ($busqueda as $datos) {
              //Asignación de datos a la variables para mostrar los valores en los inputs
              $id = $datos['idModulo'];
              $nombre = $datos['nombreModulo'];
              $descripcionModulo = $datos['descripcionModulo'];
              $horasModulo = $datos['horasModulo'];
              $nombreDocente = $datos['idDocente'];
              $nombreCurso = $datos['idCurso'];

            ?>
            <!-- Llenado de los Valores(propiedad Value) de los Inputs -->
              <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
              <label><b>Nombre del Modulo</b></label>
              <input class="w3-input w3-border " type="text" Value="<?php echo $nombre; ?>" name="nombre" required>
              <label><b>Descripción del Modulo</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $descripcionModulo; ?>" name="descripcion" required>
              <label><b>Horas</b></label>
             <input class="w3-input w3-border" type="text" Value="<?php echo $horasModulo; ?>" name="horas" required>
             <label><b>Docente</b></label>
             <select name="docente" id="" class="w3-input w3-border">
               <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("docente");

                foreach ($consulta as $datos) {
                  $id = $datos['idDocente'];
                  $nombreDocente = $datos['nombres'];
                ?>
                 <option value="<?php echo $id; ?>"><?php echo $nombreDocente; ?></option>
                
                 <?php
                }
                ?>
             </select>
                 <label><b>Curso</b></label> 
             <select name="curso" id="" class="w3-input w3-border">
             <?php
                require_once "../Clases/BD.php";
                $conn = new baseD();
                $consulta = $conn->busqueda("curso");

                foreach ($consulta as $datos) {
                  $id = $datos['idCurso'];
                  $nombreCurso = $datos['nombreCurso'];
                ?>
                 <option value="<?php echo $id; ?>"><?php echo $nombreCurso; ?></option>
               <?php
                }
                ?>

              </select>
            <?php
            //Cierre del Foreach
            }
            ?>

            <input type="submit" class="w3-button w3-block w3-blue w3-section w3-padding" value="Actualizar" name="send_update2">
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <a href="index.php?x=modulos.php" class="w3-button w3-red">Cancel</a>
        </div>
      </div>
    </div>
    <!-- FIN del MODAL -->
  <?php

} elseif (isset($_POST['send_update2'])) {
  //Inicio del proceso de ACTUALIZAR en DB
  //Recibir datos del Formulario(En teoria viene nuevos datos en algun input)
  $id_update = $_POST['id_update'];
  $nombreMod = $_POST['nombre'];
  $descripcionModulo = $_POST['descripcion'];
  $horasModulo = $_POST['horas'];
  $nombreDocente = $_POST['docente'];
  $nombreCurso = $_POST['curso'];


  //Inicio de Consulta SQL, datos requeridos por la función actualizar(tabla,campos,condicion)
  $consulta = $conn->actualizar("modulo","nombreModulo='$nombreMod',descripcionModulo='$descripcionModulo',horasModulo='$horasModulo',idDocente='$nombreDocente',idCurso='$nombreCurso'","idModulo='$id_update'");
  //Mensaje de UPDATE a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
  //Redirección a interfaz de MODULOS(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=modulos.php')</script>";


}
 
  ?>