<!doctype html>
<html lang="en">
  <head>
  	<title>Inicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo  mb-5" style="background-image: url(../../images/engranajes.png);"></a>
          
          <ul class="list-unstyled components mb-5">
            <li>
              <a href="#">Inicio</a>
          </li>
	          <li class="active">
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Participantes</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="?x=AlumnosAd.php">Alumnos</a>
                </li>
                <li>
                    <a href="#">Notas</a>
                </li>
	            </ul>
	          </li>
	          <li class="active">
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Docentes</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Módulos</a>
                </li>
                <li>
                    <a href="#">Cursos</a>
                </li>
                <li>
                    <a href="#">Evaluaciones</a>
                </li>
                <li>
                  <a href="#">Convocatorias</a>
              </li>
              </ul>
	          </li>
	          <li class="active">
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Admistración</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Especialidad</a>
                </li>
                <li>
                    <a href="#">Usuarios</a>
                </li>
                <li>
                    <a href="#">Roles</a>
                </li>
              </ul>
	          </li>
	          <li>
              <a href="#">Reportes</a>
	          </li>
	    
	        </ul>
	      </div>
    	</nav>
 <!-- Page Content  -->
 <div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">

    <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-bars"></i>
      <span class="sr-only">Toggle Menu</span>
    </button>
    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Inicio</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#">Ayuda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<h2 class="mb-4">Control de notas para centro técnico</h2>
<?php
include_once("DocenteAd.php");
?>
</div>
</div>



    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
  </body>
</html>