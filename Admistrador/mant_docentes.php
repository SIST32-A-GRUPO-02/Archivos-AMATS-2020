<?php
require_once "../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.

if (isset($_POST['send_insert'])) {
  //Send_Insert respondera a la función de AGREGAR un Docente.
  echo '<script>alert("Entra");</script>';
  $nombreDo = $_POST['nombre'];
  $ApellidoDo = $_POST['apellido'];
  $dui = $_POST['dui'];
  $nit = $_POST['nit'];
  $especialidad = $_REQUEST['especialidad'];
  $direccion = $_POST['direccion'];
  $sexo = $_POST['sexo'];
  /* $fechaNac = $_GET['fecha']; */
  $fechaNac = date('Y-m-d', strtotime($_POST['fecha']));
  $conn->insertar(
    "docente( nombres, apellidos, fechaNacimiento, sexo, dui, nit, direccion, idEspecialidad)",
    "'$nombreDo','$ApellidoDo','$fechaNac','$sexo','$dui','$nit','$direccion','$especialidad'"
  );
  echo " <script>window.location.replace('./index.php?x=docentes.php')</script>";
  //Fin de AGREGAR un Docente
} elseif (isset($_POST['send_dl'])) {
  //Send_dl respondera a la función de ELIMINAR un Docente.
  echo '<script>alert("Entra");</script>';
  $id_del = $_POST['id_us'];
  $conn->borrar(
    "docente",
    "idDocente = $id_del"
  );
  echo " <script>window.location.replace('./index.php?x=docentes.php')</script>";
  //Fin de ELIMINAR un Usuario
} elseif (isset($_POST['send_update'])) {
  //Send_dl respondera a la función de ACTUALIZAR un Docente.
  ?>
<head>
 <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
  #id01{
    display: block;
  }
</style>
   <div class="w3-container">
     <div id="id01" class="w3-modal">
       <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
         <div class="w3-center"><br>
           <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
           <p>Actualizar Usuario</p>
         </div>
         <form class="w3-container" method="post" action="mant_docentes.php">
           <div class="w3-section">
             <label><b>Nombre</b></label>
             <input class="w3-input w3-border " type="text" placeholder="Escriba el Nombre" name="nombre" required>
             <label><b>Apellido</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba los Apellidos" name="apellido" required>
             <label><b>Telefono</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el Telefono" name="telefono" required>
             <label><b>Dirección</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el Telefono" name="direccion" required>
             <label><b>Sexo</b></label>
             <select name="sexo" id="" class="w3-input w3-border">
               <option value="Hombre"><b>Hombre</b></option>
               <option value="Mujer"><b>Mujer</b></option>
             </select>
             <label><b>Epecialidad</b></label>
             <select name="especialidad" id="" class="w3-input w3-border">
             </select>
             <label><b>DUI</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el número de DUI" name="dui" required>
             <label><b>NIT</b></label>
             <input class="w3-input w3-border" type="text" placeholder="Escriba el número de NIT" name="nit" required>
             <label><b>Fecha de Nacimiento</b></label>
             <input class="w3-input w3-border" type="date" placeholder="Escriba la Fecha de Nacimiento" name="fecha" required>
             <input type="submit" class="w3-button w3-block w3-blue w3-section w3-padding" value="Actualizar" name="send_insert">
           </div>
         </form>
         <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
           <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
         </div>
       </div>
     </div>
  <?php
  
}
?>
