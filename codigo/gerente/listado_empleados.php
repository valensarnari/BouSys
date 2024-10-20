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