<?php 
session_start();
if(!isset($_SESSION['codigo'])){
    header("Location: ../index.php");
}
?>
<!doctype html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-2">
                <a href="./index.php"><img src="../images/logo.png" alt="" width="80px" class="img logo  mb-5"></a>
               
                <ul class="list-unstyled components mb-5">
                <li>
                        <a href="?x=notas.php"> <span class="material-icons"><img src="../images/icons/notas.png" alt="">  Notas</a>
                    </li>
                    <li>
                    <a href="?x=alumnos.php"> <span class="material-icons"><img src="../images/icons/alumnos.png" alt=""></span>  Alumnos</a>
                    </li>
                    <li>
                        <a href="?x=evaluaciones.php"> <span class="material-icons"><img src="../images/icons/evaluaciones.png" alt="">  Evaluaciones</a>
                    </li>
                    <li>
                        <a href="?x=reportes.php"> <span class="material-icons"><img src="../images/icons/reportes.png" alt="">  Reportes</a>
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
                                <a class="nav-link" href="./index.php">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Ayuda</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sesión &nbsp</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Cerrar</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h2 class="mb-4"></h2>
            <?php
            if (isset($_GET['x'])) {
                include($_GET['x']);
            } else {
            }
            ?>
        </div>
    </div>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>