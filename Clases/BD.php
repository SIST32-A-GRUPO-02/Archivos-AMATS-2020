<?php 
class baseD{
    private $host="localhost";
    private $usuario="root";
    private $clave="";
    private $bd="dawproyecto";
    public $conexion;

    public function __construct(){
        $this->conexion=new mysqli($this->host, $this->usuario, $this->clave, "dawproyecto");
        $this->conexion->set_charset("utf8");
    }
    ///////////////////////////////////////////
    /////La funcion para insertar a las tablas
    //////////////////////////////////////////
    public function insertar($tabla, $datos){
        $resultado = $this->conexion->query("INSERT INTO $tabla VALUES ($datos)") or die($this->conexion->error);
    if($resultado)
        return true;
    return false;
    }

    /////////////////////////////////////////
    /////La funcion para borrar en las tablas
    /////////////////////////////////////////
    public function borrar($tabla,$condicion){
        $resultado = $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die($this->conexion->error);
        return true;
  
    }

    ////////////////////////////////////////////
    /////La funcion para actulizar a las tablas
    ///////////////////////////////////////////

    public function actualizar($tabla, $campos, $condicion){
        $resultado = $this->conexion->query("UPDATE $tabla SET $campos WHERE $condicion") OR die($this->conexion->error);
        return true;
    
    }

    //////////////////////////////////////////////////////
    /////La funcion para buscar por condición a las tablas
    //////////////////////////////////////////////////////
    public function BusquedaCondicional($tabla, $condicion){
        $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
            return true;
      
    }
    /////////////////////////////////////////////
    /////La funcion para buscar en  una sola tabla
    /////////////////////////////////////////////
    public function busqueda($tabla){
        $resultado = $this->conexion->query("SELECT * FROM $tabla") or die($this->conexion->error);
            return $resultado->fetch_all(MYSQLI_ASSOC);
        
    }
	
	 /////////////////////////////////////////////
    /////La funcion para buscar con parametros de sql
    /////////////////////////////////////////////
    public function busquedaFree($dato){
        $resultado = $this->conexion->query("$dato") or die($this->conexion->error);
            return $resultado->fetch_all(MYSQLI_ASSOC);
       
    }


    public function comprobar_sesion($sesion, $posicion){
      if($sesion==true){
        switch ($sesion) {
            case 1:
               if($posicion!="/Proyectos/Archivos-AMATS-2020/Administrador/index.php"){
                header("location: ../index.php");
               }
             break;
              case 2:
               if($posicion!="/Proyectos/Archivos-AMATS-2020/Docente/index.php"){
                header("location: ../index.php");
               }
               break;
            case 3:
               if($posicion!="/Proyectos/Archivos-AMATS-2020/Alumno/index.php"){
                header("location: ../index.php");
               }
             break;
           }
      }
      else{
          header("location: ../index.php");
      }
      return false;
    }

 

	/**
	 * 
	 * @return mixed
	 */
	function getUsuario() {
		return $this->usuario;
	}
}
?>