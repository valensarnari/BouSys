<?php
include("../conexion.php");
include("../registro_login/validacion_sesion.php");
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
    <title>Panel Recepcionista</title>
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
                <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none"> <!--direccionar inicio -->
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
                    <!--cambiar -->
                    <li class="nav-item">
                        <a href="habitaciones.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-user"></i> Habitaciones
                            </span>
                        </a>
                    </li>
                    <!--cambiar -->
                    <li class="nav-item">
                        <a href="listado_clientes_recepcionista.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-address-book"></i> Gestión de clientes
                            </span>
                        </a>
                    </li>
                    <!--cambiar -->
                    <li class="nav-item">
                        <a href="reservas.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-chart-simple"></i> Reservas
                            </span>
                        </a>
                    </li>
                </ul>
                <hr>
                <!--arreglar -->
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline mx-1">nombreperfil</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                    </ul>
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