<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$reserva_id = $_POST["reserva_id"];
$reserva_adultos = $_POST["reserva_adultos"];
$_POST["reserva_ninos"] == "" ? $reserva_ninos = "0" : $reserva_ninos = $_POST["reserva_ninos"];
$reserva_fecha_inicio = $_POST["reserva_fecha_inicio"];
$reserva_fecha_fin = $_POST["reserva_fecha_fin"];

$habitaciones_seleccionadas = isset($_POST['habitaciones']) ? $_POST['habitaciones'] : [];
$habitaciones_adultos = isset($_POST['habitaciones_adultos']) ? $_POST['habitaciones_adultos'] : [];
$habitaciones_ninos = isset($_POST['habitaciones_ninos']) ? $_POST['habitaciones_ninos'] : [];
$habitaciones_cuna = isset($_POST['habitaciones_cuna']) ? $_POST['habitaciones_cuna'] : [];

$sql = "SELECT DISTINCT c.id, c.Numero_Cochera
        FROM cochera c
        WHERE NOT EXISTS (
            SELECT 1 
            FROM reserva_cochera rc
            JOIN reserva_total rt ON rc.ID_Reserva = rt.id
            WHERE rc.ID_Cochera = c.id
            AND (
                (rt.Fecha_Inicio <= ? AND rt.Fecha_Fin >= ?) OR
                (rt.Fecha_Inicio <= ? AND rt.Fecha_Fin >= ?) OR
                (rt.Fecha_Inicio >= ? AND rt.Fecha_Fin <= ?)
            )
        )";

$stmt = $conexion->prepare($sql);
$stmt->bind_param(
    "ssssss",
    $reserva_fecha_inicio,
    $reserva_fecha_inicio,
    $reserva_fecha_fin,
    $reserva_fecha_fin,
    $reserva_fecha_inicio,
    $reserva_fecha_fin
);
$stmt->execute();
$resultado = $stmt->get_result();
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
    <link href="../../../styles.css" rel="stylesheet">
    <title>Reserva de cochera</title>
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
            margin-bottom: 20px;
        }

        .reservation-summary {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .habitacion-item {
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            border-radius: 8px;
            padding: 8px 20px;
        }

        .label {
            color: #007bff;
            font-weight: 600;
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
            padding: 20px;
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
            <h2>Reservar cocheras disponibles (opcional)</h2>

            <div class="reservation-summary">
                <p><span class="label">Adultos:</span> <?php echo $reserva_adultos; ?></p>
                <p><span class="label">Niños:</span> <?php echo $reserva_ninos; ?></p>
                <p><span class="label">Fecha de inicio:</span> <?php echo $reserva_fecha_inicio; ?></p>
                <p><span class="label">Fecha de fin:</span> <?php echo $reserva_fecha_fin; ?></p>
            </div>

            <form action="cinco.php" method="POST">
                <div class="my-4">
                    <?php if ($resultado->num_rows > 0) { ?>
                        <?php while ($cochera = $resultado->fetch_assoc()) { ?>
                            <div class="habitacion-item">
                                <div class="form-check">
                                    <input class="form-check-input cochera-radio" type="radio" name="reserva_cochera"
                                        value="<?php echo $cochera['id']; ?>" id="cochera<?php echo $cochera['id']; ?>">
                                    <label class="form-check-label" for="cochera<?php echo $cochera['id']; ?>">
                                        Cochera <?php echo $cochera['Numero_Cochera']; ?>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-center">No hay cocheras disponibles para las fechas seleccionadas.</p>
                    <?php } ?>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="paso-indicador">
                        <span class="badge bg-primary">Paso 4 de 4</span>
                    </div>

                    <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                    <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                    <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                    <input type="hidden" name="reserva_fecha_inicio" value="<?php echo $reserva_fecha_inicio; ?>">
                    <input type="hidden" name="reserva_fecha_fin" value="<?php echo $reserva_fecha_fin; ?>">

                    <?php foreach ($habitaciones_seleccionadas as $habitacion_id): ?>
                        <input type="hidden" name="habitaciones[]" value="<?php echo $habitacion_id; ?>">
                        <input type="hidden" name="habitaciones_adultos[<?php echo $habitacion_id; ?>]"
                            value="<?php echo isset($habitaciones_adultos[$habitacion_id]) ? $habitaciones_adultos[$habitacion_id] : 0; ?>">
                        <input type="hidden" name="habitaciones_ninos[<?php echo $habitacion_id; ?>]"
                            value="<?php echo isset($habitaciones_ninos[$habitacion_id]) ? $habitaciones_ninos[$habitacion_id] : 0; ?>">
                        <input type="hidden" name="habitaciones_cuna[<?php echo $habitacion_id; ?>]"
                            value="<?php echo isset($habitaciones_cuna[$habitacion_id]) ? 1 : 0; ?>">
                    <?php endforeach; ?>

                    <button type="submit" class="btn btn-primary" id="submitBtn">Siguiente</button>
                </div>
            </form>
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

    <!---bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>