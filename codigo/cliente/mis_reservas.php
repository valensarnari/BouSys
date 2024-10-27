<?php

session_start();

include("../conexion.php");

// Verificar si el usuario ha iniciado sesión
if (!(isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2)) {
    // Si no hay sesión activa, redirigir a la página de login
    //echo "No hay sesión activa";
    header("Location: ../registro_login/panel_registro_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link href="../../styles.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../../icons/calendar-check.svg" />
    <script src="../../script.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
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
            padding: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .custom-navbar {
            background-color: #E6F3FF;
        }

        .custom-navbar .nav-link {
            color: #333333;
            font-weight: 500;
        }

        .custom-navbar .nav-link:hover {
            color: #0056b3;
        }

        .custom-navbar .dropdown-menu {
            background-color: #E6F3FF;
        }

        .custom-navbar .dropdown-item:hover {
            background-color: #CCE5FF;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        .no-reservas {
            text-align: center;
            padding: 2rem;
            font-size: 1.2rem;
            color: #6c757d;
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
                        <a class="nav-link text-dark" href="../../index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/receptions.php" data-section="nav"
                            data-value="receptions">
                            <img src="../../icons/calendar-check.svg" alt="Reservas"> Reservas
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
                            <li><a class="dropdown-item" href="perfil.php" data-section="nav" data-value="perfil">Mi
                                    Perfil</a></li>
                            <li><a class="dropdown-item" href="mis_reservas.php" data-section="nav"
                                    data-value="reservas">Mis Reservas</a></li>
                            <li><a class="dropdown-item" href="../registro_login/cerrar_sesion.php" data-section="nav"
                                    data-value="close">Cerrar sesión</a></li>
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
                                        src="../../icons/gb.svg" alt="English" class="me-2" style="width: 20px;">
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es"><img
                                        src="../../icons/es.svg" alt="Español" class="me-2" style="width: 20px;">
                                    Español
                                </div>
                            </li>
                            <li>
                                <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                        src="../../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;">
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
            <h2>Mis Reservas</h2>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Reservas actuales</h5>
                        <a href="reserva/uno.php" class="btn btn-primary">
                            <i class="fas fa-calendar-plus"></i> Realizar reserva
                        </a>
                    </div>
                    <?php
                    // Consulta SQL para obtener las reservas del usuario
                    $id = $_SESSION['usuario_id'];
                    $sql = "SELECT rt.id, c.id, rt.Estado, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Check_In, rt.Check_Out, rt.Valor_Total, c.Nombre, c.Apellido
                            FROM reserva_total rt JOIN cliente c ON rt.ID_Cliente = c.id
                            WHERE c.id = '$id'
                            AND rt.Estado != 'Cancelada'
                            ORDER BY rt.id DESC";
                    $query = mysqli_query($conexion, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        // Si hay reservas, mostrar la tabla
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th>Valor total</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($resultado = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td scope="row">
                                                <?php echo $resultado['8'] . " " . $resultado['9'] ?>
                                            </td>
                                            <td scope="row">
                                                <?php echo $resultado['2'] ?>
                                            </td>
                                            <td scope="row">
                                                <?php echo $resultado['3'] ?>
                                            </td>
                                            <td scope="row">
                                                <?php echo $resultado['4'] ?>
                                            </td>
                                            <td scope="row">
                                                <?php echo $resultado['5'] ?>
                                            </td>
                                            <td scope="row">
                                                <?php echo $resultado['6'] ?>
                                            </td>
                                            <td scope="row">
                                                <?php echo $resultado['7'] ?>
                                            </td>
                                            <td scope="row">
                                                <div class="mb-3 d-flex justify-content-between">
                                                    <div>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#cancelar<?php echo $resultado['0'] ?>"
                                                            data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        include("cancelar_reserva_modal.php");
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        // Si no hay reservas, mostrar un mensaje
                        echo '<div class="no-reservas">No tienes reservas confirmadas en este momento.</div>';
                    }
                    ?>
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
</body>

</html>
