<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$reserva_id = $_POST["reserva_id"];
$reserva_adultos = $_POST["reserva_adultos"];
$_POST["reserva_ninos"] == "" ? $reserva_ninos = "0" : $reserva_ninos = $_POST["reserva_ninos"];
$reserva_fecha_inicio = $_POST["reserva_fecha_inicio"];
$reserva_fecha_fin = $_POST["reserva_fecha_fin"];

$habitaciones_seleccionadas = isset($_POST['habitaciones']) ? $_POST['habitaciones'] : [];
$habitaciones_adultos = isset($_POST['habitaciones_adultos']) ? $_POST['habitaciones_adultos'] : [];
$habitaciones_ninos = isset($_POST['habitaciones_ninos']) ? $_POST['habitaciones_ninos'] : [];
$habitaciones_cuna = isset($_POST['habitaciones_cuna']) ? $_POST['habitaciones_cuna'] : [];

$sql = "SELECT c.id, c.Numero_Cochera
        FROM cochera c
        LEFT JOIN reserva_cochera rc ON c.id = rc.ID_Cochera
        LEFT JOIN reserva_total rt ON rc.ID_Reserva = rt.id
        WHERE (rt.Fecha_Inicio IS NULL 
        OR rt.Fecha_Fin IS NULL 
        OR rt.Fecha_Inicio NOT BETWEEN ? AND ?
        OR rt.Fecha_Fin NOT BETWEEN ? AND ?)
        GROUP BY c.id";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $reserva_fecha_inicio, $reserva_fecha_fin, $reserva_fecha_inicio, $reserva_fecha_fin);
$stmt->execute();
$resultado = $stmt->get_result();
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
    <title>Reserva de habitación</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }
        .container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            max-height: 380px;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            max-width: 600px;
        }
        h2 {
            color: #007bff;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        .form-check-label {
            color: #e0e0e0;
            font-size: 1.1rem;
            margin-left: 10px;
        }
        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            background-color: #2a2a2a;
            border-color: #444;
        }
        .form-check {
            margin-bottom: 15px;
        }
        hr {
            background-color: #444;
            opacity: 0.2;
        }
        .btn-primary {
            background-color: #03dac6;
            border-color: #03dac6;
            color: #121212;
            padding: 10px 20px;
            font-size: 1.1rem;
        }
        .btn-primary:hover {
            background-color: #018786;
            border-color: #018786;
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
            <h2 class="text-center">Reservar cocheras disponibles (opcional)</h2>
            <hr>
            <form action="quinta.php" method="POST">
                <div class="my-4">
                    <?php if ($resultado->num_rows > 0) { ?>
                        <?php while ($cochera = $resultado->fetch_assoc()) { ?>
                            <div class="form-check">
                                <input class="form-check-input cochera-radio" type="radio" name="reserva_cochera"
                                    value="<?php echo $cochera['id']; ?>" id="cochera<?php echo $cochera['id']; ?>">
                                <label class="form-check-label" for="cochera<?php echo $cochera['id']; ?>">
                                    Cochera <?php echo $cochera['Numero_Cochera']; ?>
                                </label>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-center">No hay cocheras disponibles para las fechas seleccionadas.</p>
                    <?php } ?>
                </div>

                <div class="d-flex justify-content-end align-items-end">
                    <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                    <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                    <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                    <input type="hidden" name="reserva_fecha_inicio" value="<?php echo $reserva_fecha_inicio; ?>">
                    <input type="hidden" name="reserva_fecha_fin" value="<?php echo $reserva_fecha_fin; ?>">
                    
                    <?php foreach ($habitaciones_seleccionadas as $habitacion_id): ?>
                        <input type="hidden" name="habitaciones[]" value="<?php echo $habitacion_id; ?>">
                        <input type="hidden" name="habitaciones_adultos[<?php echo $habitacion_id; ?>]" value="<?php echo isset($habitaciones_adultos[$habitacion_id]) ? $habitaciones_adultos[$habitacion_id] : 0; ?>">
                        <input type="hidden" name="habitaciones_ninos[<?php echo $habitacion_id; ?>]" value="<?php echo isset($habitaciones_ninos[$habitacion_id]) ? $habitaciones_ninos[$habitacion_id] : 0; ?>">
                        <input type="hidden" name="habitaciones_cuna[<?php echo $habitacion_id; ?>]" value="<?php echo isset($habitaciones_cuna[$habitacion_id]) ? 1 : 0; ?>">
                    <?php endforeach; ?>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Siguiente</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!---bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>
