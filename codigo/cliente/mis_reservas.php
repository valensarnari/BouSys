<?php

session_start();

include("../conexion.php");

//include("../registro_login/validacion_sesion.php");
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
    <title>Mis reservas</title>
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
    </style>
</head>

<body>
    <div class="d-flex">

        <!-- Visualizar reservas (siempre visible) -->
        <div class="container my-4">
            <h2 class="mb-3">Mis reservas</h2>
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
                            $por_pagina = 20; // num de registros por pagina
                            $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                            $offset = ($pagina_actual - 1) * $por_pagina;

                            $id = $_SESSION['usuario_id'];
                            // Consulta SQL con LIMIT, OFFSET y filtros
                            $sql = "SELECT rt.id, c.id, rt.Estado, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Check_In, rt.Check_Out, rt.Valor_Total, c.Nombre, c.Apellido
                                    FROM reserva_total rt JOIN cliente c ON rt.ID_Cliente = c.id
                                    WHERE c.id = '$id'
                                    AND rt.Estado != 'Cancelada'
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
                                    <div class="mb-3 d-flex justify-content-between">
                                        <div>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#cancelar<?php echo $resultado['0'] ?>" data-bs-dismiss="modal">
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
            </div>
        </div>
    </div>
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</html>
