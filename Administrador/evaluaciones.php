<!DOCTYPE html>
<html>

<head>
    <title>Evaluaciones</title>
</head>

<body>
    <div style="margin-bottom: 5px; margin-left:16px;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
        <button onclick="document.getElementById('id03').style.display='block'"
            class="btn btn-primary">Mantenimiento</button>
        <a target="blank" href="../pdf/Ad_evaluacionpdf.php" class="btn btn-danger">Reportes</a>
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
                    <span onclick="document.getElementById('id01').style.display='none'"
                        class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                    <p>Registrar Evaluaciones</p>
                </div>
                <form class="w3-container" method="post" action="mant_evaluaciones.php">
                    <div class="w3-section">
                        <label><b>Nombre de la Evaluación</b></label>
                        <input class="w3-input w3-border " type="text" placeholder="Escriba el nombre de la Evaluación"
                            name="nombre" required>
                        <label><b>Porcentaje</b></label>
                        <input class="w3-input w3-border" type="text"
                            placeholder="Escriba el porcentaje de la evaluación" name="porcentaje" required>
                        <label><b>Modulo</b></label>
                        <select name="modulo" id="" class="w3-input w3-border">
                            <?php
              require_once "../Clases/BD.php";
              $conn = new baseD();
              $consulta = $conn->busqueda("modulo");

              foreach ($consulta as $datos) {
                $id = $datos['idModulo'];
                $nombreModulo = $datos['nombreModulo'];
              ?>
                            <option value="<?php echo $id; ?>"><?php echo $nombreModulo; ?></option>
                            <?php
              }
              ?>

                        </select>
                        <input type="submit" class="w3-button w3-block w3-green w3-section w3-padding" value="Registrar"
                            name="send_insert">
                    </div>
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('id01').style.display='none'" type="button"
                        class="w3-button w3-red">Cancel</button>
                </div>
            </div>
        </div>

        <!--  Modal 3 -->
        <div id="id03" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id03').style.display='none'"
                        class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                    <p>Mantenimiento de Evaluaciones</p>
                </div>
                <form class="w3-container" method="post" action="mant_evaluaciones.php">
                    <div class="w3-section">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                $conn = new baseD();
                $consulta_evaluaciones = $conn->busquedaFree("SELECT
                `evaluaciones`.`idEvaluaciones`,
                `evaluaciones`.`nombreEvaluacion`,
                `evaluaciones`.`porcentaje`,
                `modulo`.`idModulo`
              FROM
                `dawproyecto`.`evaluaciones`
                INNER JOIN `dawproyecto`.`modulo`
                  ON (
                    `evaluaciones`.`idModulo` = `modulo`.`idModulo`
                  ) 
                  ;
              ");

                foreach ($consulta_evaluaciones as $datos) {
                  $id_del = $datos['idEvaluaciones'];
                  $nombre = $datos['nombreEvaluacion'];
                  $porcentaje = $datos['porcentaje'];
                ?>
                                <tr>
                                    <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                                    <td> <?php echo $nombre; ?></td>
                                    <td><?php echo $porcentaje; ?></td>
                                </tr>

                                <?php
                }
                ?>
                            </tbody>
                        </table>
                        <div style="text-align: center;">
                            <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="Actualizar"
                                name="send_update">
                            <input type="submit" class="w3-button w3-red w3-section w3-padding" value="Eliminar"
                                name="send_dl">
                        </div>
                    </div>
                </form>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('id03').style.display='none'" type="button"
                        class="w3-button w3-red">Cancel</button>
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
                            <th scope="col">Porcentaje</th>
                            <th scope="col">Modulo</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
            if (isset($_POST['send_busqueda'])) {
              $busqueda = $_POST['busqueda'];
              if ($busqueda != "") {
                $consulta2 = $conn->busquedaFree("SELECT
               `evaluaciones`.`idEvaluaciones`,
                `evaluaciones`.`nombreEvaluacion`,
                `evaluaciones`.`porcentaje`,
                `modulo`.`idModulo`
                FROM
                `dawproyecto`.`evaluaciones`
                INNER JOIN `dawproyecto`.`modulo`
                  ON (
                    `evaluaciones`.`idModulo` = `modulo`.`idModulo`
                  ) WHERE nombreEvaluacion LIKE '%$busqueda%' OR porcentaje = '$busqueda'");
              foreach ($consulta2 as $datos) {
                $id_del = $datos['idEvaluaciones'];
                $nombre = $datos['nombreEvaluacion'];
                $porcentaje = $datos['porcentaje'];
                $modulo =$datos['idModulo'];

                echo " <tr>
          <td>$nombre</td>
          <td>$porcentaje</td>
          <td>$modulo</td>";
          
          echo "</tr>";
              }
              }
            } else {
              $consulta2 = $conn->busquedaFree("SELECT
               `evaluaciones`.`idEvaluaciones`,
                `evaluaciones`.`nombreEvaluacion`,
                `evaluaciones`.`porcentaje`,
                `modulo`.`idModulo`
                FROM
                `dawproyecto`.`evaluaciones`
                INNER JOIN `dawproyecto`.`modulo`
                  ON (
                    `evaluaciones`.`idModulo` = `modulo`.`idModulo`
                  ) 
                  ;
              ");
              foreach ($consulta2 as $datos) {
                $id_del = $datos['idEvaluaciones'];
                $nombre = $datos['nombreEvaluacion'];
                $porcentaje = $datos['porcentaje'];
                $modulo = $datos['idModulo'];

                echo " <tr>
          <td>$nombre</td>
          <td>$porcentaje</td>
          <td>$modulo</td>";

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