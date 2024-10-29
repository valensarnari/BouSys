<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

// Recuperar todos los datos del POST
$reserva_id = $_POST["reserva_id"];
$reserva_adultos = $_POST["reserva_adultos"];
$reserva_ninos = $_POST["reserva_ninos"];
$reserva_fecha_inicio = $_POST["reserva_fecha_inicio"];
$reserva_fecha_fin = $_POST["reserva_fecha_fin"];
$habitaciones_seleccionadas = isset($_POST['habitaciones']) ? $_POST['habitaciones'] : [];
$habitaciones_adultos = isset($_POST['habitaciones_adultos']) ? $_POST['habitaciones_adultos'] : [];
$habitaciones_ninos = isset($_POST['habitaciones_ninos']) ? $_POST['habitaciones_ninos'] : [];
$habitaciones_cuna = isset($_POST['habitaciones_cuna']) ? $_POST['habitaciones_cuna'] : [];
$reserva_cochera = isset($_POST['reserva_cochera']) ? $_POST['reserva_cochera'] : null;

// Recuperar el valor total de la sesión
$valor_total = isset($_SESSION['valor_total']) ? $_SESSION['valor_total'] : 0;
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <!---bootstrap css --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Acreditar pago</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .reservation-details {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            font-weight: bold;
            color: #007bff;
        }

        .detail-value {
            color: #e0e0e0;
        }

        .sub-details {
            margin-left: 20px;
            font-size: 0.9em;
        }

        .total-value {
            font-size: 1.2em;
            font-weight: bold;
            color: #03dac6;
        }

        h2 {
            color: #007bff;
        }

        .room-card {
            background-color: #2a2a2a;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #444;
            padding-bottom: 10px;
        }

        .room-id {
            font-size: 1.2em;
            font-weight: bold;
            color: #03dac6;
        }

        .room-details {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .room-detail-item {
            flex-basis: 48%;
            margin-bottom: 8px;
        }

        .room-detail-label {
            font-size: 0.9em;
            color: #888;
        }

        .room-detail-value {
            font-size: 1em;
            color: #e0e0e0;
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
            padding: 15px;
        }

        .payment-form {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .form-select {
            background-color: #2a2a2a;
            color: #e0e0e0;
            border: 1px solid #444;
        }

        .form-select:focus {
            background-color: #2a2a2a;
            color: #e0e0e0;
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
        }

        .payment-summary {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #444;
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
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="payment-form">
                            <h2 class="mb-4">Registro de Pago</h2>

                            <form action="procesar_reserva.php" method="POST">
                                <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                                <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                                <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                                <input type="hidden" name="reserva_fecha_inicio"
                                    value="<?php echo $reserva_fecha_inicio; ?>">
                                <input type="hidden" name="reserva_fecha_fin" value="<?php echo $reserva_fecha_fin; ?>">
                                <input type="hidden" name="reserva_cochera" value="<?php echo $reserva_cochera; ?>">

                                <?php foreach ($habitaciones_seleccionadas as $habitacion_id): ?>
                                <input type="hidden" name="habitaciones[]" value="<?php echo $habitacion_id; ?>">
                                <input type="hidden" name="habitaciones_adultos[<?php echo $habitacion_id; ?>]"
                                    value="<?php echo isset($habitaciones_adultos[$habitacion_id]) ? $habitaciones_adultos[$habitacion_id] : 0; ?>">
                                <input type="hidden" name="habitaciones_ninos[<?php echo $habitacion_id; ?>]"
                                    value="<?php echo isset($habitaciones_ninos[$habitacion_id]) ? $habitaciones_ninos[$habitacion_id] : 0; ?>">
                                <input type="hidden" name="habitaciones_cuna[<?php echo $habitacion_id; ?>]"
                                    value="<?php echo isset($habitaciones_cuna[$habitacion_id]) ? $habitaciones_cuna[$habitacion_id] : 0; ?>">
                                <?php endforeach; ?>

                                <div class="mb-4">
                                    <label for="medio_pago" class="form-label">Método de Pago</label>
                                    <select class="form-select" name="medio_pago" id="medio_pago" required>
                                        <option value="">Seleccione un método de pago</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta de débito">Tarjeta de débito</option>
                                        <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                                        <option value="Transferencia">Mercado Pago</option>
                                    </select>
                                </div>

                                <div class="payment-summary">
                                    <h4 class="mb-3">Resumen del Pago</h4>
                                    <div class="detail-item">
                                        <span class="detail-label">Subtotal:</span>
                                        <span class="detail-value">$
                                            <?php echo number_format($valor_total, 2); ?>
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Total a Pagar:</span>
                                        <span class="detail-value total-value">$
                                            <?php echo number_format($valor_total, 2); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">Confirmar Pago y Reserva</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>