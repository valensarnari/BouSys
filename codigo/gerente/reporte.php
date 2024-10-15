<?php
include("../conexion.php");
//include ('../validacion_gerente.php');
//validarGerente('reporte.php');

// Chequear si se selecciono un mes (si no, usa el mes actual)
if (isset($_GET['mes']) && !empty($_GET['mes'])) {
    $mes = $_GET['mes'];
} else {
    // Si no se selecciona ningun mes, agarra el mes actual
    $mes = date('Y-m');
}

// Pasar el valor del mes a formato 'Y-m'
$año_mes = date('Y-m', strtotime($mes));

$sql = "SELECT h.Numero_Habitacion, rt.Fecha_Inicio, rt.Fecha_Fin
        FROM reserva_habitacion rh 
        JOIN reserva_total rt ON rh.ID_Reserva = rt.id 
        JOIN habitacion h ON h.id = rh.ID_Habitacion
        WHERE DATE_FORMAT(rt.Fecha_Inicio, '%Y-%m') = '$año_mes'
        OR DATE_FORMAT(rt.Fecha_Fin, '%Y-%m') = '$año_mes';";

$query = mysqli_query($conexion, $sql);

// Esto es para chequear que si no hay resultados, no muestre el grafico
$query = mysqli_query($conexion, $sql);
$num_rows = mysqli_num_rows($query);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <!---bootstrap css --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Reporte de ocupación</title>
    <!---graficos --->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", { packages: ["timeline"] });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var container = document.getElementById('reporte');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'string', id: 'Habitación' });
            dataTable.addColumn({ type: 'date', id: 'Inicio' });
            dataTable.addColumn({ type: 'date', id: 'Final' });
            dataTable.addRows([
            <?php

            $primeraFila = true; // Variable para manejar la ultima coma
            while ($resultado = mysqli_fetch_array($query)) {

                $fecha_inicio = date('Y, m-1, d', strtotime($resultado['1']));
                $fecha_final = date('Y, m-1, d', strtotime($resultado['2']));

                // Chequear si no es la primera fila para añadir coma
                if (!$primeraFila) {
                    echo ",";
                }

                $primeraFila = false; // Marcar que ya procesamos la primera fila
            
                ?> ['<?php echo $resultado['0'] ?>', new Date(<?php echo $fecha_inicio; ?>), new Date(<?php echo $fecha_final; ?>)] <?php

            }
            ?>
        ]);

            var options = {
                timeline: { colorByRowLabel: true },
                hAxis: { format: 'MMM dd, yyyy' }, gridlines: { count: -1 }
            };

            chart.draw(dataTable, options);
        }

    </script>
</head>

<body>
    <div class="d-flex">
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">BouSys</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="../../" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-house"></i> Volver a inicio
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="listado_empleados.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-user"></i> Gestión de empleados
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="listado_clientes.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-address-book"></i> Gestión de clientes
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="listado_habitaciones.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-hotel"></i> Gestión de habitaciones
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reporte.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-chart-simple"></i> Reporte de ocupación
                            </span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['Nombre']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="../cerrar_conexion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row my-2 rounded" style="background-color: #F3F3F3;">
                <div class="col p-3">
                    <label class="form-label">Buscar por mes:</label>
                    <div class="col-2">
                        <form method="GET" action="reporte.php">
                            <input class="form-control" type="month" name="mes" id="mes"
                                value="<?php echo isset($_GET['mes']) ? $_GET['mes'] : date('Y-m'); ?>">
                            <input class="btn btn-primary my-2" type="submit" value="Buscar">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row my-2 rounded" style="background-color: #F3F3F3;">
                <div class="col p-4">
                    <?php
                    // Chequeo de si hay resultados
                    if ($num_rows > 0) {
                        ?>
                        <div id="reporte"></div>
                        <?php
                    } else
                    {
                        ?>
                        <p>No hay reservas en el mes seleccionado</p>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>