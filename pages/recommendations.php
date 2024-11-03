<?php
session_start();
include("../codigo/conexion.php");
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
                        <a class="nav-link text-dark" href="../codigo/cliente/panel_cliente.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <?php
                    } else {
                        ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../index.php" data-section="nav"
                            data-value="home">Inicio</a>
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
                                    data-section="nav" data-value="close">Cerrar sesión</a></li>
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
        <div class="col-12">
            <div class="testimonials-header text-center">
                <h2 class="main-title" data-section="recommendations" data-value="comentarios">Comentarios de Nuestros Clientes</h2>
                <div class="title-decoration">
                    <span class="line"></span>
                    <i class="fas fa-hotel"></i>
                    <span class="line"></span>
                </div>
                <p class="subtitle" data-section="recommendations" data-value="descubre">Descubre las experiencias de quienes ya nos visitaron</p>
            </div>
            <div id="calificacionesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $query = "SELECT c.Calificacion, c.Comentario, 
                             GROUP_CONCAT(DISTINCT h.Tipo SEPARATOR ', ') as Habitaciones,
                             cl.Nombre, cl.Apellido
                             FROM calificaciones c
                             JOIN reserva_total rt ON c.ID_Reserva = rt.id
                             JOIN cliente cl ON rt.ID_Cliente = cl.id
                             JOIN reserva_habitacion rh ON rt.id = rh.ID_Reserva
                             JOIN habitacion h ON rh.ID_Habitacion = h.id
                             GROUP BY c.id";

                    $resultado = $conexion->query($query);
                    $first = true;

                    while ($row = $resultado->fetch_assoc()) {
                        $estrellas = str_repeat('⭐', $row['Calificacion']);
                        ?>
                        <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                            <div class="review-card mx-auto">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                                <div class="card-body">
                                    <div class="calificacion mb-3">
                                        <?php echo $estrellas; ?>
                                    </div>
                                    <p class="review-text"><?php echo htmlspecialchars($row['Comentario']); ?></p>
                                    <div class="reviewer-info">
                                        <h5 class="reviewer-name">
                                            <?php echo htmlspecialchars($row['Nombre'] . ' ' . $row['Apellido']); ?></h5>
                                        <p class="room-info">
                                            <i class="fas fa-bed"></i>
                                            <?php echo htmlspecialchars($row['Habitaciones']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $first = false;
                    }
                    $conexion->close();
                    ?>
                </div>

                <div class="carousel-controls">
                    <button class="control-button prev" type="button" data-bs-target="#calificacionesCarousel"
                        data-bs-slide="prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="control-button next" type="button" data-bs-target="#calificacionesCarousel"
                        data-bs-slide="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .testimonials-header {
            padding: 2rem 0 4rem;
        }

        .main-title {
            font-size: 2.8rem;
            color: #333;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
        }

        .title-decoration {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1.5rem 0;
        }

        .title-decoration .line {
            height: 2px;
            width: 60px;
            background: linear-gradient(to right, transparent, #FFD700, transparent);
            margin: 0 15px;
        }

        .title-decoration i {
            color: #FFD700;
            font-size: 1.8rem;
        }

        .subtitle {
            font-size: 1.2rem;
            color: #666;
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .carousel-section {
            background-color: #f8f9fa;
            padding: 4rem 0;
            position: relative;
        }

        .review-card {
            background: white;
            max-width: 800px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            margin: 1rem;
            position: relative;
            transition: transform 0.3s ease;
        }

        .quote-icon {
            position: absolute;
            top: -15px;
            right: 30px;
            background: #FFD700;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .review-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .reviewer-info {
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
            text-align: left;
        }

        .reviewer-name {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .room-info {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        .room-info i {
            margin-right: 8px;
            color: #FFD700;
        }

        .carousel-controls {
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 1rem;
        }

        .control-button {
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 50%;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .control-button:hover {
            background: #FFD700;
            color: white;
            transform: translateY(-2px);
        }

        .control-button i {
            font-size: 1.2rem;
        }

        .calificacion {
            font-size: 1.8rem;
            letter-spacing: 5px;
        }

        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 1rem;
                padding: 0 1rem;
            }

            .title-decoration .line {
                width: 40px;
            }

            .review-card {
                margin: 1rem;
                padding: 1.5rem;
            }

            .review-text {
                font-size: 1rem;
            }
        }
    </style>

    <br><br><br><br><br>
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
                        <li><a href="../index.php" class="text-white" data-section="footer" data-value="home">Inicio</a></li>
                        <li><a href="rooms.php" class="text-white" data-section="footer" data-value="rooms">Habitaciones</a></li>
                        <li><a href="services.php" class="text-white" data-section="footer" data-value="services">Servicios</a></li>
                        <li><a href="recommendations.php" class="text-white" data-section="footer" data-value="recommendations">Recomendaciones</a></li>
                        <li><a href="contacto.php" class="text-white" data-section="footer" data-value="contact">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4 whapp">
                    <img src="../icons/whapp.png" alt="Quiero sumarme a la comunidad del hotel!!!" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                </div>
            </div>
            <div class="text-center py-3" data-section="footer" data-value="empresa">
                © 2024 Tu Empresa. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Agregar después del nav -->
    <div id="nav-spacer"></div>

    <!-- Agregar antes del cierre del body -->
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

    <!---bootstrap js --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>