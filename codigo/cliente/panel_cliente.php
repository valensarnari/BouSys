<?php
include("../registro_login/validacion_sesion.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
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
                    <img src="images/pool-2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Relax...</h5>
                        <p>Disfruta de nuestra espectacular piscina en el Hotel Continental, ideal para relajarte y
                            disfrutar del sol en pleno centro de Buenos Aires.</p>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img src="images/mujer_ventana.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Comodidad</h5>
                        <p>Disfruta de la máxima comodidad en el Hotel Continental, donde cada detalle está diseñado
                            para ofrecerte una estancia relajante y placentera en pleno centro de Buenos Aires.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/pileta_cielo.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Noche...</h5>
                        <p>Sumérgete en la vibrante noche porteña en el Hotel Continental, donde la energía de Buenos
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
    <!---------------------------------------------MENÚ------------------------------------------------------------->
    <ul class="nav nav-pills myMenu">
        <div class="flags">
            <div id="flags" class="flags_item" data-language="en"><img src="icons/gb.svg"></div>
            <div id="flag-es" class="flags_item_es" data-language="es"><img src="icons/es.svg"></div>
        </div>
        <li class="nav-item">
            <button type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#ingresar">
                Ingreso
            </button>
            <!-- <a class="nav-link active" aria-current="page" href="codigo/sigin.php" data-section="nav"
                data-value="login">Ingreso</a>-clientes ya reg, recepcio, gerente -->
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/services.html" data-section="nav" data-value="services">Servicios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/rooms.html" data-section="nav" data-value="rooms">Habitaciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/recommendations.html" data-section="nav"
                data-value="recommendations">Recomendaciones</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link right" href="codigo/registro_login/panel_registro_login.php">
                <p data-section="nav" data-value="signup">Registrarse</p>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link right" href="../registro_login/cerrar_sesion.php">
                <p data-section="nav" data-value="signup">cerrar sesion</p>
            </a>
        </li>

        <li class="nav-item ms-auto">
            <img src="../icons/calendar-check.svg"></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link right" href="pages/receptions.php">
                <p data-section="nav" data-value="receptions">Reservas</p>
            </a>
        </li>
    </ul>
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
    <div class="container-fluid observer">
        <!-----------------------------------------Images + texts side by side----------------------------------------------------->
        <div class="row hidden">
            <div class="col">
                <img src="images/hotel-corner.jpg" class="img-fluid" alt="...">
            </div>

            <div class="col align-self-center texts" data-section="Home" data-value="first">
                <p>Descubre el lujo en el corazón de Buenos Aires. El Hotel Continental ofrece elegancia, comodidad y
                    una ubicación inmejorable cerca de los principales atractivos turísticos. ¡Reserva tu estancia hoy
                    mismo!</p>
            </div>
        </div>

        <div class="row hidden">
            <div class="col align-self-center texts" data-section="Home" data-value="second">
                <p>Ubicado en el vibrante centro de Buenos Aires, el Hotel Continental te invita a disfrutar de una
                    estancia inolvidable. Su restaurante destaca por su alta calidad, combinando sabores locales e
                    internacionales en un ambiente sofisticado.</p>
            </div>
            <div class="col">
                <img src="images/bar_resto/resto_1.jpg" class="img-fluid" alt="...">
            </div>

        </div>

        <div class="row hidden">
            <div class="col">
                <img src="images/luggage-passport.jpg" class="img-fluid" alt="...">
            </div>

            <div class="col align-self-center texts" data-section="Home" data-value="third">
                <p>Además, nuestro proceso de check-in es rápido y eficiente, asegurando que comiences tu experiencia
                    sin demoras</p>
            </div>
        </div>
    </div>
    <!-----------------------------------------VIDEO image END--------------------------------------------->


    <!-------------------------------- slider con marcas---------------------------------------------->
    <div class="row justify-content slider">
        <div class="col slide-track">
            <div class="slide"><img src="images/supplier/coca-cola-logo-5.svg" alt=""></div>
            <div class="slide"><img src="images/supplier/don-perignon.png" alt=""></div>
            <div class="slide"><img src="images/supplier/perrier.png" alt=""></div>
            <div class="slide"><img src="images/supplier/SFERRA_logo.jpg" alt=""></div>
            <div class="slide"><img src="images/supplier/versace.png" alt=""></div>

        </div>
    </div>
    <!-------------------------------------footer----------------------------------------------------->
    <footer class="bg-dark text-white pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Formulario de contacto</h5>
                </div>
                <div class="col-md-6 whapp">
                    <img src="../icons/whapp.png" alt="Quiero sumarme a la comunidad del hotel!!!"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                </div>
            </div>
        </div>

    </footer>
    <!--------------------------modal whapp------------->
    <!-- Button trigger modal 
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>-->

    <!-- Modal -->
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
</body>

</html>