<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$reserva_id = $_POST["reserva_id"];
$reserva_adultos = $_POST["reserva_adultos"];
$_POST["reserva_ninos"] == "" ? $reserva_ninos = "0" : $reserva_ninos = $_POST["reserva_ninos"];

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
    <title>Detalles de la Reserva</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }
        .container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            max-height: 350px;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            max-width: 600px;
        }
        h2 {
            color: #007bff;
        }
        .form-label {
            color: #e0e0e0;
        }
        .form-control {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }
        .form-control:focus {
            background-color: #3d3d3d;
            border-color: #007bff;
            color: #e0e0e0;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
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
        hr {
            border-color: #444;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">BouSys</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="../../../" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-house"></i> Volver a inicio
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../listado_clientes_recepcionista.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-user"></i> Gestión de clientes
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../habitaciones.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-hotel"></i> Gestión de habitaciones
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../reservas.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-book"></i> Gestión de reservas
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../nueva_reserva.php" class="nav-link align-middle px-0">
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
            <h2 class="text-center mb-4">Detalles de la Reserva</h2>
            <hr>
            <form action="tercera.php" method="POST">
                <div class="my-4">
                    <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                    <input type="date" id="reserva_fecha_inicio" name="reserva_fecha_inicio"
                        class="form-control" required
                        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                    <input type="date" id="reserva_fecha_fin" name="reserva_fecha_fin" class="form-control"
                        required>
                </div>
                <div class="d-flex justify-content-end align-items-end mt-4">
                    <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                    <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                    <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                    <input type="hidden" name="reserva_cuna" value="<?php echo $reserva_cuna; ?>">
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </div>
            </form>
        </div>
    </div>

    <!---bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fechaInicio = document.getElementById('reserva_fecha_inicio');
            var fechaFin = document.getElementById('reserva_fecha_fin');

            fechaInicio.addEventListener('change', function() {
                fechaFin.min = fechaInicio.value;
                if (fechaFin.value && fechaFin.value < fechaInicio.value) {
                    fechaFin.value = fechaInicio.value;
                }
            });
        });
    </script>

</body>

</html>
