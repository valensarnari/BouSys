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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="../script.js"></script>
    <link rel="icon" type="image/svg+xml" href="../icons/contacto.png">
    <title>Contacto</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container.mt-5 {
            max-width: 900px;
            margin-top: 3rem !important;
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 0;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 0;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .contact-info {
            background-image: url('../images/hotel-exterior.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 2rem;
            height: 100%;
            position: relative;
        }

        .contact-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 123, 255, 0.7);
            z-index: 1;
        }

        .contact-info-content {
            position: relative;
            z-index: 2;
        }

        .contact-info h3 {
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
        }

        .contact-info i {
            margin-right: 10px;
        }
    </style>
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
                            data-bs-toggle="dropdown" aria-expanded="false" data-section="nav" data-value="language">
                            <i class="fas fa-globe"></i> Idioma
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
                            <li>
                                <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt">
                                    <img src="../icons/pt.svg" alt="Português" class="me-2" style="width: 20px" />
                                    Português
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="https://api.web3forms.com/submit" method="POST">
                            <!-- EN VALUE INCLUIR LA LLAVE QUE TE LEGA AL EMAIL  (WEB3FORMS)-->
                            <input type="hidden" name="apikey" value="3a048820-eb92-431f-a497-fc66b53cdee4">
                            <div class="mb-3">
                                <label for="name" class="form-label" data-section="contact.php_form"
                                    data-value="Nombre">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label" data-section="contact.php_form"
                                    data-value="Correo">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label" data-section="contact.php_form"
                                    data-value="Asunto">Asunto</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label" data-section="contact.php_form"
                                    data-value="Mensaje">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <input type="hidden" name="redirect" value="https://web3forms.com/success">
                            <button type="submit" class="btn btn-primary" data-section="contact.php_form"
                                data-value="boton">Enviar mensaje</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-info">
                            <div class="contact-info-content">
                                <h3 data-section="contact.php_body" data-value="info">Información de contacto</h3>
                                <p><i class="fas fa-map-marker-alt"></i> Calle Ficticia 123, Ciudad Imaginaria</p>
                                <p><i class="fas fa-phone"></i> +34 123 456 789</p>
                                <p><i class="fas fa-envelope"></i> info@continentalhotel.com</p>
                                <p><i class="fas fa-clock"></i><span data-section="contact.php_body"
                                        data-value="horario"> Lunes a Viernes, 9:00 - 18:00</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------------------footer----------------------------------------------------->
    <footer class="bg-dark text-white pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 data-section="footer" data-value="nosotros">Sobre Nosotros</h5>
                    <p data-section="footer" data-value="info">Información sobre la empresa.</p>
                </div>

                <div class="col-md-4">
                    <h5 data-section="footer" data-value="Links">Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="../index.php" class="text-white" data-section="footer" data-value="home">Inicio</a>
                        </li>
                        <li><a href="rooms.php" class="text-white" data-section="footer"
                                data-value="rooms">Habitaciones</a></li>
                        <li><a href="services.php" class="text-white" data-section="footer"
                                data-value="services">Servicios</a></li>
                        <li><a href="recommendations.php" class="text-white" data-section="footer"
                                data-value="recommendations">Recomendaciones</a></li>
                        <li><a href="contacto.php" class="text-white" data-section="footer"
                                data-value="contact">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4 whapp">
                    <img src="../icons/whapp.png" alt="Quiero sumarme a la comunidad del hotel!!!"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                </div>
            </div>
            <div class="text-center py-3" data-section="footer" data-value="empresa">
                © 2024 Tu Empresa. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Agregar este script antes del cierre del body -->
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