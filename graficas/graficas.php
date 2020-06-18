<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
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
 
.contenedor {
    width: 980px;
    margin: 0 auto;    
    padding: 2em;    
}
 
#grafica, #consulta {
    padding: 18px 20px;    
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
<div class="contenedor">
    <div id="consulta">

        <table>
            <thead>
                <tr>
                    <th>Categorias</th>
                    <th>Total</th>
                    <th>Porcentaje</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once "../Clases/BD.php";
            $conn = new baseD();
            $busqueda = $conn->busquedaFree("SELECT * FROM Participante WHERE sexo = 'Hombre'");
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
            $busqueda2 = $conn->busquedaFree("SELECT * FROM Participante WHERE sexo = 'Mujer'");
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
                color: colors[<?php echo $x; ?>],                    
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
                    text: 'Porcentajes de Estudiantes'
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
                            color: colors[1],
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
</body>
</html>