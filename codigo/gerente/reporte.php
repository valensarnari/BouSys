<?php
include("../conexion.php");
include("../registro_login/validacion_sesion.php");

// Chequear si se seleccionó un mes (si no, usa el mes actual)
if (isset($_GET['mes']) && !empty($_GET['mes'])) {
    $mes = $_GET['mes'];
} else {
    $mes = date('Y-m');
}

// Pasar el valor del mes a formato 'Y-m'
$año_mes = date('Y-m', strtotime($mes));

// Consulta para el gráfico de ocupación
$sql_ocupacion = "SELECT h.Numero_Habitacion, rt.Fecha_Inicio, rt.Fecha_Fin
        FROM reserva_habitacion rh 
        JOIN reserva_total rt ON rh.ID_Reserva = rt.id 
        JOIN habitacion h ON h.id = rh.ID_Habitacion
        WHERE (DATE_FORMAT(rt.Fecha_Inicio, '%Y-%m') = '$año_mes'
        OR DATE_FORMAT(rt.Fecha_Fin, '%Y-%m') = '$año_mes')
        AND rt.Estado = 'Confirmada';";

$query_ocupacion = mysqli_query($conexion, $sql_ocupacion);
$num_rows_ocupacion = mysqli_num_rows($query_ocupacion);

// Consulta para el gráfico de tipos de habitaciones reservadas
$sql_tipos_habitaciones = "SELECT h.Tipo, COUNT(*) as Cantidad
        FROM reserva_habitacion rh 
        JOIN reserva_total rt ON rh.ID_Reserva = rt.id 
        JOIN habitacion h ON h.id = rh.ID_Habitacion
        WHERE DATE_FORMAT(rt.Fecha_Inicio, '%Y-%m') = '$año_mes'
        AND rt.Estado = 'Confirmada'
        GROUP BY h.Tipo;";

$query_tipos_habitaciones = mysqli_query($conexion, $sql_tipos_habitaciones);

// Consulta para el gráfico de ingresos por día
$sql_ingresos = "SELECT DATE(rt.Fecha_Inicio) as Fecha, SUM(rt.Valor_Total) as Ingresos
        FROM reserva_total rt
        WHERE DATE_FORMAT(rt.Fecha_Inicio, '%Y-%m') = '$año_mes'
        GROUP BY DATE(rt.Fecha_Inicio);";

$query_ingresos = mysqli_query($conexion, $sql_ingresos);

// Consulta para el gráfico de calificaciones
$sql_calificaciones = "SELECT c.Calificacion, COUNT(*) as Cantidad
        FROM calificaciones c
        JOIN reserva_total rt ON c.ID_Reserva = rt.id
        WHERE DATE_FORMAT(rt.Fecha_Inicio, '%Y-%m') = '$año_mes'
        GROUP BY c.Calificacion;";

