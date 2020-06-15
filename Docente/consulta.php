<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "dawproyecto";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM participante WHERE Name NOT LIKE '' ORDER By Id_no LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM participante WHERE Id_no LIKE '%$q%' OR Name LIKE '%$q%' OR ClubName LIKE '%$q%' OR Rtg_Nat LIKE '%$q%' OR Title LIKE '$q' ";
    }

    $resultado = $conn->query($query);

    if ($resultado==true) {
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>Nombre</td>
    					<td>Apellido</td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['nombres']."</td>
    					<td>".$fila['apellidos']."</td>

    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>