<!--------------------------------------- MERCADO PAGO --------------------------------------->
<?php
require __DIR__ . '/vendor/autoload.php';
$access_token = 'TEST-5873219368709518-100511-fddcbcfa14ab02bac2c5c8f75823d22f-1433164475';
MercadoPago\SDK::setAccessToken($access_token);
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    "success" => "http://localhost/hotel/index.html",
    "failure" => "http://localhost/hotel/index.html",
    "pending" => "http://localhost/hotel/index.html"
);

$productos = [];
$item = new MercadoPago\Item();
$item->title = 'NOMBRE HABITACION';
$item->description = 'DESCRIPCION HABITACION';
$item->quantity = 1;
$item->unit_price = 1000;
array_push($productos, $item);

$preference->items = $productos;
$preference->save();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../styles.css" rel="stylesheet">
    <script src="../script.js"></script>
    <link rel="icon" type="image/svg+xml" href="icons/calendar-check.svg">
    <title>Reservas</title>
</head>

<body class="container-fluid">
    <!-------------------------------------------------------Titulo top------------------------------>
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <!---------------------------------------------MENÚ------------------------------------------------------------->
    <ul class="nav nav-pills menuPages">
        <div class="flags">
            <div id="flags" class="flags_item" data-language="en"><img src="../icons/gb.svg"></div>
            <div id="flag-es" class="flags_item_es" data-language="es"><img src="../icons/es.svg"></div>
        </div>
        <li class="nav-item">
        <button type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#ingresar">
                Ingreso
            </button>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="../index.html" data-section="nav"
                data-value="home">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../pages/services.html" data-section="nav" data-value="services">Servicios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../pages/rooms.html" data-section="nav" data-value="rooms">Habitaciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../pages/recommendations.html" data-section="nav"
                data-value="recommendations">Recomendaciones</a>
        </li>
        <li class="nav-item "></li>
            <a class="nav-link right" href="contacto.html">
                <p data-section="nav" data-value="signup">Contacto</p>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i> Perfil
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../codigo/cliente/perfil.php" data-section="nav" data-value="perfil">Mi Perfil</a></li>
                <li><a class="dropdown-item" href="../codigo/cliente/mis_reservas.php" data-section="nav" data-value="reservas">Mis Reservas</a></li>
            </ul>
        </li>
        <li class="nav-item ms-auto">
            <img src="../icons/calendar-check.svg"></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link right" href="pages/receptions.php">
                <p data-section="nav" data-value="receptions">Reservas</p>
            </a>
        </li>>
    </ul>
    <!-----------------------------------------IMAGEN O VIDEO PRINCIPAL--------------------------------------------->
    <div class="row room-description">
        <p>
            Planifica tu próxima escapada al Continental Hotel y disfruta de una experiencia inolvidable. Selecciona las
            fechas de tu estancia y asegúrate de reservar con antelación para aprovechar nuestras exclusivas ofertas y
            servicios. ¡Estamos ansiosos por darte la bienvenida y hacer de tu visita una experiencia excepcional!
        </p>
    </div>
    <!------------------------------------texto 1------------------------------------------------------------------>
    <div class="row">
        <div class="col">
            <div class="col-12 video-container-service-room">
                <div class="row ratio ratio-16x9 video-first">
                    <video src="../video/video_reception.mp4" autoplay muted loop></video>
                </div>
            </div>
        </div>
        <div class="col align-items-end">
            <form>
                <label class="row room-description" for="datetime">Selecciona fecha y hora:</label>
                <input class="row room-description" type="datetime-local" id="datetime" name="datetime">
            </form>
            <div class="cho-container"></div>
        </div>


    </div>
    <br><br><br><br><br>
    <!-------------------------------------footer----------------------------------------------------->
    <footer class="bg-dark text-white pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre Nosotros</h5>
                    <p>Información sobre la empresa.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Inicio</a></li>
                        <li><a href="#" class="text-white">Servicios</a></li>
                        <li><a href="#" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>Email: info@ejemplo.com</p>
                    <p>Teléfono: +123 456 7890</p>
                </div>
            </div>
            <div class="text-center py-3">
                © 2024 Tu Empresa. Todos los derechos reservados.
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
        const mp = new MercadoPago('TEST-57ec9be1-bb4b-461d-8b3d-7e1dd72a76f9', {
            locale: 'es-AR'
        });
        const checkout = mp.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>',
            },
            render: {
                container: '.cho-container',
                label: 'Pagar',
            },
        });
    </script>

</body>

</html>