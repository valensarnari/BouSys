<?php
session_start();
include("../conexion.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
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

        .nav-link:hover {
            background-color: #b2ebf2;
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
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php" data-section="nav" data-value="home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/services.html" data-section="nav" data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/rooms.html" data-section="nav" data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/recommendations.html" data-section="nav" data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/contacto.html" data-section="nav" data-value="signup">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/receptions.php" data-section="nav" data-value="receptions">
                            <i class="fa-regular fa-calendar-check"></i> Reservas
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="perfil.php" data-section="nav" data-value="perfil">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="mis_reservas.php" data-section="nav" data-value="reservas">Mis Reservas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i> Idioma
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="#" data-language="en"><img src="../../icons/gb.svg" alt="English" class="me-2" style="width: 20px;"> English</a></li>
                            <li><a class="dropdown-item" href="#" data-language="es"><img src="../../icons/es.svg" alt="Español" class="me-2" style="width: 20px;"> Español</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Perfil de Usuario</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Información Personal</h5>
                <p><strong>Nombre:</strong> <?php echo $user['Nombre']; ?> </p>
                <p><strong>Apellido:</strong> <?php echo $user['Apellido']; ?> </p>
                <p><strong>Puntos:</strong> <?php echo $user['Puntos']; ?> </p>
                <p><strong>Documento:</strong> <?php echo $user['Documento']; ?> </p>
                <p><strong>Nacimiento:</strong> <?php echo $user['Fecha_Nacimiento']; ?> </p>
                <p><strong>Sexo:</strong> <?php echo $user['Sexo']; ?> </p>
                <p><strong>Email:</strong> <?php echo $user['Email']; ?> </p>
                <p><strong>Teléfono:</strong> <?php echo $user['Telefono']; ?> </p>
                <p><strong>Fecha de Registro:</strong> <?php echo $user['Fecha_Registro']; ?> </p>

            </div>
        </div>
    </div>
    <!-------------------------------------footer----------------------------------------------------->
    <footer class="bg-dark text-white pt-4 mt-5">
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
