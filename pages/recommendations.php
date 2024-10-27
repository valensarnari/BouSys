<?php
session_start();
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
    <link href="../styles.css" rel="stylesheet">
    <script src="../script.js"></script>
    <link rel="icon" type="image/svg+xml" href="../icons/suitcase.png">
    <title>Opinions</title>
</head>

<body class="container-fluid">
    <!-------------------------------------------------------Titulo top------------------------------>
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <!---------------------------------------------MENÚ------------------------------------------------------------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if (isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../codigo/cliente/panel_cliente.php" data-section="nav" data-value="home">Inicio</a>
                    </li>
                    <?php
                    } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../index.php" data-section="nav" data-value="home">Inicio</a>
                    </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="receptions.php">
                            <img src="../icons/calendar-check.svg" alt="Reservas" /><span data-section="nav" data-value="receptions">Reservas</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2) {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="perfilDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color: #212529 !important;">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
                            <li><a class="dropdown-item" href="../codigo/cliente/perfil.php" data-section="nav"
                                    data-value="perfil">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="../codigo/cliente/mis_reservas.php" data-section="nav"
                                    data-value="reservas">Mis Reservas</a></li>
                            <li><a class="dropdown-item" href="../codigo/registro_login/cerrar_sesion.php"
                                    data-section="nav" data-value="cerrar-sesion">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <?php
                    } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page"
                            href="../codigo/registro_login/panel_registro_login.php" data-section="nav"
                            data-value="login" style="color: #212529 !important;">
                            <i class="fas fa-user"></i> Ingreso
                        </a>
                    </li>
                    <?php
                }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i> <span data-section="nav" data-value="language">Idioma</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <div id="flags" class="flags_item dropdown-item" data-language="en">
                                    <img src="../icons/gb.svg" alt="English" class="me-2" style="width: 20px" />
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es">
                                    <img src="../icons/es.svg" alt="Español" class="me-2" style="width: 20px" />
                                    Español
                                </div>
                            </li>
                            <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                    src="../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;"> Português
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!------------------------------------texto 1------------------------------------------------------------------>
    <div class="row recomendaciones">
        <div class="col-6 txt-opinions">
            <p>
                <b>María López</b>:<i> “Nuestra estancia en el Continental Hotel fue maravillosa. El personal fue muy
                    atento y las
                    instalaciones impecables. La única mejora sería ampliar el horario del spa. ¡Definitivamente
                    volveremos!”</i>
            </p>
            <p>
                <b>Carlos Fernández</b>: <i>“El hotel es excelente, con habitaciones cómodas y un servicio de primera.
                    Sería
                    genial si el desayuno tuviera más opciones vegetarianas. En general, una experiencia
                    fantástica.”</i>
            </p>
            <p>
                <b>Ana García:</b><i>“Disfrutamos mucho de nuestra estancia. La ubicación es perfecta y el servicio de
                    cuna
                    gratuito fue un gran plus. Solo sugeriría mejorar la velocidad del Wi-Fi en las habitaciones.”</i>
            </p>
            <p>
                <b>Revista Viajeros de Lujo:</b><i> “El Continental Hotel ofrece una combinación perfecta de lujo y
                    comodidad. Las
                    habitaciones son espaciosas y bien equipadas. Sería ideal contar con más opciones de entretenimiento
                    nocturno.</i>
            </p>
            <p>
                <b>Javier Martínez:</b><i> “El servicio de lavandería gratuito para clientes top es un detalle
                    excelente. La
                    piscina es un poco pequeña, pero el ambiente general del hotel es muy acogedor.”</i>
            </p>
            <p>
                <b>Laura Sánchez:</b><i> “Nos encantó la atención personalizada y la calidad de los servicios. El
                    restaurante
                    podría tener más opciones de menú, pero en general, todo fue perfecto.”</i>
            </p>
            <p>
                <b>Revista Hoteles y Estancias:</b><i> “El Continental Hotel destaca por su elegancia y atención al
                    detalle. Las
                    áreas comunes son hermosas y bien mantenidas. Una mejora sería ofrecer más actividades para
                    niños.”</i>
            </p>
            <p>
                <b>Pedro Gómez:</b><i> “La experiencia en el Continental Hotel fue inolvidable. El personal es muy
                    amable y
                    profesional. Sería bueno tener más enchufes en las habitaciones para cargar dispositivos.”</i>
            </p>
            <p>
                <b>Isabel Ruiz:</b><i> “El hotel es precioso y muy bien ubicado. El servicio de habitaciones es rápido y
                    eficiente. Solo sugeriría mejorar la iluminación en los pasillos.”</i>
            </p>
            <p>
                <b>Revista Escapadas de Ensueño:</b><i> “El Continental Hotel es una joya en el corazón de la ciudad.
                    Las
                    instalaciones son modernas y confortables. Sería perfecto si el gimnasio tuviera más equipos.”</i>
            </p>
        </div>
        <div class="col-6">
            <img class="img-fluid" src="../images/sauna.jpg">
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
</body>

</html>