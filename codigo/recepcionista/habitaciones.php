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
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <h2>Listado de Habitaciones</h2>
                    <hr>
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
                                    if ($resultado['Estado'] == 'Ocupada') {
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
                                </tr>
                                <?php
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