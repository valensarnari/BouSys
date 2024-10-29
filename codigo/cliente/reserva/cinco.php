<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$reserva_id = $_POST["reserva_id"];
$reserva_adultos = $_POST["reserva_adultos"];
$_POST["reserva_ninos"] == "" ? $reserva_ninos = "0" : $reserva_ninos = $_POST["reserva_ninos"];
$reserva_fecha_inicio = $_POST["reserva_fecha_inicio"];
$reserva_fecha_fin = $_POST["reserva_fecha_fin"];
$reserva_cochera = isset($_POST['reserva_cochera']) ? $_POST['reserva_cochera'] : null;
/*SACO LOS CAMPOS DE CLIENTE*/
$sql_cliente = "SELECT nombre, apellido , puntos FROM cliente WHERE id = $reserva_id";
$resultado_cliente = mysqli_query($conexion, $sql_cliente);
$cliente = mysqli_fetch_assoc($resultado_cliente);
$puntos_cliente = $cliente['puntos'];/*SACO LOS PUNTOS*/

$habitaciones_seleccionadas = isset($_POST['habitaciones']) ? $_POST['habitaciones'] : [];
$habitaciones_adultos = isset($_POST['habitaciones_adultos']) ? $_POST['habitaciones_adultos'] : [];
$habitaciones_ninos = isset($_POST['habitaciones_ninos']) ? $_POST['habitaciones_ninos'] : [];
$habitaciones_cuna = isset($_POST['habitaciones_cuna']) ? $_POST['habitaciones_cuna'] : [];

