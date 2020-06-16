<!DOCTYPE html>
<html>

<head>
  <title>Convocatorias</title>
</head>

<body>
  <div style="margin-bottom: 5px; margin-left:16px;">
    <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
    <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-primary">Mantenimiento</button>
    <a target="blank" href="../pdf/Ad_convocatoriaspdf.php" class="btn btn-danger">Reportes</a>
    <div style="float: right; margin-right:40px;">
      <form action="" method="post">
        <input type="text" style="border-radius: 5px;" name="busqueda" required>
        <input type="submit" value="Buscar" class="btn btn-info" name="send_busqueda"></input>
      </form>
    </div>
  </div>
  <!-- Inicio Modal -->
  <div class="w3-container">
    <div id="id01" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
        <div class="w3-center"><br>
          <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
          <p>Registrar Convocatoria</p>
        </div>
        <form class="w3-container" method="post" action="mant_convocatorias.php">
          <div class="w3-section">
            <label><b>Nombre de la Convocatoria</b></label>
            <input class="w3-input w3-border " type="text" placeholder="Escriba el nombre de la Convocatoria" name="nombre" required>
            <label><b>Fecha de Inicio</b></label>
            <input class="w3-input w3-border" type="date" placeholder="Escriba la Fecha de Inicio" name="fechai" required>
            <label><b>Fecha de Finalización</b></label>
            <input class="w3-input w3-border" type="date" placeholder="Escriba la Fecha de finalización" name="fechaf" required>
            <label><b>Identificador</b></label>
            <input class="w3-input w3-border" type="text" placeholder="Ejemplo: SA OO1" name="identificador" required>
            <label><b>Responsable</b></label>
            <input class="w3-input w3-border" type="text" placeholder="Escriba el nombre del responsable" name="responsable" required>
            <label><b>Sede</b></label>
            <select name="sede" id="" class="w3-input w3-border">
              <?php
              require_once "../Clases/BD.php";
              $conn = new baseD();
              $consulta = $conn->busqueda("sede");

              foreach ($consulta as $datos) {
                $id = $datos['idSede'];
                $departamento = $datos['departamento'];
              ?>
                <option value="<?php echo $id; ?>"><?php echo $departamento; ?></option>
              <?php
              }
              ?>

            </select>
            <input type="submit" class="w3-button w3-block w3-green w3-section w3-padding" value="Registrar" name="send_insert">
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        </div>
      </div>
    </div>

    <!--  Modal 3 -->
    <div id="id03" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
        <div class="w3-center"><br>
          <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
          <p>Mantenimiento de Convocatoria</p>
        </div>
        <form class="w3-container" method="post" action="mant_convocatorias.php">
          <div class="w3-section">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Identificador</th>
                  <th scope="col">Responsable</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $conn = new baseD();
                $consulta_convocatorias = $conn->busquedaFree("SELECT
                `convocatoria`.`idConvocatoria`,
                `convocatoria`.`nombreConvocatoria`,
                `convocatoria`.`fechaInicio`,
                `convocatoria`.`fechaFin`,
                `convocatoria`.`identificador`,
                `convocatoria`.`responsable`,
                `sede`.`departamento`
              FROM
                `dawproyecto`.`convocatoria`
                INNER JOIN `dawproyecto`.`sede`
                  ON (
                    `convocatoria`.`idSede` = `sede`.`idSede`
                  ) 
                  ;
              ");

                foreach ($consulta_convocatorias as $datos) {
                  $id_del = $datos['idConvocatoria'];
                  $nombre = $datos['nombreConvocatoria'];
                  $identificador = $datos['identificador'];
                  $responsable = $datos['responsable'];
                ?>
                  <tr>
                    <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                    <td> <?php echo $nombre; ?></td>
                    <td><?php echo $identificador; ?></td>
                    <td><?php echo $responsable; ?></td>
                  </tr>

                <?php
                }
                ?>
              </tbody>
            </table>
            <div style="text-align: center;">
              <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="Actualizar" name="send_update">
              <input type="submit" class="w3-button w3-red w3-section w3-padding" value="Eliminar" name="send_dl">
            </div>
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <button onclick="document.getElementById('id03').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        </div>
      </div>
    </div>
    <!-- Fin Modal -->

    <!-- Data -->
    <div>
      <form action="" method="post">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Fecha de Inicio</th>
              <th scope="col">Fecha de Fin</th>
              <th scope="col">identificador</th>
              <th scope="col">Responsable</th>
              <th scope="col">Sede</th>
              <th scope="col">Estado</th>
            </tr>
          </thead>
          <tbody>

            <?php
            if (isset($_POST['send_busqueda'])) {
              $busqueda = $_POST['busqueda'];
              if($busqueda != "") {
                $consulta2 = $conn->busquedaFree("SELECT
                `convocatoria`.`idConvocatoria`,
                `convocatoria`.`nombreConvocatoria`,
                `convocatoria`.`fechaInicio`,
                `convocatoria`.`fechaFin`,
                `convocatoria`.`identificador`,
                `convocatoria`.`responsable`,
                `convocatoria`.`estado`,
                `sede`.`departamento`
FROM
  `dawproyecto`.`convocatoria`
  INNER JOIN `dawproyecto`.`sede`
    ON (
        `convocatoria`.`idSede` = `sede`.`idSede`)
        WHERE nombreConvocatoria LIKE '%$busqueda%' OR convocatoria.responsable LIKE '%$busqueda%'");
                foreach ($consulta2 as $datos) {
                  $id = $datos['idConvocatoria'];
                  $nombre = $datos['nombreConvocatoria'];
                  $fechai = $datos['fechaInicio'];
                  $fechaf = $datos['fechaFin'];
                  $identificador = $datos['identificador'];
                  $responsable = $datos['responsable'];
                  $estado = $datos['estado'];
                  $sede = $datos['departamento'];

                  echo " <tr>
          <td>$nombre</td>
          <td>$fechai</td>
          <td>$fechaf</td>
          <td>$identificador</td>
          <td>$responsable</td>
          <td>$sede</td>";
                  if ($estado == 0) {
                    echo "<td>Activa</td>";
                  } else {
                    echo "<td>Finalizada</td>";
                  }
                  echo "</tr>";
                }
              }
            } else {
              $consulta2 = $conn->busquedaFree("SELECT
                `convocatoria`.`idConvocatoria`,
                `convocatoria`.`nombreConvocatoria`,
                `convocatoria`.`fechaInicio`,
                `convocatoria`.`fechaFin`,
                `convocatoria`.`identificador`,
                `convocatoria`.`responsable`,
                `convocatoria`.`estado`,
                `sede`.`departamento`
FROM
  `dawproyecto`.`convocatoria`
  INNER JOIN `dawproyecto`.`sede`
    ON (
        `convocatoria`.`idSede` = `sede`.`idSede`)");
              foreach ($consulta2 as $datos) {
                $id = $datos['idConvocatoria'];
                $nombre = $datos['nombreConvocatoria'];
                $fechai = $datos['fechaInicio'];
                $fechaf = $datos['fechaFin'];
                $identificador = $datos['identificador'];
                $responsable = $datos['responsable'];
                $estado = $datos['estado'];
                $sede = $datos['departamento'];

                echo " <tr>
          <td>$nombre</td>
          <td>$fechai</td>
          <td>$fechaf</td>
          <td>$identificador</td>
          <td>$responsable</td>
          <td>$sede</td>";
                if ($estado == 0) {
                  echo "<td>Activa</td>";
                } else {
                  echo "<td>Finalizada</td>";
                }
                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
</body>
</html>