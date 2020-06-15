<!DOCTYPE html>
<html>

<head>
    <title>Cursos</title>
</head>

<body>
    <h2>Especialidad</h2>
    <div style="margin-bottom: 5px; margin-left:16px;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
        <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-primary">Mantenimiento</button>
        <a href="../pdf/especialidadpdf.php" class="btn btn-danger">Reportes</a>
     <button onclick="document.getElementById('id03').style.display='block'" class="btn btn-info" >Buscar</a>
    </div>

    <!-- Inicio Modal -->
    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                    <p>Registrar Cursos</p>
                </div>
                <form class="w3-container" method="post" action="mant_especialidad.php">
                    <div class="w3-section">
                        <label><b>Nombre de la Especialidad</b></label>
                        <input class="w3-input w3-border " type="text" placeholder="Escriba el nombre de la Especialidad" name="nombre" required>
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
                    <p>Mantenimiento de Cursos</p>
                </div>
                <form class="w3-container" method="post" action="mant_especialidad.php">
                    <div class="w3-section">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Nombre de la Especialidad</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                              require_once "../Clases/BD.php";
                              $da = 1;
                              $conn = new baseD();
                              $consulta = $conn->busquedaFree("SELECT
      
                      `especialidad`.`idEspecialidad`,
                      `especialidad`.`nombreEspecialidad`
                      FROM  `dawproyecto`.`especialidad`;");
      
                              foreach ($consulta as $datos) {
      
                                  $id_del = $datos['idEspecialidad'];
                                  $nombre = $datos['nombreEspecialidad'];
                                ?>
                                    <tr>
                                        <td><input type='radio' value='<?php echo $id_del; ?>' name='id_us' required></td>
                                        <td> <?php echo $nombre; ?></td>
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
                            <th>#</th>
                            <th scope="col">Nombre de la Especialidad</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        require_once "../Clases/BD.php";
                        $da = 1;
                        $conn = new baseD();
                        $consulta = $conn->busquedaFree("SELECT

                `especialidad`.`idEspecialidad`,
                `especialidad`.`nombreEspecialidad`
                FROM  `dawproyecto`.`especialidad`;");

                        foreach ($consulta as $datos) {

                            $id = $datos['idEspecialidad'];
                            $nombre = $datos['nombreEspecialidad'];
                            echo " <tr class='select'>
                <td>$da</td>
                <td>$nombre</td>
               </tr>";
                            $da++;
                        }

                        ?>
                    </tbody>
            </form>
        </div>
</body>

</html>