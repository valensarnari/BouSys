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
    <title>Lista de habitaciones</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

<<<<<<< HEAD
        h2,
        h4 {
            color: #007bff;
        }

        .form-control,
        .form-select {
=======
        h2 {
            color: #007bff;
        }

        .form-control {
>>>>>>> prueba
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

<<<<<<< HEAD
        .form-control::placeholder,
        .form-select::placeholder {
=======
        .form-control::placeholder {
>>>>>>> prueba
            color: #888;
        }

        .table {
            background-color: #2a2a2a;
            color: #e0e0e0;
        }

        .table-dark {
            background-color: #1e1e1e;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #2a2a2a;
        }

        .table tbody tr td {
            color: #e0e0e0 !important;
        }

<<<<<<< HEAD
        .btn-primary {
=======
        .btn-success,
        .btn-warning,
        .btn-danger {
>>>>>>> prueba
            background-color: #03dac6;
            border-color: #03dac6;
            color: #121212;
        }

<<<<<<< HEAD
        .btn-primary:hover {
=======
        .btn-success:hover,
        .btn-warning:hover,
        .btn-danger:hover {
>>>>>>> prueba
            background-color: #018786;
            border-color: #018786;
        }

<<<<<<< HEAD
        .bg-light {
            background-color: #2a2a2a !important;
=======
        .pagination .page-link {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .dropdown-menu-dark {
            background-color: #2a2a2a;
        }

        /* Estilos para los modales */
        .modal-content {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .modal-header {
            border-bottom: 1px solid #444;
        }

        .modal-footer {
            border-top: 1px solid #444;
        }

        .modal-title {
            color: #007bff;
        }

        .close {
            color: #e0e0e0;
        }

        .modal .form-control {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .modal .form-control::placeholder {
            color: #888;
        }

        .modal .form-select {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .modal .btn-secondary {
            background-color: #444;
            border-color: #444;
        }

        .modal .btn-secondary:hover {
            background-color: #555;
            border-color: #555;
        }

        .modal .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .modal .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Estilos para el sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: linear-gradient(180deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 20px;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 20px 0;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h3 {
            color: #0dcaf0;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .nav-pills .nav-link {
            color: #e0e0e0 !important;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0 !important;
            transform: translateX(5px);
        }

        .nav-pills .nav-link.active {
            background-color: #0dcaf0;
            color: #000 !important;
        }

        .nav-pills .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Perfil de usuario en el sidebar */
        .user-profile {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .user-profile .dropdown-toggle {
            background-color: rgba(13, 202, 240, 0.1);
            padding: 10px 15px;
            border-radius: 8px;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-profile .dropdown-toggle:after {
            margin-left: auto;
        }

        .user-profile .dropdown-menu {
            background-color: #2a2a2a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .user-profile .dropdown-item {
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .user-profile .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Ajuste del contenido principal */
        .main-content {
            margin-left: 260px;
            /* Ancho del sidebar */
            padding: 30px;
            width: calc(100% - 260px);
            /* Ancho total menos el sidebar */
        }

        .container {
            max-width: 1400px;
            /* O el ancho máximo que prefieras */
            margin: 0 auto;
            padding: 0 15px;
>>>>>>> prueba
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>BouSys</h3>
            </div>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="../../" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="listado_empleados.php" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Gestión de Empleados</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="listado_clientes.php" class="nav-link">
                        <i class="fa-solid fa-address-book"></i>
                        <span>Gestión de Clientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="listado_habitaciones.php" class="nav-link active">
                        <i class="fa-solid fa-hotel"></i>
                        <span>Gestión de Habitaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte.php" class="nav-link">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>Reporte de Ocupación</span>
                    </a>
                </li>
            </ul>
            <div class="user-profile">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-circle fa-2x me-2"></i>
                    <span>
                        <?php echo $_SESSION['usuario_nombre']; ?>
                    </span>
                </a>
<<<<<<< HEAD
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="../../" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-house"></i> Volver a inicio
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="listado_clientes_recepcionista.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-user"></i> Gestión de clientes
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="habitaciones.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-hotel"></i> Gestión de habitaciones
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reservas.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-book"></i> Gestión de reservas
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="nueva_reserva.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-plus"></i> Nueva reserva
                            </span>
=======
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li>
                        <a class="dropdown-item" href="../registro_login/cerrar_sesion.php">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            <span>Cerrar sesión</span>
>>>>>>> prueba
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="container">
                <h3 class="mb-3">Lista de habitaciones</h3>
                <hr>
<<<<<<< HEAD
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
            <div class="row">
                <div class="col-md-6">
                    <h2>Listado de Habitaciones</h2>
                    <hr>
=======
                <!-- Activa modal de agregar -->
                <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#agregar">
                    Agregar habitacion <i class="fa-solid fa-user-plus"></i>
                </button>
                <div class="row">
>>>>>>> prueba
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
<<<<<<< HEAD
                                    <td scope="col">Número de habitación</td>
                                    <td scope="col">Tipo</td>
                                    <td scope="col">Estado</td>
                                    <td scope="col">Precio por noche</td>
                                    <td scope="col">Puntos</td>
                                    <td scope="col">Adultos</td>
                                    <td scope="col">Niños</td>
                                    <td scope="col">ID Cliente</td>
                                    <td scope="col">Apellido Cliente</td>
                                    <td scope="col">Nombre Cliente</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Consulta principal de habitaciones
                                $select = "SELECT Numero_Habitacion, Tipo, Estado, Precio_Por_Noche, Puntos, Cantidad_Adultos_Maximo, Cantidad_Ninos_Maximo FROM habitacion WHERE Activo = 1 ORDER BY Numero_Habitacion ASC";
                                $query = mysqli_query($conexion, $select);
                                if (!$query) {
                                    die("Error en la consulta SQL: " . mysqli_error($conexion));
                                }

                                while ($resultado = mysqli_fetch_array($query)) {
                                    // Si la habitación está ocupada, obtener datos del cliente
                                    $cliente_data = array('id' => '', 'Apellido' => '', 'Nombre' => '');
                                    if ($resultado['Estado'] == 'Ocupado') {
                                        $habitacion = intval($resultado['0']);

                                        $sql_cliente = "SELECT c.id, c.Nombre, c.Apellido 
                                                      FROM habitacion h
                                                      INNER JOIN reserva_habitacion rh ON h.id = rh.ID_Habitacion
                                                      INNER JOIN reserva_total rt ON rh.ID_Reserva = rt.id
                                                      INNER JOIN cliente c ON rt.ID_Cliente = c.id
                                                      WHERE h.Numero_Habitacion = " . intval($habitacion);

                                        $query_cliente = mysqli_query($conexion, $sql_cliente);
                                        if ($cliente = mysqli_fetch_array($query_cliente)) {
                                            $cliente_data = $cliente;
                                        }
                                    } else {
                                        $cliente_data = array('id' => 'desocupada', 'Apellido' => 'desocupada', 'Nombre' => 'desocupada ');
                                    }

                                    ?>
                                <tr>
                                    <td scope="row">
                                        <?php echo $resultado['0'] ?>
                                    </td>
                                    <td scope="row">
                                        <?php echo $resultado['1'] ?>
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
                                        <?php echo $cliente_data['id'] ?>
                                    </td>
                                    <td scope="row">
                                        <?php echo $cliente_data['Apellido'] ?>
                                    </td>
                                    <td scope="row">
                                        <?php echo $cliente_data['Nombre'] ?>
                                    </td>
=======
                                    <td scope="col">Número</td>
                                    <td scope="col">Tipo</td>
                                    <td scope="col">Precio</td>
                                    <td scope="col">Estado</td>
                                    <td scope="col">Puntos</td>
                                    <td scope="col">Adultos</td>
                                    <td scope="col">Niños</td>
                                    <td scope="col">Opciones</td>
>>>>>>> prueba
                                </tr>
                            </thead>
                            <tbody>
                                <?php
<<<<<<< HEAD
                                }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <h2>Listado de Cocheras</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <td scope="col">Número de cochera</td>
                                    <td scope="col">Estado</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_cocheras = "SELECT Numero_Cochera, Estado FROM cochera ORDER BY Numero_Cochera ASC";
                                $query_cocheras = mysqli_query($conexion, $select_cocheras);
                                if (!$query_cocheras) {
                                    die("Error en la consulta SQL: " . mysqli_error($conexion));
                                }
                                while ($resultado_cochera = mysqli_fetch_array($query_cocheras)) {
                                    ?>
                                <tr>
                                    <td scope="row">
                                        <?php echo $resultado_cochera['Numero_Cochera'] ?>
                                    </td>
                                    <td scope="row">
                                        <?php echo $resultado_cochera['Estado'] ?>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <h4>Cambiar estado de habitación</h4>
                        <form action="actions/modificar_estado_habitacion.php" method="post">
                            <div class="mb-3">
                                <label for="numero_habitacion" class="form-label">Seleccionar habitación:</label>
                                <select class="form-select" name="numero_habitacion" id="numero_habitacion" required>
                                    <?php
                                    $select = "SELECT Numero_Habitacion, Estado FROM habitacion WHERE Activo = 1 AND Estado != 'Ocupada'";
                                    $query = mysqli_query($conexion, $select);
                                    if (!$query)
                                        die("Error en la consulta SQL: " . mysqli_error($conexion));
                                    while ($resultado = mysqli_fetch_array($query)) {
                                        echo "<option value='" . $resultado['Numero_Habitacion'] . "' data-estado='" . $resultado['Estado'] . "'>" . $resultado['Numero_Habitacion'] . " - " . $resultado['Estado'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nuevo_estado" class="form-label">Seleccionar nuevo estado:</label>
                                <select class="form-select" name="nuevo_estado" id="nuevo_estado" required>
                                    <option value="Disponible">Disponible</option>
                                    <option value="Mantenimiento">Mantenimiento</option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary" value="Actualizar Estado">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <h4>Cambiar estado de cochera</h4>
                        <form action="actions/modificar_estado_cochera.php" method="post">
                            <div class="mb-3">
                                <label for="numero_cochera" class="form-label">Seleccionar cochera:</label>
                                <select class="form-select" name="numero_cochera" id="numero_cochera" required>
                                    <?php
                                    $select_cocheras = "SELECT Numero_Cochera, Estado FROM cochera WHERE Estado != 'Ocupado'";
                                    $query_cocheras = mysqli_query($conexion, $select_cocheras);
                                    if (!$query_cocheras)
                                        die("Error en la consulta SQL: " . mysqli_error($conexion));
                                    while ($resultado_cochera = mysqli_fetch_array($query_cocheras)) {
                                        echo "<option value='" . $resultado_cochera['Numero_Cochera'] . "' data-estado='" . $resultado_cochera['Estado'] . "'>" . $resultado_cochera['Numero_Cochera'] . " - " . $resultado_cochera['Estado'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nuevo_estado_cochera" class="form-label">Seleccionar nuevo estado:</label>
                                <select class="form-select" name="nuevo_estado_cochera" id="nuevo_estado_cochera"
                                    required>
                                    <option value="Disponible">Disponible</option>
                                    <option value="En mantenimiento">En mantenimiento</option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary" value="Actualizar Estado">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--hay que poner para que pasen paginas de habitaciones gio-->

        <!--tabla, obviamente hay que ponerle forma y todo con css , probando funcionalidad gio-->


    </div>
=======
                                // Parámetro de paginación
                                $por_pagina = 10; // Número de registros por página
                                $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                                $offset = ($pagina_actual - 1) * $por_pagina;

                                // Consulta SQL con LIMIT y OFFSET
                                $select = "SELECT id, Numero_Habitacion, Tipo, Precio_Por_Noche, Estado, Puntos, Cantidad_Adultos_Maximo, Cantidad_Ninos_Maximo FROM habitacion WHERE Activo = 1 ORDER BY id DESC LIMIT $por_pagina OFFSET $offset;";
                                $query = mysqli_query($conexion, $select);

                                // Mostrar resultados en la tabla
                                while ($resultado = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td scope="row">
                                            <?php echo $resultado['1'] ?>
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
                                            <!-- Activa modal de editar -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editar<?php echo $resultado['0'] ?>">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <!-- Activa modal de eliminar -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#eliminar<?php echo $resultado['0'] ?>">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    include("modals/eliminar_habitacion.php");
                                    include("modals/editar_habitacion.php");
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php
                        // Contar el número total de habitaciones
                        $result_total = mysqli_query($conexion, "SELECT COUNT(*) as total FROM habitacion");
                        $total_habitaciones = mysqli_fetch_assoc($result_total)['total'];

                        // Calcular el total de páginas
                        $total_paginas = ceil($total_habitaciones / $por_pagina);
                        ?>

                        <!-- Navegación de paginación -->
                        <nav>
                            <ul class="pagination d-flex justify-content-center">
                                <?php if ($pagina_actual > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>">Anterior</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                    <li class="page-item <?php if ($i == $pagina_actual)
                                        echo 'active'; ?>">
                                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($pagina_actual < $total_paginas): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>">Siguiente</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
>>>>>>> prueba
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const habitacionSelect = document.getElementById('numero_habitacion');
        const estadoSelect = document.getElementById('nuevo_estado');
        const cocheraSelect = document.getElementById('numero_cochera');
        const estadoCocheraSelect = document.getElementById('nuevo_estado_cochera');

        habitacionSelect.addEventListener('change', function () {
            const estadoActual = this.options[this.selectedIndex].getAttribute('data-estado');
            estadoSelect.innerHTML = ''; // Limpiar opciones existentes

            if (estadoActual === 'Disponible') {
                estadoSelect.add(new Option('Mantenimiento', 'Mantenimiento'));
            } else if (estadoActual === 'Mantenimiento') {
                estadoSelect.add(new Option('Disponible', 'Disponible'));
            }
        });

        cocheraSelect.addEventListener('change', function () {
            const estadoActual = this.options[this.selectedIndex].getAttribute('data-estado');
            estadoCocheraSelect.innerHTML = ''; // Limpiar opciones existentes

            if (estadoActual === 'Disponible') {
                estadoCocheraSelect.add(new Option('En mantenimiento', 'En mantenimiento'));
            } else if (estadoActual === 'En mantenimiento') {
                estadoCocheraSelect.add(new Option('Disponible', 'Disponible'));
            }
        });

        // Trigger change event on page load
        habitacionSelect.dispatchEvent(new Event('change'));
        cocheraSelect.dispatchEvent(new Event('change'));
    });
</script>

</html>