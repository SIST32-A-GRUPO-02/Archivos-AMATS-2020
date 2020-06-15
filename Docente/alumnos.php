<?php 
@session_start();
require_once "../Clases/BD.php";
$conn = new baseD();
/* if(isset($_SESSION['rol'])){
  $conn->comprobar_posicion($_SESSION['rol']);
}
else{
  header("location: index.php");
} */
?>
<!DOCTYPE html>
 <html>

 <head>
   <title>alumno</title>
 </head>
 <body>
   <h2>Alumnos</h2>
     <!-- Data -->
     <div>
     <a href="../pdf/D_alumnospdf.php" class="btn btn-danger">Reportes</a><br><br>
     <div id="datos"></div>
 <form action="" method="post">
          <table class="table">
            <thead class="thead-dark">
              <tr>
              <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Sexo</th>
                <th scope="col">Convocatoria</th>
              </tr>
            <tbody>

              <?php
                $consulta = $conn->busquedaFree("SELECT
                `participante`.`idParticipante`
                , `participante`.`nombres`
                , `participante`.`apellidos`
                , `participante`.`fechaNacimiento`
                , `participante`.`sexo`
                , `participante`.`dui`
                , `participante`.`nit`
                , `participante`.`direccion`
                , `convocatoria`.`nombreConvocatoria`
            FROM
                `dawproyecto`.`participante`
                INNER JOIN `dawproyecto`.`convocatoria` 
                    ON (`participante`.`idConvocatoria` = `convocatoria`.`idConvocatoria`);
  ");
                foreach ($consulta as $datos) {
                  $id = $datos['idParticipante'];
                  $nombre = $datos["nombres"];
                  $apellido = $datos['apellidos'];
                  $fecha = $datos['fechaNacimiento'];
                  $sexo = $datos['sexo'];
                  $dui = $datos['dui'];
                  $nit = $datos['nit'];
                  $direccion = $datos['direccion'];
                  $convocatoria = $datos['nombreConvocatoria'];
              
                  echo " <tr class='select'>
            <td>$id</td>
            <td>$nombre</td>
            <td>$apellido</td>
            <td>$fecha</td>
            <td>$sexo</td>
            <td>$convocatoria</td>
            </tr>";
                } 
                ?>
            </tbody>
        </form>
     </div>
 </body>
<script>
  $( function() {
    $("#telp").change( function() {
        if ($(this).val() !== "") {
            $("#telc").removeAttr("required");
        }else{
          $('#telc').prop("required", true);
        }
    });
    $("#telc").change( function() {
        if ($(this).val() !== "") {
            $("#telp").removeAttr("required");
        }else{
          $('#telp').prop("required", true);
        }
    });
});
</script>
<!-- <script>
$(buscar_datos());

function buscar_datos(consulta){
	$.ajax({
		url: 'consulta.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}


$(document).on('keyup','#caja_busqueda', function(){
	var valor = $(this).val();
	if (valor != "") {
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
});
</script> -->
 </html>
            