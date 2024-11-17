<?php
session_start();
include("../conexion.php");

// Verificar si el usuario ha iniciado sesión
if (!(isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2)) {
    // Si no hay sesión activa, redirigir a la página de login
    //echo "No hay sesión activa";
    header("Location: ../registro_login/panel_registro_login.php");
    exit();
}

$user_id = $_SESSION['usuario_id'];
$query = "SELECT * FROM cliente WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link href="../../styles.css" rel="stylesheet">
    <script src="../../script.js"></script>
    <link rel="icon" type="image/svg+xml" href="../../icons/perfil-png.png" />
    <style>
        .container.mt-5 {
            max-width: 600px;
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

        .card-title {
            color: #343a40;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #007bff;
            padding-bottom: 0.5rem;
            font-weight: bold;
            text-align: center;
        }

        .card-body p {
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 0.5rem;
        }

        .card-body p:last-child {
            border-bottom: none;
        }

        .card-body p strong {
            color: #495057;
            font-weight: 600;
            min-width: 40%;
        }

        .nav.nav-pills.menuPages {
            background-color: #e0f7fa;
            /* Azul claro/celeste */
        }

        .nav-link {
            color: #007bff;
        }

        .custom-navbar {
            background-color: #E6F3FF;
        }

        .custom-navbar .nav-link {
            color: #333333;
            font-weight: 500;
        }

        .custom-navbar .nav-link:hover {
            color: #0056b3;
        }

        .custom-navbar .dropdown-menu {
            background-color: #E6F3FF;
        }

        .custom-navbar .dropdown-item:hover {
            background-color: #CCE5FF;
        }
    </style>
</head>

<body class="container-fluid">
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
                    <?php
                    if (isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2) {
                        ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="panel_cliente.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <?php
                    } else {
                        ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
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
                            <i class="fas fa-user"></i> <span data-section="nav" data-value="perfilnav">Perfil</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="perfil.php" data-section="nav" data-value="perfil">Mi
                                    Perfil</a></li>
                            <li><a class="dropdown-item" href="mis_reservas.php" data-section="nav"
                                    data-value="reservas">Mis Reservas</a></li>
                            <li><a class="dropdown-item" href="../registro_login/cerrar_sesion.php" data-section="nav"
                                    data-value="close">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i><span data-section="nav" data-value="language">Idioma</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <div id="flags" class="flags_item dropdown-item" data-language="en"><img
                                        src="../../icons/gb.svg" alt="English" class="me-2" style="width: 20px;">
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es"><img
                                        src="../../icons/es.svg" alt="Español" class="me-2" style="width: 20px;">
                                    Español
                                </div>
                            </li>
                            <li>
                                <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                        src="../../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;">
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
        <h2 data-section="cliente_perfil.php" data-value="Perfil">Perfil de Usuario</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title " data-section="cliente_perfil.php" data-value="info">Información Personal</h5>
                <p><strong data-section="cliente_perfil.php" data-value="Nombre">Nombre:</strong>
                    <?php echo $user['Nombre']; ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Apellido">Apellido:</strong>
                    <?php echo $user['Apellido']; ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Puntos">Puntos:</strong>
                    <?php echo $user['Puntos']; ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Tipo de Documento">Tipo de Documento:</strong>
                    <?php echo 'DNI' //$user['tipo_de_documento']; ?>

                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Documento">Número:</strong>
                    <?php echo $user['Documento']; ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Nacimiento">Nacimiento:</strong>
                    <?php echo $user['Fecha_Nacimiento']; ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Sexo">Sexo:</strong>
                    <?php echo substr($user['Sexo'], 0, 1); ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Email">Email:</strong>
                    <?php echo $user['Email']; ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Telefono">Teléfono:</strong>
                    <?php echo $user['Telefono']; ?>
                </p>
                <p><strong data-section="cliente_perfil.php" data-value="Registro">Fecha de Registro:</strong>
                    <?php echo $user['Fecha_Registro']; ?>
                </p>

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
                        <li><a href="../../index.php" class="text-white" data-section="footer"
                                data-value="home">Inicio</a></li>
                        <li><a href="../../pages/rooms.php" class="text-white" data-section="footer"
                                data-value="rooms">Habitaciones</a></li>
                        <li><a href="../../pages/services.php" class="text-white" data-section="footer"
                                data-value="services">Servicios</a></li>
                        <li><a href="../../pages/recommendations.php" class="text-white" data-section="footer"
                                data-value="recommendations">Recomendaciones</a></li>
                        <li><a href="../../pages/contacto.php" class="text-white" data-section="footer"
                                data-value="contact">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4 whapp">
                    <img src="../../icons/whapp.png" alt="Quiero sumarme a la comunidad del hotel!!!"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                </div>
            </div>
            <div class="text-center py-3" data-section="footer" data-value="empresa">
                © 2024 Tu Empresa. Todos los derechos reservados.
            </div>
        </div>
    </footer>

</body>

</html>