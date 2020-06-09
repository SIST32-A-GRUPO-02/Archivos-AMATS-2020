<?php
require_once "../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.

if (isset($_POST['send_insert'])) {
  //Send_Insert respondera a la función de AGREGAR una NOTA.
  //Leer todos los datos del formulario
  $nota = $_POST['nota'];
  $nombreModulo = $_POST['modulo'];
  $nombreEvaluacion = $_POST['evaluacion'];
  $participante = $_POST['participante'];

  $consulta_notas = $conn->busquedaFree("SELECT * FROM participantecurso 
  INNER JOIN participante ON participantecurso.idParticipante = participante.idParticipante 
  WHERE participante.nombres = '$participante'");
    foreach ($consulta_notas as $datos) {
      $id = $datos['idParticipanteCurso'];
    }
  //Inicio de consulta SQL, datos requerido por la función insetar(tabla,datos)
  $conn->insertar(
    "nota(nota, idModulo, idEvaluaciones, idParticipanteCurso)",
    "'$nota','$nombreModulo','$nombreEvaluacion','$id'");
    
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro INGRESADO con exito");</script>';
  //Redirección a interfaz de NOTAS(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=notas.php')</script>";
  //Fin de AGREGAR NOTAS
} elseif (isset($_POST['send_dl'])) {
  //Send_dl respondera a la función de ELIMINAR NOTAS.
  //Obtener el ID de la NOTA a Eliminar
  $id_del = $_POST['id_us'];
  //Inicio de consulta SQL, datos requerido por la función borrar(tabla,condicion)
  $conn->borrar("nota", "idNota = $id_del");
  //Mensaje de INGRESO a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ELIMINADO con exito");</script>';
  //Redirección a interfaz de NOTA(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=notas.php')</script>";
  //Fin de ELIMINAR NOTAS
} elseif (isset($_POST['send_update'])) {
  //Send_dl respondera a la función de ACTUALIZAR notas.
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
          <a href="index.php?x=notas.php"> <span class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span></a>
          <p>Actualizar Notas</p>
        </div>
        <form class="w3-container" method="post" action="">
          <div class="w3-section">
            <?php
            //Inicio de Consulta filtrada para mostrar los datos de NOTAS a Actualizar
            $id_update = $_POST['id_us'];
             //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
            $busqueda = $conn->busquedaFree("SELECT * FROM nota WHERE idNota = $id_update");
            foreach ($busqueda as $datos) {
              //Asignación de datos a la variables para mostrar los valores en los inputs
              $id = $datos['idNota'];
              $nota = $datos['nota'];
              $idModulo = $datos['idModulo'];
              $idEvaluacion = $datos['idEvaluaciones'];
              $idParticipante = $datos['idParticipanteCurso'];
            
            ?>
            <!-- Llenado de los Valores(propiedad Value) de los Inputs -->
            <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
              <label><b>Notas</b></label>
             <input class="w3-input w3-border" type="text" Value="<?php echo $nota; ?>" name="nota" required>
             <label><b>Modulo</b></label>
             <select name="modulo" id="" class="w3-input w3-border">
               <?php
                $consulta = $conn->busqueda("modulo");

                foreach ($consulta as $datos) {
                  $id = $datos['idModulo'];
                  $nombreModulo = $datos['nombreModulo'];

                  if ($id == $idModulo) {
                    echo '<option value="' . $id . '" selected="true">' . $nombreModulo . '</option>';
                  } else {
                    echo '<option value="' . $id . '">' . $nombreModulo . '</option>';
                  }
               
                }
                ?>
             </select>
             <label><b>Evaluación</b></label>
             <select name="evaluacion" id="" class="w3-input w3-border">
             <?php
                $consulta = $conn->busqueda("evaluaciones");
                foreach ($consulta as $datos) {
                  $id = $datos['idEvaluaciones'];
                  $nombreEvaluacion = $datos['nombreEvaluacion'];

                  if ($id == $idEvaluacion) {
                    echo '<option value="' . $id . '" selected="true">' . $nombreEvaluacion . '</option>';
                  } else {
                    echo '<option value="' . $id . '">' . $nombreEvaluacion . '</option>';
                  }
                }
                ?>
             </select>
             <label><b>Participante</b></label> 
             <select name="participante" id="" class="w3-input w3-border">
             <?php
                 $consulta = $conn->busquedaFree("SELECT participante.idparticipante,nombres,apellidos  FROM participantecurso INNER JOIN participante ON participantecurso.idParticipante = participante.idParticipante");
                 foreach ($consulta as $datos) {
                   $id = $datos['idparticipante'];
                   $nombre = $datos['nombres'];
                   $apellidos = $datos['apellidos'];
                     echo '<option value="' . $id . '">' . $nombre ." ".  $apellidos .  '</option>';
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
          <a href="index.php?x=notas.php" class="w3-button w3-red">Cancel</a>
        </div>
      </div>
    </div>
    <!-- FIN del MODAL -->
  <?php

} elseif (isset($_POST['send_update2'])) {
  //Inicio del proceso de ACTUALIZAR en DB
  //Recibir datos del Formulario(En teoria viene nuevos datos en algun input)
  $id_update = $_POST['id_update'];
  $nota = $_POST['nota'];
  $nombreModulo = $_POST['modulo'];
  $nombreEvaluacion = $_POST['evaluacion'];
  $par = $_POST['participante'];

  $consulta_notas = $conn->busquedaFree("SELECT idParticipanteCurso FROM participantecurso 
  INNER JOIN participante ON participantecurso.idParticipante = participante.idParticipante 
  WHERE participante.idParticipante = '$par'");
    foreach ($consulta_notas as $datos) {
      $idcurso = $datos['idParticipanteCurso'];
    }

  //Inicio de Consulta SQL, datos requeridos por la función actualizar(tabla,campos,condicion)
  $consulta = $conn->actualizar("nota","nota='$nota',idModulo='$nombreModulo',idEvaluaciones='$nombreEvaluacion',idParticipanteCurso='$idcurso'","idNota=$id_update");
  //Mensaje de UPDATE a DB(No valida si la consulta fue exitosa)
  echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
  //Redirección a interfaz de MODULOS(NO usar header de PHP, ya que da problemas de CORS(Cabeceras) en HOSTING) 
  echo " <script>window.location.replace('./index.php?x=notas.php')</script>";


}
 
  ?>