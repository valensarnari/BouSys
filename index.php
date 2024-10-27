<?php
include("cerrar_conexion.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="icons/home.png" />
    <script src="script.js"></script>
    <title>Home</title>
</head>

<body class="container-fluid">
    <!-------------------------------------------------------Titulo top------------------------------>
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <!----------------------------------------------CARROUSEL--------------------------------------------------->
    <div class="row ">
        <div class="carousel-container">
            <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner carousel-first">
                    <div class="carousel-item active">
                        <img src="images/pileta-dia.jfif" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 data-section="presentacion" data-value="relax">Relax...</h5>
                            <p data-section="presentacion" data-value="relax_texto">Disfruta de nuestra espectacular piscina en el Hotel Continental, ideal para relajarte y
                                disfrutar del sol en pleno centro de Buenos Aires.</p>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <img src="images/habitaciones-hotel.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 data-section="presentacion" data-value="comodidad">Comodidad</h5>
                            <p data-section="presentacion" data-value="comodidad_texto">Disfruta de la máxima comodidad en el Hotel Continental, donde cada detalle está diseñado
                                para ofrecerte una estancia relajante y placentera en pleno centro de Buenos Aires.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/pileta-noche.jfif" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 data-section="presentacion" data-value="noche">Noche...</h5>
                            <p data-section="presentacion" data-value="noche_texto">Sumérgete en la vibrante noche porteña en el Hotel Continental, donde la energía de
                                Buenos
                                Aires cobra vida con entretenimiento, gastronomía y cultura a solo unos pasos de tu
                                habitación.</p>
                        </div>
                    </div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    </div>
    <!---------------------------------------------MENÚ------------------------------------------------------------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="pages/services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="pages/rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="pages/recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="pages/contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="pages/receptions.php">
                            <img src="icons/calendar-check.svg" alt="Reservas"> <span data-section="nav" data-value="receptions">Reservas</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page"
                            href="codigo/registro_login/panel_registro_login.php"
                            style="color: #212529 !important;">
                            <i class="fas fa-user"></i> <span data-section="nav" data-value="perfilnav">Ingreso</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i><span data-section="nav" data-value="language">Idioma</span> 
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <div id="flags" class="flags_item dropdown-item" data-language="en">
                                    <img src="icons/gb.svg" alt="English" class="me-2" style="width: 20px" />
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es">
                                    <img src="icons/es.svg" alt="Español" class="me-2" style="width: 20px" />
                                    Español
                                </div>
                            </li>
                            <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                    src="icons/pt.svg" alt="Português" class="me-2" style="width: 20px;"> Português
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Agregar un div espaciador después del nav -->
    <div id="nav-spacer"></div>
    <!-----------------------------------------IMAGEN O VIDEO PRINCIPAL--------------------------------------------->
    <div class="row ratio ratio-16x9 video-first">
        <video src="video/video_pool.mp4" autoplay muted loop></video>
    </div>
    <!------------------------------------texto 1------------------------------------------------------------------>
    <div class="row text_entry" data-section="presentacion" data-value="texto">
        <p>Bienvenido al Hotel Continental, donde la elegancia y el confort se unen. Disfruta de nuestras
            instalaciones de primera clase y un servicio excepcional en el corazón de la ciudad. Tu satisfacción
            es
            nuestra prioridad.</p>
    </div>

    <!--------------------------------------------------Intersection Observer------------------------------->
    <div class="container-fluid observer contenedor-index">
        <!-----------------------------------------Images + texts side by side----------------------------------------------------->
        <div class="row hidden">
            <div class="col">
                <img src="images/hotel-exterior.jpg" class="img-fluid" alt="...">
            </div>

            <div class="col align-self-center texts" data-section="Home" data-value="first">
                <p>En el Hotel Continental vas a descubrir el lujo en el corazón palpitante de Buenos Aires. Nuestra
                    ubicación privilegiada te coloca a pasos
                    de los principales atractivos turisticos, tiendas de moda y restaurantes gourmet de la ciudad. Te
                    ofrecemos habitaciones elegantemente
                    decoradas, servicios de primera clase y una atención personalizada que hará de tu estancia una
                    experiencia inolvidable. ¡Reserva tu estancia hoy
                    mismo!</p>
            </div>
        </div>

        <div class="row hidden">
            <div class="col align-self-center texts" data-section="Home" data-value="second">
                <p>Sumérgete en una experiencia gastronómica excepcional en nuestro aclamado restaurante. Nuestro equipo
                    de cocina fusionan
                    magistralmente los sabores tradicionales argentinos con técnicas culinarias internacionales de
                    vanguardia. Desde los jugosos
                    cortes de carne argentina hasta delicados platos de inspiración mediterránea, cada bocado es una
                    celebración de sabores.
                    Acompaña tu comida con una selección de los mejores vinos de nuestras bodegas, cuidadosamente
                    elegidos para complementar
                    cada plato. El ambiente sofisticado y acogedor, con vistas panorámicas de la ciudad, crea el
                    escenario perfecto para
                    cenas románticas, reuniones de negocios o celebraciones especiales.</p>
            </div>
            <div class="col">
                <img src="images/bar_resto/restaurant.jpg" class="img-fluid" alt="...">
            </div>

        </div>

        <div class="row hidden">
            <div class="col">
                <img src="images/check-in.jpg" class="img-fluid" alt="...">
            </div>

            <div class="col align-self-center texts" data-section="Home" data-value="third">
                <p>En el Hotel Continental, entendemos que tu tiempo es valioso. Por eso, nuestro proceso de check-in es
                    rápido, eficiente
                    y sin complicaciones. Utilizamos la última tecnología para agilizar el proceso, permitiendote
                    acceder a tu habitación
                    en cuestión de minutos, asegurando que comiences tu experiencia sin demoras</p>
            </div>
        </div>
    </div>
    <!-----------------------------------------VIDEO image END--------------------------------------------->


    <!-------------------------------- slider con marcas---------------------------------------------->
    <div class="row justify-content slider">
        <div class="col slide-track">
            <div class="slide"><img src="images/supplier/coca-cola-logo-5.svg" alt=""></div>
            <div class="slide"><img src="images/supplier/don-perignon.png" alt=""></div>
            <!--  <div class="slide"><img src="images/supplier/logo_bousys.png" alt=""></div>--->
            <div class="slide"><img src="images/supplier/perrier.png" alt=""></div>
            <div class="slide"><img src="images/supplier/SFERRA_logo.jpg" alt=""></div>
            <div class="slide"><img src="images/supplier/versace.png" alt=""></div>

        </div>
    </div>
    <!-------------------------------------footer----------------------------------------------------->
    <footer class="bg-dark text-white pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4" >
                    <h5 data-section="footer" data-value="nosotros">Sobre Nosotros</h5>
                    <p data-section="footer" data-value="info">Información sobre la empresa.</p>
                </div>
                
                <div class="col-md-4">
                    <h5 data-section="footer" data-value="Links">Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="#index.php" class="text-white" data-section="footer" data-value="home">Inicio</a></li>
                        <li><a href="pages/rooms.html" class="text-white" data-section="footer" data-value="rooms">Habitaciones</a></li>
                        <li><a href="pages/services.html" class="text-white" data-section="footer" data-value="services">Servicios</a></li>
                        <li><a href="pages/recommendations.html" class="text-white" data-section="footer" data-value="recommendations">Recomendaciones</a></li>
                        <li><a href="pages/contacto.html" class="text-white" data-section="footer" data-value="contact">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4 whapp">
                    <img src="icons/whapp.png" alt="Quiero sumarme a la comunidad del hotel!!!" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                </div>
            </div>
            <div class="text-center py-3" data-section="footer" data-value="empresa">
                © 2024 Tu Empresa. Todos los derechos reservados.
            </div>
        </div>
    </footer>
    <!--------------------------modal whapp------------->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Whapp Community</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="images/QrHotel.png" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!---bootstrap js --->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var navbar = document.querySelector('.navbar');
            var navbarOffset = navbar.offsetTop;

            function updateNavbar() {
                if (window.pageYOffset >= navbarOffset) {
                    if (!navbar.classList.contains('fixed-top')) {
                        navbar.classList.add('fixed-top', 'scrolled');
                        document.body.classList.add('navbar-fixed');
                        document.body.style.paddingTop = navbar.offsetHeight + 'px';
                    }
                } else {
                    navbar.classList.remove('fixed-top', 'scrolled');
                    document.body.classList.remove('navbar-fixed');
                    document.body.style.paddingTop = 0;
                }
            }

            window.addEventListener('scroll', updateNavbar);
            window.addEventListener('resize', function () {
                navbarOffset = navbar.offsetTop;
                updateNavbar();
            });
        });
    </script>
</body>

</html>