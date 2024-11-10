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

$sql = "SELECT DISTINCT c.id, c.Numero_Cochera
        FROM cochera c
        WHERE c.Estado != 'En mantenimiento' 
        AND NOT EXISTS (
            SELECT 1 
            FROM reserva_cochera rc
            JOIN reserva_total rt ON rc.ID_Reserva = rt.id
            WHERE rc.ID_Cochera = c.id
            AND (
                (rt.Fecha_Inicio <= ? AND rt.Fecha_Fin >= ?) OR
                (rt.Fecha_Inicio <= ? AND rt.Fecha_Fin >= ?) OR
                (rt.Fecha_Inicio >= ? AND rt.Fecha_Fin <= ?)
            )
        )";

$stmt = $conexion->prepare($sql);
$stmt->bind_param(
    "ssssss",
    $reserva_fecha_inicio,
    $reserva_fecha_inicio,
    $reserva_fecha_fin,
    $reserva_fecha_fin,
    $reserva_fecha_inicio,
    $reserva_fecha_fin
);
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
    <title>Reserva de cochera</title>
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
        }

        .btn-primary:hover {
            background-color: #018786;
            border-color: #018786;
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
            max-width: 600px;
            /* O el ancho máximo que prefieras */
            margin: 0 auto;
            padding: 15px;
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
                    <a href="../../../" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../listado_clientes_recepcionista.php" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Gestión de Clientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../habitaciones.php" class="nav-link">
                        <i class="fa-solid fa-hotel"></i>
                        <span>Gestión de Habitaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../reservas.php" class="nav-link">
                        <i class="fa-solid fa-book"></i>
                        <span>Gestión de Reservas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../nueva_reserva.php" class="nav-link active">
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
                        <a class="dropdown-item" href="../../registro_login/cerrar_sesion.php">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            <span>Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="container">
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
                                Cochera
                                <?php echo $cochera['Numero_Cochera']; ?>
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
                        <input type="hidden" name="habitaciones_adultos[<?php echo $habitacion_id; ?>]"
                            value="<?php echo isset($habitaciones_adultos[$habitacion_id]) ? $habitaciones_adultos[$habitacion_id] : 0; ?>">
                        <input type="hidden" name="habitaciones_ninos[<?php echo $habitacion_id; ?>]"
                            value="<?php echo isset($habitaciones_ninos[$habitacion_id]) ? $habitaciones_ninos[$habitacion_id] : 0; ?>">
                        <input type="hidden" name="habitaciones_cuna[<?php echo $habitacion_id; ?>]"
                            value="<?php echo isset($habitaciones_cuna[$habitacion_id]) ? 1 : 0; ?>">
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