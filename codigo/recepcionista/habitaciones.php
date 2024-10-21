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
    <title>Lista de clientes</title>
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

        h2,
        h4 {
            color: #007bff;
        }

        .form-control,
        .form-select {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .form-control::placeholder,
        .form-select::placeholder {
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

        .btn-primary {
            background-color: #03dac6;
            border-color: #03dac6;
            color: #121212;
        }

        .btn-primary:hover {
            background-color: #018786;
            border-color: #018786;
        }

        .bg-light {
            background-color: #2a2a2a !important;
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
        <!--tabla, obviamente hay que ponerle forma y todo con css , probando funcionalidad gio-->
        <div class="container my-5">
            <div class="row">
                <div class="col">
                    <h2>Listado de Habitaciones</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <td scope="col">Número de habitación</td>
                                    <td scope="col">Tipo</td>
                                    <td scope="col">Estado</td>
                                    <td scope="col">Precio por noche</td>
                                    <td scope="col">Puntos</td>
                                    <td scope="col">Adultos</td>
                                    <td scope="col">Niños</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "SELECT Numero_Habitacion, Tipo, Estado, Precio_Por_Noche, Puntos, Cantidad_Adultos_Maximo, Cantidad_Ninos_Maximo FROM habitacion WHERE Activo = 1";
                                $query = mysqli_query($conexion, $select);

                                // Verificar si la consulta falló
                                if (!$query) {
                                    die("Error en la consulta SQL: " . mysqli_error($conexion));
                                }

                                // Mostrar resultados en la tabla
                                while ($resultado = mysqli_fetch_array($query)) {
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
                <div class="col-md-6 offset-md-3 p-3 bg-light rounded">
                    <h4>Cambiar estado de habitación</h4>
                    <!-- Formulario para cambiar el estado de una habitación -->
                    <form action="actions/modificar_estado_habitacion.php" method="post">
                        <div class="mb-3">
                            <label for="numero_habitacion" class="form-label">Seleccionar habitación:</label>
                            <select class="form-select" name="numero_habitacion" required>
                                <?php
                                $select = "SELECT Numero_Habitacion FROM habitacion WHERE Activo = 1";
                                $query = mysqli_query($conexion, $select);

                                if (!$query)
                                    die("Error en la consulta SQL: " . mysqli_error($conexion));

                                // Mostrar resultados en la tabla
                                while ($resultado = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?php echo $resultado[0]; ?>"><?php echo $resultado[0]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nuevo_estado" class="form-label">Seleccionar nuevo estado:</label>
                            <select class="form-select" name="nuevo_estado" required>
                                <option value="Disponible">Disponible</option>
                                <option value="Ocupada">Ocupado</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                            </select>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" value="Actualizar Estado">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--hay que poner para que pasen paginas de habitaciones gio-->

        <!--tabla, obviamente hay que ponerle forma y todo con css , probando funcionalidad gio-->


    </div>
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>





</html>