$query_calificaciones = mysqli_query($conexion, $sql_calificaciones);

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de ocupación</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { 'packages': ['timeline', 'corechart'] });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            drawOccupancyChart();
            drawRoomTypesChart();
            drawIncomeChart();
            drawRatingsChart();
        }

        function drawOccupancyChart() {
            var container = document.getElementById('ocupacion');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'string', id: 'Habitación' });
            dataTable.addColumn({ type: 'date', id: 'Inicio' });
            dataTable.addColumn({ type: 'date', id: 'Final' });
            dataTable.addRows([
                <?php
                $hasData = false;
                while ($resultado = mysqli_fetch_array($query_ocupacion)) {
                    $hasData = true;
                    $fecha_inicio = date('Y, m-1, d', strtotime($resultado['Fecha_Inicio']));
                    $fecha_final = date('Y, m-1, d', strtotime($resultado['Fecha_Fin']));
                    echo "['${resultado['Numero_Habitacion']}', new Date($fecha_inicio), new Date($fecha_final)],";
                }
                ?>
            ]);

            if (!<?php echo $hasData ? 'true' : 'false'; ?>) {
                container.innerHTML = '<p class="text-center">No hay datos de ocupación para mostrar.</p>';
                return;
            }

            var options = {
                timeline: { colorByRowLabel: true },
                backgroundColor: '#2a2a2a',
                colors: ['#4285F4', '#DB4437', '#F4B400', '#0F9D58'],
                hAxis: {
                    format: 'dd/MM/yyyy',
                    textStyle: { color: '#FFFFFF' }
                },
                height: 350
            };

            chart.draw(dataTable, options);
        }

        function drawRoomTypesChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tipo de Habitación', 'Cantidad'],
                <?php
                $hasData = false;
                while ($row = mysqli_fetch_assoc($query_tipos_habitaciones)) {
                    $hasData = true;
                    echo "['{$row['Tipo']}', {$row['Cantidad']}],";
                }
                ?>
            ]);

            var container = document.getElementById('tipos_habitaciones');
            if (!<?php echo $hasData ? 'true' : 'false'; ?>) {
                container.innerHTML = '<p class="text-center">No hay datos de tipos de habitaciones para mostrar.</p>';
                return;
            }

            var options = {
                title: 'Tipos de Habitaciones Reservadas',
                pieHole: 0.4,
                backgroundColor: '#2a2a2a',
                titleTextStyle: { color: '#e0e0e0' },
                legend: { textStyle: { color: '#e0e0e0' } }
            };

            var chart = new google.visualization.PieChart(container);
            chart.draw(data, options);
        }

        function drawIncomeChart() {
            var data = google.visualization.arrayToDataTable([
                ['Fecha', 'Ingresos'],
                <?php
                $hasData = false;
                while ($row = mysqli_fetch_assoc($query_ingresos)) {
                    $hasData = true;
                    echo "['{$row['Fecha']}', {$row['Ingresos']}],";
                }
                ?>
            ]);

            var container = document.getElementById('ingresos');
            if (!<?php echo $hasData ? 'true' : 'false'; ?>) {
                container.innerHTML = '<p class="text-center">No hay datos de ingresos para mostrar.</p>';
                return;
            }

            var options = {
                title: 'Ingresos por Día',
                curveType: 'function',
                legend: { position: 'bottom' },
                backgroundColor: '#2a2a2a',
                titleTextStyle: { color: '#e0e0e0' },
                legendTextStyle: { color: '#e0e0e0' },
                hAxis: { textStyle: { color: '#e0e0e0' } },
                vAxis: { textStyle: { color: '#e0e0e0' } }
            };

            var chart = new google.visualization.LineChart(container);
            chart.draw(data, options);
        }

        function drawRatingsChart() {
            var data = google.visualization.arrayToDataTable([
                ['Calificación', 'Cantidad'],
                <?php
                $hasData = false;
                while ($row = mysqli_fetch_assoc($query_calificaciones)) {
                    $hasData = true;
                    echo "['{$row['Calificacion']}', {$row['Cantidad']}],";
                }
                ?>
            ]);

            var container = document.getElementById('calificaciones');
            if (!<?php echo $hasData ? 'true' : 'false'; ?>) {
                container.innerHTML = '<p class="text-center">No hay datos de calificaciones para mostrar.</p>';
                return;
            }

            var options = {
                title: 'Distribución de Calificaciones',
                backgroundColor: '#2a2a2a',
                titleTextStyle: { color: '#e0e0e0' },
                legend: { textStyle: { color: '#e0e0e0' } },
                hAxis: { textStyle: { color: '#e0e0e0' } },
                vAxis: { textStyle: { color: '#e0e0e0' } }
            };

            var chart = new google.visualization.ColumnChart(container);
            chart.draw(data, options);
        }
    </script>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #1e1e1e;
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        h2,
        h3 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .form-control:focus {
            background-color: #333;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: translateY(-2px);
        }

        .chart {
            background-color: #2a2a2a;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .chart h3 {
            color: #e0e0e0;
            text-align: center;
            margin-bottom: 15px;
        }

        #sidebar {
            background-color: #1e1e1e;
            min-height: 100vh;
            padding-top: 20px;
        }

        #sidebar .nav-link {
            color: #e0e0e0;
        }

        #sidebar .nav-link:hover {
            background-color: #2a2a2a;
        }

        .dropdown-menu-dark {
            background-color: #2a2a2a;
        }

        .dropdown-item {
            color: #e0e0e0;
        }

        .dropdown-item:hover {
            background-color: #3a3a3a;
        }
    </style>
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
                        <span class="d-none d-sm-inline mx-1">
                            <?php echo $_SESSION['usuario_nombre']; ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="../registro_login/cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="container my-5">
            <h2 class="text-center mb-4">Reporte de Ocupación</h2>
            <div class="row my-4 rounded" style="background-color: #2a2a2a;">
                <div class="col p-4">
                    <form method="GET" action="reporte.php" class="d-flex align-items-end">
                        <div class="me-3">
                            <label for="mes" class="form-label">Seleccionar mes:</label>
                            <input class="form-control" type="month" name="mes" id="mes"
                                value="<?php echo isset($_GET['mes']) ? $_GET['mes'] : date('Y-m'); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12 chart">
                    <h3>Ocupación de Habitaciones</h3>
                    <div id="ocupacion"></div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-6 chart">
                    <h3>Tipos de Habitaciones Reservadas</h3>
                    <div id="tipos_habitaciones" style="height: 300px;"></div>
                </div>
                <div class="col-md-6 chart">
                    <h3>Ingresos por Día</h3>
                    <div id="ingresos" style="height: 300px;"></div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12 chart">
                    <h3>Distribución de Calificaciones</h3>
                    <div id="calificaciones" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>