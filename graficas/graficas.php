<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
</head>
<style>
    body {
    background: #f2f2f2;
    color: #111;
    font-family: sans-serif;
    font-size: 14px;
}
 
 .contenedor_global{
     width: 100%;
 }

.contenedor1 {
    width: 49%;
    margin: 0 auto;    
    padding: 2em;    
    display: inline-block;
}
 
#grafica, #consulta {
   
    text-align:center;
}
 
.form {
    text-align: center;
    margin: 0 auto;    
    max-width: 320px;
}
 
table {
    cursor: pointer;
    padding:8px;
    width: 100%;
}
 
th {
    background: rgb(66, 159, 202);  
    border-color: rgb(66, 159, 202);
}
 
tr, td {
    border: 1px solid rgb(66, 159, 202);
    border-radius: 5px;
}
</style>
<body>
<div class="contenedor_global">
<div class="contenedor1">
    <div id="consulta">

        <table>
            <thead>
                <tr>
                    <th>Categorias</th>
                    <th>Total Categoria</th>
                    <th>Porcentaje</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once "../Clases/BD.php";
            $conn = new baseD();
            $busqueda = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Hombre' AND convocatoria.`idSede` = 1");
            $c=0;
            $a=0;
            $total=0;
            $datos_hombre = 0;
            $datos_mujer= 0;
            $categoria1 ='Hombre';
            $categoria2 ='Mujer';
            foreach ($busqueda as $datos1) {
                $datos_hombre = $datos_hombre + 1;   
            }
            $busqueda2 = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Mujer' AND convocatoria.`idSede` = 1");
            foreach ($busqueda2 as $datos2) {
                $datos_mujer = $datos_mujer + 1;   
            }
            $total = $datos_hombre + $datos_mujer;
            $por_hombre= round( ($datos_hombre/$total)*100, 1);
                $por_mujer= round( ($datos_mujer/$total)*100, 1);
                echo "<tr><td>".$categoria1.'</td>';
                echo "<td>".$datos_hombre;'</td>';
                echo '<td>'.$por_hombre.'</td>';
                echo "</td><td rowspan='2'>".$total."</td></tr>";
                echo "<tr><td>".$categoria2.'</td>';
                echo "<td>".$datos_mujer;'</td>';
                echo '<td>'.$por_mujer.'</td>';
             for ($i=0; $i <=1 ; $i++) { 
                if ($i == 0) {
                    $porcentaje[$i] = $por_hombre;
                }else{
                    $porcentaje[$i] = $por_mujer;
                }
             }
             for ($x=0;$x<5;$x++) {
                $num_aleatorio = rand(1,9);
                $valores[$x] = $num_aleatorio;
              }
             
            ?>
            </tbody>
            </table>
        </div>
        <script>
        $(function () {
            var colors = Highcharts.getOptions().colors,
            categories = [<?php echo '"'.$categoria1 . '"' . ',"' . $categoria2 .'"';?>],
            name = 'Categorias',
            data = [
            <?php for($x=0;$x<=1;$x++){ ?>    
            {
                y: <?php echo $porcentaje[$x]; ?>,
                color: colors[<?php echo $valores[$x]; ?>],                    
            },  
            <?php } ?>        
            ];
            function setChart(name, categories, data, color) {
                chart.xAxis[0].setCategories(categories, false);
                chart.series[0].remove(false);
                chart.addSeries({
                    name: name,
                    data: data,
                    color: color || 'white'
                }, false);
                chart.redraw();
            }
            var chart = $('#grafica').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Porcentajes de Estudiantes en Santa Ana'
                },
                xAxis: {
                    categories: categories
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    var drilldown = this.drilldown;
                                    if (drilldown) {  
                                        setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                    } else {  
                                        setChart(name, categories, data);
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            color: colors[4],
                            style: {
                                fontWeight: 'none'
                            },
                            formatter: function() {
                                return this.y +' %';
                            },
                        }
                    }
                },
                series: [{
                    name: name,
                    data: data,
                    color: 'white'
                }],
                exporting: {
                    enabled: true
                }
            })
            .highcharts();  
        });

        </script>
        <div id="grafica"></div>
    </div>
    <div class="contenedor1">
    <div id="consulta">
        <table>
            <thead>
                <tr>
                    <th>Categorias</th>
                    <th>Total Categoria</th>
                    <th>Porcentaje</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once "../Clases/BD.php";
            $conn = new baseD();
            $busqueda_ahu = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Hombre' AND convocatoria.`idSede` = 3");
            $c=0;
            $a=0;
            $total2=0;
            $datos_hombre2 = 0;
            $datos_mujer2= 0;
            foreach ($busqueda_ahu as $datos1) {
                $datos_hombre2 = $datos_hombre2 + 1;   
            }
            $busqueda_ahu2 = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Mujer' AND convocatoria.`idSede` = 3");
            foreach ($busqueda_ahu2 as $datos2) {
                $datos_mujer2 = $datos_mujer2 + 1;   
            }
            $total2 = $datos_hombre2 + $datos_mujer2;
            if ($datos_hombre2 == 0) {
                $por_hombre2 = 0;
            }else{
                $por_hombre2= round( ($datos_hombre2/$total2)*100, 1);
            }
            if ($datos_mujer2 == 0) {
                $por_mujer2 = 0;
            }else{
                $por_mujer2= round( ($datos_mujer2/$total2)*100, 1);
            }
           
                
                echo "<tr><td>".$categoria1.'</td>';
                echo "<td>".$datos_hombre2;'</td>';
                echo '<td>'.$por_hombre2.'</td>';
                echo "</td><td rowspan='2'>".$total2."</td></tr>";
                echo "<tr><td>".$categoria2.'</td>';
                echo "<td>".$datos_mujer2;'</td>';
                echo '<td>'.$por_mujer2.'</td>';
             for ($i=0; $i <=1 ; $i++) { 
                if ($i == 0) {
                    $porcentaje2[$i] = $por_hombre2;
                }else{
                    $porcentaje2[$i] = $por_mujer2;
                }
             }
             for ($x=0;$x<5;$x++) {
                $num_aleatorio = rand(1,9);
                $valores2[$x] = $num_aleatorio;
              }
             
            ?>
            </tbody>
            </table>
        </div>
        <script>
        $(function () {
            var colors = Highcharts.getOptions().colors,
            categories = [<?php echo '"'.$categoria1 . '"' . ',"' . $categoria2 .'"';?>],
            name = 'Categorias',
            data = [
            <?php for($x=0;$x<=1;$x++){ ?>    
            {
                y: <?php echo $porcentaje2[$x]; ?>,
                color: colors[<?php echo $valores2[$x]; ?>],                    
            },  
            <?php } ?>        
            ];
            function setChart(name, categories, data, color) {
                chart.xAxis[0].setCategories(categories, false);
                chart.series[0].remove(false);
                chart.addSeries({
                    name: name,
                    data: data,
                    color: color || 'white'
                }, false);
                chart.redraw();
            }
            var chart = $('#grafica2').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Porcentajes de Estudiantes en Ahuchapan'
                },
                xAxis: {
                    categories: categories
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    var drilldown = this.drilldown;
                                    if (drilldown) {  
                                        setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                    } else {  
                                        setChart(name, categories, data);
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            color: colors[4],
                            style: {
                                fontWeight: 'none'
                            },
                            formatter: function() {
                                return this.y +' %';
                            },
                        }
                    }
                },
                series: [{
                    name: name,
                    data: data,
                    color: 'white'
                }],
                exporting: {
                    enabled: true
                }
            })
            .highcharts();  
        });

        </script>
        <div id="grafica2"></div>
    </div>

    <!-- Grafica San salvador -->
    <div class="contenedor1">
    <div id="consulta">
        <table>
            <thead>
                <tr>
                    <th>Categorias</th>
                    <th>Total Categoria</th>
                    <th>Porcentaje</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once "../Clases/BD.php";
            $conn = new baseD();
            $busqueda_ss = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Hombre' AND convocatoria.`idSede` = 2");
            $c=0;
            $a=0;
            $total4=0;
            $datos_hombre4 = 0;
            $datos_mujer4= 0;
            foreach ($busqueda_ss as $datos1) {
                $datos_hombre4 = $datos_hombre4 + 1;   
            }
            $busqueda_ss2 = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Mujer' AND convocatoria.`idSede` = 2");
            foreach ($busqueda_ss2 as $datos2) {
                $datos_mujer4 = $datos_mujer4 + 1;   
            }
            $total4 = $datos_hombre4 + $datos_mujer4;
            if ($datos_hombre4 == 0) {
                $por_hombre4 = 0;
            }else{
                $por_hombre4= round( ($datos_hombre4/$total4)*100, 1);
            }
            if ($datos_mujer4 == 0) {
                $por_mujer4 = 0;
            }else{
                $por_mujer4= round( ($datos_mujer4/$total4)*100, 1);
            }
           
                
                echo "<tr><td>".$categoria1.'</td>';
                echo "<td>".$datos_hombre4;'</td>';
                echo '<td>'.$por_hombre4.'</td>';
                echo "</td><td rowspan='2'>".$total4."</td></tr>";
                echo "<tr><td>".$categoria2.'</td>';
                echo "<td>".$datos_mujer4;'</td>';
                echo '<td>'.$por_mujer4.'</td>';
             for ($i=0; $i <=1 ; $i++) { 
                if ($i == 0) {
                    $porcentaje4[$i] = $por_hombre4;
                }else{
                    $porcentaje4[$i] = $por_mujer4;
                }
             }
             for ($x=0;$x<5;$x++) {
                $num_aleatorio = rand(1,9);
                $valores4[$x] = $num_aleatorio;
              }
             
            ?>
            </tbody>
            </table>
        </div>
        <script>
        $(function () {
            var colors = Highcharts.getOptions().colors,
            categories = [<?php echo '"'.$categoria1 . '"' . ',"' . $categoria2 .'"';?>],
            name = 'Categorias',
            data = [
            <?php for($x=0;$x<=1;$x++){ ?>    
            {
                y: <?php echo $porcentaje4[$x]; ?>,
                color: colors[<?php echo $valores4[$x]; ?>],                    
            },  
            <?php } ?>        
            ];
            function setChart(name, categories, data, color) {
                chart.xAxis[0].setCategories(categories, false);
                chart.series[0].remove(false);
                chart.addSeries({
                    name: name,
                    data: data,
                    color: color || 'white'
                }, false);
                chart.redraw();
            }
            var chart = $('#grafica3').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Porcentajes de Estudiantes en San Salvador'
                },
                xAxis: {
                    categories: categories
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    var drilldown = this.drilldown;
                                    if (drilldown) {  
                                        setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                    } else {  
                                        setChart(name, categories, data);
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            color: colors[4],
                            style: {
                                fontWeight: 'none'
                            },
                            formatter: function() {
                                return this.y +' %';
                            },
                        }
                    }
                },
                series: [{
                    name: name,
                    data: data,
                    color: 'white'
                }],
                exporting: {
                    enabled: true
                }
            })
            .highcharts();  
        });

        </script>
        <div id="grafica3"></div>
    </div>
    <!-- Grafica Sonsonate -->
    <div class="contenedor1">
    <div id="consulta">
        <table>
            <thead>
                <tr>
                    <th>Categorias</th>
                    <th>Total Categoria</th>
                    <th>Porcentaje</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once "../Clases/BD.php";
            $conn = new baseD();
            $busqueda_so = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Hombre' AND convocatoria.`idSede` = 4");
            $c=0;
            $a=0;
            $total3=0;
            $datos_hombre3 = 0;
            $datos_mujer3= 0;
            foreach ($busqueda_so as $datos1) {
                $datos_hombre3 = $datos_hombre3 + 1;   
            }
            $busqueda_so2 = $conn->busquedaFree("SELECT * FROM participante
            INNER JOIN convocatoria	ON convocatoria.`idConvocatoria` = participante.`idConvocatoria`
            WHERE participante.sexo = 'Mujer' AND convocatoria.`idSede` = 4");
            foreach ($busqueda_so2 as $datos2) {
                $datos_mujer3 = $datos_mujer3 + 1;   
            }
            $total3 = $datos_hombre3 + $datos_mujer3;
            if ($datos_hombre3 == 0) {
                $por_hombre3 = 0;
            }else{
                $por_hombre3= round( ($datos_hombre3/$total3)*100, 1);
            }
            if ($datos_mujer3 == 0) {
                $por_mujer3 = 0;
            }else{
                $por_mujer3= round( ($datos_mujer3/$total3)*100, 1);
            }
           
                
                echo "<tr><td>".$categoria1.'</td>';
                echo "<td>".$datos_hombre3;'</td>';
                echo '<td>'.$por_hombre3.'</td>';
                echo "</td><td rowspan='2'>".$total3."</td></tr>";
                echo "<tr><td>".$categoria2.'</td>';
                echo "<td>".$datos_mujer3;'</td>';
                echo '<td>'.$por_mujer3.'</td>';
             for ($i=0; $i <=1 ; $i++) { 
                if ($i == 0) {
                    $porcentaje3[$i] = $por_hombre3;
                }else{
                    $porcentaje3[$i] = $por_mujer3;
                }
             }
             for ($x=0;$x<5;$x++) {
                $num_aleatorio = rand(1,9);
                $valores3[$x] = $num_aleatorio;
              }
             
            ?>
            </tbody>
            </table>
        </div>
        <script>
        $(function () {
            var colors = Highcharts.getOptions().colors,
            categories = [<?php echo '"'.$categoria1 . '"' . ',"' . $categoria2 .'"';?>],
            name = 'Categorias',
            data = [
            <?php for($x=0;$x<=1;$x++){ ?>    
            {
                y: <?php echo $porcentaje3[$x]; ?>,
                color: colors[<?php echo $valores3[$x]; ?>],                    
            },  
            <?php } ?>        
            ];
            function setChart(name, categories, data, color) {
                chart.xAxis[0].setCategories(categories, false);
                chart.series[0].remove(false);
                chart.addSeries({
                    name: name,
                    data: data,
                    color: color || 'white'
                }, false);
                chart.redraw();
            }
            var chart = $('#grafica4').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Porcentajes de Estudiantes en Sonsonate'
                },
                xAxis: {
                    categories: categories
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    var drilldown = this.drilldown;
                                    if (drilldown) {  
                                        setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                    } else {  
                                        setChart(name, categories, data);
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            color: colors[4],
                            style: {
                                fontWeight: 'none'
                            },
                            formatter: function() {
                                return this.y +' %';
                            },
                        }
                    }
                },
                series: [{
                    name: name,
                    data: data,
                    color: 'white'
                }],
                exporting: {
                    enabled: true
                }
            })
            .highcharts();  
        });

        </script>
        <div id="grafica4"></div>
    </div>
</div>
</body>
</html>