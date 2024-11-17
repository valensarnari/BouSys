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
    <title>Lista de reservas</title>
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

        h3 {
            color: #007bff;
        }

        .form-control {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .form-control::placeholder {
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

        .btn-success,
        .btn-warning {
            background-color: #03dac6;
            border-color: #03dac6;
            color: #121212;
        }

        .btn-success:hover,
        .btn-warning:hover,
        .btn-danger:hover {
            background-color: #018786;
            border-color: #018786;
        }

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
            background-color: #2a2a2a;
            color: #e0e0e0;
        }

        .modal-header {
            border-bottom-color: #444;
        }

        .modal-footer {
            border-top-color: #444;
        }

        .close {
            color: #e0e0e0;
        }

        .modal .form-control {
            background-color: #1e1e1e;
            border-color: #444;
            color: #e0e0e0;
        }

        .modal .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .modal .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .modal .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }



        /* Ajustes para el texto en el sidebar */
        .nav-link {
            color: #e0e0e0 !important;
        }

        .nav-link:hover {
            color: #0dcaf0 !important;
        }

        /* Ajustes para el dropdown del usuario */
        .dropdown-menu-dark {
            background-color: #2a2a2a;
        }

        .dropdown-item {
            color: #e0e0e0;
        }

        .dropdown-item:hover {
            background-color: #0dcaf0;
            color: #000;
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
                    <a href="listado_clientes_recepcionista.php" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Gestión de Clientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="habitaciones.php" class="nav-link">
                        <i class="fa-solid fa-hotel"></i>
                        <span>Gestión de Habitaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reservas.php" class="nav-link active">
                        <i class="fa-solid fa-book"></i>
                        <span>Gestión de Reservas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="nueva_reserva.php" class="nav-link">
                        <i class="fa-solid fa-plus"></i>
                        <span>Nueva Reserva</span>
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
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li>
                        <a class="dropdown-item" href="../registro_login/cerrar_sesion.php">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            <span>Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Visualizar reservas (siempre visible) -->
        <div class="main-content">
            <div class="container">
                <h3 class="mb-3">Reservas Actuales</h3>
                <hr>
                <!-- Formulario de filtrado -->
                <form method="GET" class="mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-2">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                        </div>
                        <div class="col-md-2">
                            <label for="fecha_fin" class="form-label">Fecha de fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                        </div>
                        <div class="col-md-2">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="">Todos los estados</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Confirmada">Confirmada</option>
                                <option value="Cancelada">Cancelada</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="valor_minimo" class="form-label">Valor mínimo</label>
                            <input type="number" class="form-control" id="valor_minimo" name="valor_minimo">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-secondary w-100" onclick="limpiarFiltros()">Borrar
                                filtros</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <td scope="col">Cliente</td>
                                    <td scope="col">Estado</td>
                                    <td scope="col">Inicio</td>
                                    <td scope="col">Fin</td>
                                    <td scope="col">Check-In</td>
                                    <td scope="col">Check-Out</td>
                                    <td scope="col">Valor total</td>
                                    <td scope="col">Opciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // paginacion
                                $por_pagina = 10; // num de registros por pagina
                                $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                                $offset = ($pagina_actual - 1) * $por_pagina;

                                // Construir la consulta SQL con los filtros
                                $where = [];
                                $params = [];
                                $types = "";

                                if (!empty($_GET['fecha_inicio'])) {
                                    $where[] = "rt.Fecha_Inicio >= ?";
                                    $params[] = $_GET['fecha_inicio'];
                                    $types .= "s";
                                }
                                if (!empty($_GET['fecha_fin'])) {
                                    $where[] = "rt.Fecha_Fin <= ?";
                                    $params[] = $_GET['fecha_fin'];
                                    $types .= "s";
                                }
                                if (!empty($_GET['estado'])) {
                                    $where[] = "rt.Estado = ?";
                                    $params[] = $_GET['estado'];
                                    $types .= "s";
                                }
                                if (!empty($_GET['valor_minimo'])) {
                                    $where[] = "rt.Valor_Total >= ?";
                                    $params[] = $_GET['valor_minimo'];
                                    $types .= "d";
                                }

                                $sql_where = "";
                                if (!empty($where)) {
                                    $sql_where = "WHERE " . implode(" AND ", $where);
                                }

                                // Contar el número total de reservas con los filtros aplicados
                                $sql_count = "SELECT COUNT(*) as total FROM reserva_total rt JOIN cliente c ON rt.ID_Cliente = c.id $sql_where";
                                $stmt_count = mysqli_prepare($conexion, $sql_count);
                                if (!empty($params)) {
                                    mysqli_stmt_bind_param($stmt_count, $types, ...$params);
                                }
                                mysqli_stmt_execute($stmt_count);
                                $result_total = mysqli_stmt_get_result($stmt_count);
                                $total_reservas = mysqli_fetch_assoc($result_total)['total'];

                                // Calcular el total de páginas
                                $total_paginas = ceil($total_reservas / $por_pagina);

                                // Consulta SQL con LIMIT, OFFSET y filtros
                                $sql = "SELECT rt.id, c.id, rt.Estado, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Check_In, rt.Check_Out, rt.Valor_Total, c.Nombre, c.Apellido
                                    FROM reserva_total rt JOIN cliente c ON rt.ID_Cliente = c.id
                                    $sql_where
                                    ORDER BY rt.id DESC LIMIT ? OFFSET ?";

                                $stmt = mysqli_prepare($conexion, $sql);
                                if (!empty($params)) {
                                    $types .= "ii";
                                    $params[] = $por_pagina;
                                    $params[] = $offset;
                                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                                } else {
                                    mysqli_stmt_bind_param($stmt, "ii", $por_pagina, $offset);
                                }
                                mysqli_stmt_execute($stmt);
                                $query = mysqli_stmt_get_result($stmt);

                                // Verificar si la consulta falló
                                if (!$query) {
                                    die("Error en la consulta SQL: " . mysqli_error($conexion));
                                }

                                // Mostrar resultados en la tabla
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
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modificar<?php echo $resultado['0'] ?>">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#check_in<?php echo $resultado['0'] ?>">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    include("modals/modificar_habitacion_modal.php");
                                    include("modals/check_in_check_out_modal.php");
                                }
                                ?>
                            </tbody>
                        </table>

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
        </div>

        <script>
            function limpiarFiltros() {
                document.getElementById('fecha_inicio').value = '';
                document.getElementById('fecha_fin').value = '';
                document.getElementById('estado').value = '';
                document.getElementById('valor_minimo').value = '';
                // Enviar el formulario para recargar la página sin filtros
                document.querySelector('form').submit();
            }
        </script>
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>





</html>