// Agregar después de las variables iniciales
$habitaciones_numeros = [];
foreach ($habitaciones_seleccionadas as $hab_id) {
    $sql_num_habitacion = "SELECT Numero_Habitacion FROM habitacion WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql_num_habitacion);
    mysqli_stmt_bind_param($stmt, "i", $hab_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $hab = mysqli_fetch_assoc($resultado);
    $habitaciones_numeros[$hab_id] = $hab['Numero_Habitacion'];
    mysqli_stmt_close($stmt);
}

$cochera_detalles = null;
if ($reserva_cochera) {
    $sql_cochera = "SELECT Numero_Cochera FROM cochera WHERE id = $reserva_cochera";
    $resultado_cochera = mysqli_query($conexion, $sql_cochera);
    $cochera_detalles = mysqli_fetch_assoc($resultado_cochera);
}

$valor_total = 0;

$fecha_inicio = new DateTime($reserva_fecha_inicio);
$fecha_fin = new DateTime($reserva_fecha_fin);
$diferencia = $fecha_inicio->diff($fecha_fin);
$num_noches = $diferencia->days;

foreach ($habitaciones_seleccionadas as $hab_id) {
    $sql_habitacion = "SELECT Precio_Por_Noche FROM habitacion WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql_habitacion);
    mysqli_stmt_bind_param($stmt, "i", $hab_id);
    mysqli_stmt_execute($stmt);
    $resultado_habitacion = mysqli_stmt_get_result($stmt);
    $hab = mysqli_fetch_assoc($resultado_habitacion);

    if ($hab) {
        $valor_total += $hab['Precio_Por_Noche'] * $num_noches;
    }

    /*----------CONDICIONAL PARA IMPLEMENTAR DESCUENTOS POR PUNTOS--------------------*/
    if ($puntos_cliente >= 300 && $puntos_cliente <= 999) {
        $descuento = 0.1;
    } elseif ($puntos_cliente >= 1000 && $puntos_cliente <= 1999) {
        $descuento = 0.15;
    } elseif ($puntos_cliente >= 2000) {
        $descuento = 0.2;
    } else {
        $descuento = 0; // no hay descuento para menos de 300 puntos
    }
    $valor_con_descuento = $valor_total - ($valor_total * $descuento);

    mysqli_stmt_close($stmt);
}

$_SESSION['valor_total'] = $valor_total;

?>

<!--------------------------------------- MERCADO PAGO --------------------------------------->
<?php
// Agregar esto justo antes del formulario de confirmación
require __DIR__ . '/vendor/autoload.php';
MercadoPago\SDK::setAccessToken('TEST-5873219368709518-100511-fddcbcfa14ab02bac2c5c8f75823d22f-1433164475');

// Crear la preferencia
$preference = new MercadoPago\Preference();

// Crear el ítem
$item = new MercadoPago\Item();
$descripcion = '';
foreach ($habitaciones_seleccionadas as $hab_id) {
    $descripcion .= 'Habitacion ' . $habitaciones_numeros[$hab_id] . ": " ;
    $descripcion .= 'Adultos: ' . $habitaciones_adultos[$hab_id] . " " ;
    if ($habitaciones_ninos[$hab_id] > 0){
        $descripcion .= 'Ninos ' . $habitaciones_ninos[$hab_id] . " " ;
    }
}

$item->title =  $descripcion;
$item->quantity = 1;
$item->unit_price = $valor_con_descuento;
$preference->items = array($item);

// Crear URL con parámetros
$success_url = "http://localhost/BouSys/codigo/cliente/reserva/realizar_reserva.php";
$params = http_build_query([
    'reserva_id' => $reserva_id,
    'reserva_fecha_inicio' => $reserva_fecha_inicio,
    'reserva_fecha_fin' => $reserva_fecha_fin,
    'habitaciones' => base64_encode(json_encode($habitaciones_seleccionadas)),
    'habitaciones_adultos' => base64_encode(json_encode($habitaciones_adultos)),
    'habitaciones_ninos' => base64_encode(json_encode($habitaciones_ninos)),
    'habitaciones_cuna' => base64_encode(json_encode($habitaciones_cuna)),
    'reserva_cochera' => $reserva_cochera,
    'valor_total' => $valor_con_descuento
]);

$preference->back_urls = array(
    "success" => $success_url . "?" . $params,
    "failure" => "http://localhost/BouSys/codigo/cliente/reserva/cinco.php",
    "pending" => "http://localhost/BouSys/codigo/cliente/reserva/cinco.php"
);

$preference->auto_return = "approved";
$preference->save();

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
    <link href="../../../styles.css" rel="stylesheet">
    <title>Reserva de habitación</title>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container.mt-5 {
            max-width: 900px;
            margin-top: 3rem !important;
        }

        .container.mt-5 h2 {
            color: #343a40;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .reservation-details {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem auto;
        }

        .detail-group {
            margin-bottom: 1rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            font-size: 0.95rem;
        }

        .detail-item i {
            width: 25px;
            color: #007bff;
            margin-right: 10px;
        }

        .detail-item.text-success i {
            color: #28a745;
        }

        .cost-item.discount {
            color: #28a745;
            font-weight: 500;
        }

        .room-item {
            background: #f8f9fa;
            padding: 0.8rem;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e9ecef;
        }

        .room-occupancy span {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .cost-summary {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1.5rem;
        }

        .cost-item.total {
            color: #0056b3;
            font-size: 1.1rem;
        }

        .rooms-section {
            border-top: 1px solid #eee;
            padding-top: 1rem;
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .room-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        .room-number {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 0.5rem;
        }

        .room-occupancy {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .parking-section {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        .cost-summary {
            border-top: 1px solid #eee;
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .cost-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
        }

        .cost-item.total {
            border-top: 2px solid #eee;
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 0.5rem;
            padding-top: 1rem;
        }

        .section-title {
            font-size: 1.2rem;
            color: #343a40;
            margin-bottom: 1rem;
        }

        .btn-primary {
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
        }

        .content {
            flex: 1 0 auto;
            padding: 20px;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body class="container-fluid d-flex flex-column min-vh-100">
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/receptions.php" data-section="nav"
                            data-value="receptions">
                            <img src="../../../icons/calendar-check.svg" alt="Reservas"> Reservas
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <!--
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page"
                            href="../../codigo/registro_login/panel_registro_login.php" data-section="nav" data-value="login"
                            style="color: #212529 !important;">
                            <i class="fas fa-user"></i> Ingreso</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a style="color: #212529 !important;" class="nav-link dropdown-toggle" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../perfil.php" data-section="nav" data-value="perfil">Mi
                                    Perfil</a></li>
                            <li><a class="dropdown-item" href="../mis_reservas.php" data-section="nav"
                                    data-value="reservas">Mis Reservas</a></li>
                            <li><a class="dropdown-item" href="../../registro_login/cerrar_sesion.php"
                                    data-section="nav" data-value="reservas">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" data-section="nav" data-value="language">
                            <i class="fas fa-globe"></i> Idioma
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <div id="flags" class="flags_item dropdown-item" data-language="en"><img
                                        src="../../../icons/gb.svg" alt="English" class="me-2" style="width: 20px;">
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es"><img
                                        src="../../../icons/es.svg" alt="Español" class="me-2" style="width: 20px;">
                                    Español
                                </div>
                            </li>
                            <li>
                                <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                        src="../../../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;">
                                    Português
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="reservation-details">
                    <h2 class="mb-4">Resumen de la reserva</h2>

                    <!-- Información del cliente y puntos -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="detail-group">
                                <div class="detail-item">
                                    <i class="fas fa-user"></i>
                                    <span
                                        class="detail-value"><?php echo $cliente['nombre'] . ' ' . $cliente['apellido']; ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-star"></i>
                                    <span class="detail-value"><?php echo $puntos_cliente; ?> puntos</span>
                                </div>
                                <?php if ($descuento > 0): ?>
                                    <div class="detail-item text-success">
                                        <i class="fas fa-percentage"></i>
                                        <span class="detail-value">Descuento del <?php echo ($descuento * 100); ?>%
                                            aplicado</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-group">
                                <div class="detail-item">
                                    <i class="fas fa-users"></i>
                                    <span class="detail-value"><?php echo $reserva_adultos; ?> adultos,
                                        <?php echo $reserva_ninos; ?> niños</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="detail-value">Del
                                        <?php echo date('d/m/Y', strtotime($reserva_fecha_inicio)); ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar-check"></i>
                                    <span class="detail-value">Al
                                        <?php echo date('d/m/Y', strtotime($reserva_fecha_fin)); ?>
                                        (<?php echo $num_noches; ?> noches)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Habitaciones -->
                    <div class="rooms-section">
                        <h3 class="section-title">Habitaciones Seleccionadas</h3>
                        <div class="rooms-grid">
                            <?php foreach ($habitaciones_seleccionadas as $hab_id): ?>
                                <div class="room-item">
                                    <div class="room-number">Habitación <?php echo $habitaciones_numeros[$hab_id]; ?></div>
                                    <div class="room-occupancy">
                                        <span title="Adultos"><i class="fas fa-male"></i>
                                            <?php echo $habitaciones_adultos[$hab_id]; ?></span>
                                        <?php if ($habitaciones_ninos[$hab_id] > 0): ?>
                                            <span title="Niños"><i class="fas fa-child"></i>
                                                <?php echo $habitaciones_ninos[$hab_id]; ?></span>
                                        <?php endif; ?>
                                        <?php if (isset($habitaciones_cuna[$hab_id]) && $habitaciones_cuna[$hab_id] == 1): ?>
                                            <span title="Cuna"><i class="fas fa-baby"></i></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Cochera si existe -->
                    <?php if ($cochera_detalles): ?>
                        <div class="parking-section">
                            <i class="fas fa-car"></i> Cochera N° <?php echo $cochera_detalles['Numero_Cochera']; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Resumen de costos -->
                    <div class="cost-summary">
                        <div class="cost-item">
                            <span>Subtotal por <?php echo $num_noches; ?> noches</span>
                            <span>$<?php echo number_format($valor_total, 2); ?></span>
                        </div>
                        <?php if ($descuento > 0): ?>
                            <div class="cost-item discount">
                                <span>Descuento por puntos (<?php echo number_format($descuento * 100, 0); ?>%)</span>
                                <span
                                    class="text-success">-$<?php echo number_format($valor_total * $descuento, 2); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="cost-item total">
                            <span>Total Final</span>
                            <span>$<?php echo number_format($valor_con_descuento, 2); ?></span>
                        </div>
                    </div>

                    <!-- Formulario de confirmación -->
                    <div class="cho-container" style="margin: 20px auto; text-align: center;"></div>
                    <form action="realizar_reserva.php" method="POST" class="mt-4">
                        <div class="d-flex justify-content-end align-items-end mt-3">
                            <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                            <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                            <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                            <input type="hidden" name="reserva_fecha_inicio"
                                value="<?php echo $reserva_fecha_inicio; ?>">
                            <input type="hidden" name="reserva_fecha_fin" value="<?php echo $reserva_fecha_fin; ?>">

                            <?php foreach ($habitaciones_seleccionadas as $habitacion_id): ?>
                                <input type="hidden" name="habitaciones[]" value="<?php echo $habitacion_id; ?>">
                                <input type="hidden" name="habitaciones_adultos[<?php echo $habitacion_id; ?>]"
                                    value="<?php echo isset($habitaciones_adultos[$habitacion_id]) ? $habitaciones_adultos[$habitacion_id] : 0; ?>">
                                <input type="hidden" name="habitaciones_ninos[<?php echo $habitacion_id; ?>]"
                                    value="<?php echo isset($habitaciones_ninos[$habitacion_id]) ? $habitaciones_ninos[$habitacion_id] : 0; ?>">
                                <input type="hidden" name="habitaciones_cuna[<?php echo $habitacion_id; ?>]"
                                    value="<?php echo isset($habitaciones_cuna[$habitacion_id]) && $habitaciones_cuna[$habitacion_id] == 1 ? 1 : 0; ?>">
                            <?php endforeach; ?>

                            <input type="hidden" name="reserva_cochera" value="<?php echo $reserva_cochera; ?>">
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Sobre nosotros</h5>
                    <p>Somos especialistas en viajes y reservas de hoteles. Nos encargamos de encontrar la mejor opción
                        para ti.</p>
                </div>
                <div class="col-md-6">
                    <h5>Links rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="../../index.php" class="text-white">Inicio</a></li>
                        <li><a href="../../pages/services.html" class="text-white">Servicios</a></li>
                        <li><a href="../../pages/rooms.html" class="text-white">Habitaciones</a></li>
                        <li><a href="../../pages/recommendations.html" class="text-white">Recomendaciones</a></li>
                        <li><a href="../../pages/contacto.html" class="text-white">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!---bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!--------------------------- script mercado pago --------------------------->
    
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('TEST-57ec9be1-bb4b-461d-8b3d-7e1dd72a76f9');
    
        mp.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>'
            },
        render: {
            container: '.cho-container',
            label: 'Pagar con Mercado Pago',
            type: 'wallet'
        }
    });
</script>
</body>

</html>

