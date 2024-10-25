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
    <link rel="icon" type="image/svg+xml" href="../icons/contacto.png">
    <title>Contacto</title>
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
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../index.php" data-section="nav"
                            data-value="services">Inicio</a>
                    </li>
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
                            data-value="signup">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="receptions.php" data-section="nav" data-value="receptions">
                            <img src="../icons/calendar-check.svg" alt="Reservas" /> Reservas
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['usuario_id'])) {
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
                            <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                    src="../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;"> Português
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="contenedor-contacto">
        <div class="informacion-contacto">
            <h2>Información de Contacto</h2>
            <ul>
                <li><strong>Dirección:</strong> Calle Ficticia 123, Ciudad Imaginaria, País de Nunca Jamás</li>
                <li><strong>Teléfono:</strong> +34 123 456 789</li>
                <li><strong>Email:</strong> info@empresaficticia.com</li>
                <li><strong>Horario de atención:</strong> Lunes a Viernes, 9:00 - 18:00</li>
            </ul>
        </div>
        <div class="formulario-contacto">
            <h2>Formulario de Contacto</h2>
            <form action="#" method="post">
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div>
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="asunto">Asunto:</label>
                    <input type="text" id="asunto" name="asunto" required>
                </div>
                <div>
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
                </div>
                <div>
                    <button type="submit">Enviar mensaje</button>
                </div>
            </form>
        </div>
    </div>
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
</body>

</html>