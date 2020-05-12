<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <h2>Notas</h2>
  
  <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
  <!-- Inicio Modal -->
  <div class="w3-container">
    <div id="id01" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
        <div class="w3-center"><br>
          <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
          <h3>Ingresar Notas</h3>
        </div>
        <form class="w3-container" method="get" action="insert.php">
          <div class="w3-section">
            <label><b>Nombre</b></label>
            <input class="w3-input w3-border " type="text" placeholder="Escriba el Nombre" name="nombre" required>
           
            <label><b>idParticipante</b></label>
            <select name="idParticipante" id="" class="w3-input w3-border">
              <?php
               require_once "../../Clases/BD.php";
               $conn = new baseD();
               $consulta = $conn->busqueda("modulo");
               foreach ($consulta as $datos) {
                 $id = $datos['idModulo'];
                 $nombre = $datos['nombreModulo'];
               ?>
                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
              <?php
               }
               ?>

            </select>
             <label><b>DUI</b></label>
            <input class="w3-input w3-border" type="text" placeholder="Escriba el número de DUI" name="dui" required>
            <label><b>NIT</b></label>
            <input class="w3-input w3-border" type="text" placeholder="Escriba el número de NIT" name="nit" required>
            <label><b>Fecha de Nacimiento</b></label>
            <input class="w3-input w3-border" type="date" placeholder="Escriba la Fecha de Nacimiento" name="fecha" required>
            <input type="submit" class="w3-button w3-block w3-green w3-section w3-padding" value="Registrar" name="send">
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        </div>
      </div>
    </div>
  
  </body>
</html>