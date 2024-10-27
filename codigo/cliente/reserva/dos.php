<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$reserva_id = $_POST["reserva_id"];
$reserva_adultos = $_POST["reserva_adultos"];
$_POST["reserva_ninos"] == "" ? $reserva_ninos = "0" : $reserva_ninos = $_POST["reserva_ninos"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Reserva</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../styles.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../../../icons/calendar-check.svg" />
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container.mt-5 {
            max-width: 900px;
            margin-top: 3rem !important;
        }

        .container.mt-5 h2 {
            color: #343a40;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            max-width: 100%;
        }

        .paso-indicador {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .paso-indicador .badge {
            padding: 0.5em 1em;
            border-radius: 20px;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body class="container-fluid d-flex flex-column min-vh-100">
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/receptions.php" data-section="nav"
                            data-value="receptions">
                            <img src="../../../icons/calendar-check.svg" alt="Reservas"> Reservas
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <!--
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page"
                            href="../../codigo/registro_login/panel_registro_login.php" data-section="nav" data-value="login"
                            style="color: #212529 !important;">
                            <i class="fas fa-user"></i> Ingreso</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a style="color: #212529 !important;" class="nav-link dropdown-toggle" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../perfil.php" data-section="nav" data-value="perfil">Mi
                                    Perfil</a></li>
                            <li><a class="dropdown-item" href="../mis_reservas.php" data-section="nav"
                                    data-value="reservas">Mis Reservas</a></li>
                            <li><a class="dropdown-item" href="../../registro_login/cerrar_sesion.php"
                                    data-section="nav" data-value="reservas">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" data-section="nav" data-value="language">
                            <i class="fas fa-globe"></i> Idioma
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <div id="flags" class="flags_item dropdown-item" data-language="en"><img
                                        src="../../../icons/gb.svg" alt="English" class="me-2" style="width: 20px;">
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es"><img
                                        src="../../../icons/es.svg" alt="Español" class="me-2" style="width: 20px;">
                                    Español
                                </div>
                            </li>
                            <li>
                                <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                        src="../../../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;">
                                    Português
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container mt-5">
            <h2>Fechas de la Reserva</h2>
            <div class="card mx-auto" style="max-width: 400px;">
                <div class="card-body">
                    <form action="tres.php" method="POST">
                        <div class="mb-3">
                            <label for="reserva_fecha_inicio" class="form-label">Fecha de inicio:</label>
                            <input type="date" id="reserva_fecha_inicio" name="reserva_fecha_inicio"
                                class="form-control" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="reserva_fecha_fin" class="form-label">Fecha de fin:</label>
                            <input type="date" id="reserva_fecha_fin" name="reserva_fecha_fin" class="form-control"
                                required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="paso-indicador">
                                <span class="badge bg-primary">Paso 2 de 4</span>
                            </div>
                            <div>
                                <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                                <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                                <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                                <button type="submit" class="btn btn-primary">Siguiente</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-dark text-white pt-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Sobre nosotros</h5>
                    <p>Somos especialistas en viajes y reservas de hoteles. Nos encargamos de encontrar la mejor opción
                        para ti.</p>
                </div>
                <div class="col-md-6">
                    <h5>Links rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="../../index.php" class="text-white">Inicio</a></li>
                        <li><a href="../../pages/services.html" class="text-white">Servicios</a></li>
                        <li><a href="../../pages/rooms.html" class="text-white">Habitaciones</a></li>
                        <li><a href="../../pages/recommendations.html" class="text-white">Recomendaciones</a></li>
                        <li><a href="../../pages/contacto.html" class="text-white">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var fechaInicio = document.getElementById('reserva_fecha_inicio');
            var fechaFin = document.getElementById('reserva_fecha_fin');

            fechaInicio.addEventListener('change', function () {
                fechaFin.min = fechaInicio.value;
                if (fechaFin.value && fechaFin.value < fechaInicio.value) {
                    fechaFin.value = fechaInicio.value;
                }
            });

            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function (dropdown) {
                new bootstrap.Dropdown(dropdown);
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>

</html>