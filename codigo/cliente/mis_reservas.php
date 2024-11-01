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
            font-size: 0.95rem;
        }

        .table th {
            background-color: #0056b3;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 1rem;
            vertical-align: middle;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.05);
        }

        /* Estilos para los botones */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #0056b3;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 86, 179, 0.2);
        }

        .btn-primary:hover {
            background-color: #004494;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 86, 179, 0.3);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.3);
        }

        /* Estilo para el contenedor de la tabla */
        .table-responsive {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
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

        .table-canceladas tbody tr {
            background-color: #f8f9fa;
        }

        .table-canceladas tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table-canceladas th {
            background-color: #dc3545;
        }

        .badge {
            padding: 0.5em 1em;
            font-size: 0.85em;
        }

        .table-activas tbody tr {
            background-color: #f8f9fa;
        }

        .table-activas tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table-activas th {
            background-color: #007bff;
        }

        .table-finalizadas tbody tr {
            background-color: #f8f9fa;
        }

        .table-finalizadas tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table-finalizadas th {
            background-color: #6c757d;
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
                    <?php
                    if (isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2) {
                        ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="panel_cliente.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <?php
                    } else {
                        ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <?php
                    }
                    ?>
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
            <h2 data-section="mis_reservaas.php" data-value="misReservas">Mis Reservas</h2>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0" data-section="mis_reservaas.php" data-value="activas">Reservas activas</h5>
                        <a href="reserva/uno.php" class="btn btn-primary">
                            <i class="fas fa-calendar-plus"></i> <span data-section="mis_reservaas.php" data-value="RealizarReserva">Realizar reserva</span>
                        </a>
                    </div>
                    <?php
                    // Consulta SQL para obtener las reservas activas del usuario (fecha fin >= hoy)
                    $id = $_SESSION['usuario_id'];
                    $sql = "SELECT rt.id, c.id, rt.Estado, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Check_In, rt.Check_Out, rt.Valor_Total, c.Nombre, c.Apellido
                            FROM reserva_total rt JOIN cliente c ON rt.ID_Cliente = c.id
                            WHERE c.id = '$id'
                            AND rt.Estado != 'Cancelada'
                            AND rt.Fecha_Fin >= CURDATE()
                            ORDER BY rt.Fecha_Inicio ASC";
                    $query = mysqli_query($conexion, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        // Si hay reservas, mostrar la tabla
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-activas">
                                <thead>
                                    <tr>
                                        <th data-section="mis_reservaas.php" data-value="Cliente">Cliente</th>
                                        <th data-section="mis_reservaas.php" data-value="Estado">Estado</th>
                                        <th data-section="mis_reservaas.php" data-value="Inicio">Inicio</th>
                                        <th data-section="mis_reservaas.php" data-value="Fin">Fin</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th data-section="mis_reservaas.php" data-value="Total">Valor total</th>
                                        <th data-section="mis_reservaas.php" data-value="Opciones">Opciones</th>
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
                                                <span class="badge bg-success" data-status= "<?php echo $resultado['2'] ?>"><?php echo $resultado['2'] ?></span>
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
                                                <div class="mb-3">
                                                    <?php
                                                    $fecha_actual = date('Y-m-d');
                                                    ?>
                                                    <button type="button" class="btn <?php echo ($fecha_actual < $resultado['3']) ? 'btn-info' : 'btn-secondary' ?>" 
                                                            data-bs-toggle="modal" data-bs-target="#detalles<?php echo $resultado['0'] ?>"
                                                            data-action="<?php echo ($fecha_actual < $resultado['3']) ? 'Modificar' : 'Ver detalles' ?>">
                                                        <i class="fas <?php echo ($fecha_actual < $resultado['3']) ? 'fa-edit' : 'fa-eye' ?>"></i>
                                                        <span><?php echo ($fecha_actual < $resultado['3']) ? 'Modificar' : 'Ver detalles' ?></span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        include("detalle_reserva_modal.php");
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        // Si no hay reservas, mostrar un mensaje
                        echo '<div class="no-reservas">No tienes reservas activas en este momento.</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Nueva sección para reservas finalizadas -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="mb-4" data-section="mis_reservaas.php" data-value="Finalizada">Reservas finalizadas</h5>
                    <?php
                    // Consulta SQL para obtener las reservas finalizadas
                    $sql_finalizadas = "SELECT rt.id, c.id, rt.Estado, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Check_In, rt.Check_Out, rt.Valor_Total, c.Nombre, c.Apellido
                                       FROM reserva_total rt JOIN cliente c ON rt.ID_Cliente = c.id
                                       WHERE c.id = '$id'
                                       AND rt.Estado != 'Cancelada'
                                       AND rt.Fecha_Fin < CURDATE()
                                       ORDER BY rt.Fecha_Fin DESC";
                    $query_finalizadas = mysqli_query($conexion, $sql_finalizadas);

                    if (mysqli_num_rows($query_finalizadas) > 0) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-finalizadas">
                                <thead>
                                    <tr>
                                        <th data-section="mis_reservaas.php" data-value="Cliente">Cliente</th>
                                        <th data-section="mis_reservaas.php" data-value="Estado">Estado</th>
                                        <th data-section="mis_reservaas.php" data-value="Inicio">Inicio</th>
                                        <th data-section="mis_reservaas.php" data-value="Fin">Fin</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th data-section="mis_reservaas.php" data-value="Total">Valor total</th>
                                        <th data-section="mis_reservaas.php" data-value="Calificacion">Calificación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($resultado = mysqli_fetch_array($query_finalizadas)) {
                                        // Verificar si ya existe una calificación
                                        $sql_calificacion = "SELECT * FROM calificaciones WHERE ID_Reserva = " . $resultado['0'];
                                        $query_calificacion = mysqli_query($conexion, $sql_calificacion);
                                        $tiene_calificacion = mysqli_num_rows($query_calificacion) > 0;
                                        $calificacion = $tiene_calificacion ? mysqli_fetch_array($query_calificacion) : null;
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $resultado['8'] . " " . $resultado['9'] ?></td>
                                            <td scope="row"><span class="badge bg-secondary" data-section="mis_reservaas.php" data-value="Finalizada">Finalizada</span></td>
                                            <td scope="row"><?php echo $resultado['3'] ?></td>
                                            <td scope="row"><?php echo $resultado['4'] ?></td>
                                            <td scope="row"><?php echo $resultado['5'] ?></td>
                                            <td scope="row"><?php echo $resultado['6'] ?></td>
                                            <td scope="row"><?php echo $resultado['7'] ?></td>
                                            <td scope="row">
                                                <?php if ($tiene_calificacion) { ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-star"></i> <?php echo $calificacion['Calificacion']; ?>/5
                                                    </span>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#calificarModal<?php echo $resultado['0']; ?>">
                                                        <i class="fas fa-star"></i><span data-section="mis_reservaas.php" data-value="Calificar"> Calificar</span>
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php include("calificar_modal.php"); ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        echo '<div class="no-reservas">No tienes reservas finalizadas.</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Nueva sección para reservas canceladas -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="mb-4" data-section="mis_reservaas.php" data-value="Canceladas">Historial de reservas canceladas</h5>
                    <?php
                    // Consulta SQL para obtener las reservas canceladas del usuario
                    $sql_canceladas = "SELECT rt.id, c.id, rt.Estado, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Check_In, rt.Check_Out, rt.Valor_Total, c.Nombre, c.Apellido
                                      FROM reserva_total rt JOIN cliente c ON rt.ID_Cliente = c.id
                                      WHERE c.id = '$id'
                                      AND rt.Estado = 'Cancelada'
                                      ORDER BY rt.id DESC";
                    $query_canceladas = mysqli_query($conexion, $sql_canceladas);

                    if (mysqli_num_rows($query_canceladas) > 0) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-canceladas">
                                <thead>
                                    <tr>
                                        <th data-section="mis_reservaas.php" data-value="Cliente">Cliente</th>
                                        <th data-section="mis_reservaas.php" data-value="Estado">Estado</th>
                                        <th data-section="mis_reservaas.php" data-value="Inicio">Inicio</th>
                                        <th data-section="mis_reservaas.php" data-value="Fin">Fin</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th data-section="mis_reservaas.php" data-value="Total">Valor total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($resultado = mysqli_fetch_array($query_canceladas)) {
                                        ?>
                                        <tr>
                                            <td scope="row"><?php echo $resultado['8'] . " " . $resultado['9'] ?></td>
                                            <td scope="row"><span class="badge bg-danger" data-status= "<?php echo $resultado['2'] ?>"><?php echo $resultado['2'] ?></span></td>
                                            <td scope="row"><?php echo $resultado['3'] ?></td>
                                            <td scope="row"><?php echo $resultado['4'] ?></td>
                                            <td scope="row"><?php echo $resultado['5'] ?></td>
                                            <td scope="row"><?php echo $resultado['6'] ?></td>
                                            <td scope="row"><?php echo $resultado['7'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        echo '<div class="no-reservas">No tienes reservas canceladas.</div>';
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