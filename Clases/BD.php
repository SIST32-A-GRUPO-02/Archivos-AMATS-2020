<?php 
class baseD{
    private $host="localhost";
    private $usuario="root";
    private $clave="";
    private $bd="dawproyecto";
    public $conexion;

    public function __construct(){
        $this->conexion=new mysqli($this->host, $this->usuario, $this->clave, "dawproyecto") or die(mysql_error());
        $this->conexion->set_charset("utf8");
    }


    /////////////////////////////////////////
    /////La funcion para insertar a las tablas
    ////////////////////////////////////////
    public function insertar($tabla, $datos){
        $resultado = $this->conexion->query("INSERT INTO $tabla VALUES ($datos)") or die($this->conexion->error);
    if($resultado)
        return true;
    return false;
    }

    ////////////////////////////////////////
    /////La funcion para borrar en las tablas
    ////////////////////////////////////////
    public function borrar($tabla,$condicion){
        $resultado = $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die($this->conexion->error);
        return true;
    return false;   
    }

    //////////////////////////////////////////
    /////La funcion para actulizar a las tablas
    /////////////////////////////////////////

    public function actualizar($tabla, $campos, $condicion){
        $resultado = $this->conexion->query("UPDATE $tabla SET $campos WHERE $condicion") OR die($this->conexion->error);
        return true;
    return false;    
    }

    /////////////////////////////////////////////////////
    /////La funcion para buscar por condición a las tablas
    /////////////////////////////////////////////////////
    public function BusquedaCondicional($tabla, $condicion){
        $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
            return true;
        return false;  
    }
    /////////////////////////////////////////////
    /////La funcion para buscar en  una sola tabla
    /////////////////////////////////////////////
    public function busqueda($tabla){
        $resultado = $this->conexion->query("SELECT * FROM $tabla") or die($this->conexion->error);
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;  
    }
	
	 /////////////////////////////////////////////
    /////La funcion para buscar con parametros de sql
    /////////////////////////////////////////////
    public function busquedaFree($dato){
        $resultado = $this->conexion->query("$dato") or die($this->conexion->error);
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;  
    }


    public function comprobar_sesion($sesion){
        if($sesion==false){
            echo "<script type='text/javascript' charset='utf-8' async defer>alert('Primero debe iniciar sesión'),</script>";
            header("location: ../index.php");
        }
        return false;

}

}
?>