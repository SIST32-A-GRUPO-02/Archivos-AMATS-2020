<!DOCTYPE html>
<html>

<head>
    <title>Modulos</title>
</head>

<body>
    <div style="margin-bottom: 5px; margin-left:16px;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
        <button onclick="document.getElementById('id03').style.display='block'"
            class="btn btn-primary">Mantenimiento</button>
        <a target="blank" href="../pdf/Ad_modulospdf.php" class="btn btn-danger">Reportes</a>
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
                    <p>Registrar Modulos</p>
                </div>
                <form class="w3-container" method="post" action="mant_modulos.php">
                    <div class="w3-section">
                        <label><b>Nombre del Módulo</b></label>
                        <input class="w3-input w3-border " type="text" placeholder="Escriba el nombre del módulo"
                            name="nombre" required>
                        <label><b>Descripción del módulo</b></label>
                        <input class="w3-input w3-border" type="text" placeholder="Escriba una descripción del módulo"
                            name="descripcion" required>
                        <label><b>Horas del modulo</b></label>
                        <input class="w3-input w3-border" type="number" min="1"
                            placeholder="Escriba la duración en horas del módulo" name="horas" required>
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
                    <p>Mantenimiento de Módulos</p>
                </div>
                <form class="w3-container" method="post" action="mant_modulos.php">
                    <div class="w3-section">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Horas</th>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Curso</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                $conn = new baseD();
                $consulta_modulos = $conn->busquedaFree("SELECT
                `modulo`.`idModulo`,
                `modulo`.`nombreModulo`,
                `modulo`.`descripcionModulo`,
                `modulo`.`horasModulo`,
                `docente`.`nombres`,
                `curso`.`nombreCurso`

              FROM
                `dawproyecto`.`modulo`
                INNER JOIN `dawproyecto`.`docente`
                  ON (
                    `modulo`.`idDocente` = `docente`.`idDocente`
                  ) 
                  INNER JOIN `dawproyecto`.`curso`
                  ON (
                    `modulo`.`idCurso` = `curso`.`idCurso`
                  ) 
                  ;
              ");

                foreach ($consulta_modulos as $datos) {
                  $id_del = $datos['idModulo'];
                  $nombre = $datos['nombreModulo'];
                  $descripcionModulo = $datos['descripcionModulo'];
                  $horasModulo = $datos['horasModulo'];
                  $nombreDocente = $datos['nombres'];
                  $nombreCurso = $datos['nombreCurso'];


                ?>
                                <tr>
                                    <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                                    <td> <?php echo $nombre; ?></td>
                                    <td><?php echo $descripcionModulo; ?></td>
                                    <td><?php echo $horasModulo; ?></td>
                                    <td><?php echo $nombreDocente; ?></td>
                                    <td><?php echo $nombreCurso; ?></td>

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
                            <th scope="col">Descripción</th>
                            <th scope="col">Horas</th>
                            <th scope="col">Docente</th>
                            <th scope="col">Curso</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
               if (isset($_POST['send_busqueda'])) {
                $busqueda = $_POST['busqueda'];
                if ($busqueda != "") {
                  $consulta2 = $conn->busquedaFree("SELECT
               `modulo`.`idModulo`,
                `modulo`.`nombreModulo`,
                `modulo`.`descripcionModulo`,
                `modulo`.`horasModulo`,
                `docente`.`nombres`,
                `curso`.`nombreCurso`
                FROM
                `dawproyecto`.`modulo`
                INNER JOIN `dawproyecto`.`docente`
                  ON (
                    `modulo`.`idDocente` = `docente`.`idDocente`
                  ) 
                  INNER JOIN `dawproyecto`.`curso`
                  ON (
                    `modulo`.`idCurso` = `curso`.`idCurso`
                  ) 
                  WHERE nombreModulo LIKE '%$busqueda%'
              ");
            foreach ($consulta2 as $datos) {
              $id_del = $datos['idModulo'];
              $nombre = $datos['nombreModulo'];
              $descripcionModulo = $datos['descripcionModulo'];
              $horasModulo = $datos['horasModulo'];
              $nombreDocente = $datos['nombres'];
              $nombreCurso = $datos['nombreCurso'];

                echo " <tr>
            <td>$nombre</td>
            <td>$descripcionModulo</td>
            <td>$horasModulo</td>
            <td>$nombreDocente</td>
            <td>$nombreCurso</td>";
             echo "</tr>";
            }
                }
              }else{
            $consulta2 = $conn->busquedaFree("SELECT
               `modulo`.`idModulo`,
                `modulo`.`nombreModulo`,
                `modulo`.`descripcionModulo`,
                `modulo`.`horasModulo`,
                `docente`.`nombres`,
                `curso`.`nombreCurso`
                FROM
                `dawproyecto`.`modulo`
                INNER JOIN `dawproyecto`.`docente`
                  ON (
                    `modulo`.`idDocente` = `docente`.`idDocente`
                  ) 
                  INNER JOIN `dawproyecto`.`curso`
                  ON (
                    `modulo`.`idCurso` = `curso`.`idCurso`
                  ) 
                  ;
              ");
            foreach ($consulta2 as $datos) {
              $id_del = $datos['idModulo'];
              $nombre = $datos['nombreModulo'];
              $descripcionModulo = $datos['descripcionModulo'];
              $horasModulo = $datos['horasModulo'];
              $nombreDocente = $datos['nombres'];
              $nombreCurso = $datos['nombreCurso'];

                echo " <tr>
            <td>$nombre</td>
            <td>$descripcionModulo</td>
            <td>$horasModulo</td>
            <td>$nombreDocente</td>
            <td>$nombreCurso</td>";
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