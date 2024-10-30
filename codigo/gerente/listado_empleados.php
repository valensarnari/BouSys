<?php
include("modals/agregar_empleado.php");
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
    <title>Lista de empleados</title>
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

        h2 {
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
        .btn-warning,
        .btn-danger {
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
<<<<<<< HEAD
=======

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
>>>>>>> prueba
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
                    <a href="listado_empleados.php" class="nav-link active">
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
                    <a href="listado_habitaciones.php" class="nav-link">
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

        <div class="main-content">
            <div class="container">
                <h3 class="mb-3">Lista de empleados</h3>
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
            <!-- Activa modal de agregar -->
            <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#agregar">
                Agregar empleado <i class="fa-solid fa-user-plus"></i>
            </button>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <td scope="col">Nombre</td>
                                <td scope="col">Mail</td>
                                <td scope="col">Rol</td>
                                <td scope="col">Opciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Parámetro de paginación
                            $por_pagina = 10; // Número de registros por página
                            $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                            $offset = ($pagina_actual - 1) * $por_pagina;

                            // Consulta SQL con LIMIT y OFFSET
                            $select = "SELECT id, Nombre, Email, Contrasena, Jerarquia FROM usuario_empleados WHERE Activo = 1 ORDER BY id DESC LIMIT $por_pagina OFFSET $offset;";
                            $query = mysqli_query($conexion, $select);

                            // Mostrar resultados en la tabla
                            while ($resultado = mysqli_fetch_array($query)) {
                                ?>
=======
                <!-- Activa modal de agregar -->
                <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#agregar">
                    Agregar empleado <i class="fa-solid fa-user-plus"></i>
                </button>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
>>>>>>> prueba
                                <tr>
                                    <td scope="col">Nombre</td>
                                    <td scope="col">Mail</td>
                                    <td scope="col">Rol</td>
                                    <td scope="col">Opciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Parámetro de paginación
                                $por_pagina = 10; // Número de registros por página
                                $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                                $offset = ($pagina_actual - 1) * $por_pagina;

                                // Consulta SQL con LIMIT y OFFSET
                                $select = "SELECT id, Nombre, Email, Contrasena, Jerarquia FROM usuario_empleados WHERE Activo = 1 ORDER BY id DESC LIMIT $por_pagina OFFSET $offset;";
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
                                            <?php
                                            if ($resultado['4'] == 0)
                                                echo "Gerente";
                                            else
                                                echo "Recepcionista";
                                            ?>
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
                                    include("modals/eliminar_empleado.php");
                                    include("modals/editar_empleado.php");
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php
                        // Contar el número total de empleados
                        $result_total = mysqli_query($conexion, "SELECT COUNT(*) as total FROM usuario_empleados");
                        $total_empleados = mysqli_fetch_assoc($result_total)['total'];

                        // Calcular el total de páginas
                        $total_paginas = ceil($total_empleados / $por_pagina);
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
        </div>
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>
