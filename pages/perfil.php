<?php
include("../codigo/conexion.php");

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, redirigir a la página de login
    header("Location: ../codigo/registro_login/panel_registro_login.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles.css" rel="stylesheet">
</head>

<body class="container-fluid">
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <ul class="nav nav-pills myMenu">
        <div class="flags">
            <div id="flags" class="flags_item" data-language="en"><img src="../icons/gb.svg"></div>
            <div id="flag-es" class="flags_item_es" data-language="es"><img src="../icons/es.svg"></div>
        </div>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="codigo/registro_login/panel_registro_login.php"
                data-section="nav" data-value="login">Ingreso</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="../index.php" data-section="nav"
                data-value="home">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="services.html" data-section="nav" data-value="services">Servicios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="rooms.html" data-section="nav" data-value="rooms">Habitaciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="recommendations.html" data-section="nav"
                data-value="recommendations">Recomendaciones</a>
        </li>
        <li class="nav-item "></li>
        <a class="nav-link right" href="contacto.html">
            <p data-section="nav" data-value="signup">Contacto</p>
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="perfil.html" tabindex="-1" aria-disabled="true" data-section="nav"
                data-value="services">Perfil</a>
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

    <div class="container mt-5">
        <h2>Perfil de Usuario</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Información Personal</h5>
                <p><strong>Nombre:</strong> <?php echo $user['Nombre']; ?> </p>
                <p><strong>Apellido:</strong> <?php echo $user['Apellido']; ?> </p>
                <p><strong>Puntos:</strong> <?php echo $user['Puntos']; ?> </p>
                <p><strong>Documento:</strong> <?php echo $user['Documento']; ?> </p>
                <p><strong>Fecha de Nacimiento:</strong> <?php echo $user['Fecha_Nacimiento']; ?> </p>
                <p><strong>Sexo:</strong> <?php echo $user['Sexo']; ?> </p>
                <p><strong>Email:</strong> <?php echo $user['Email']; ?> </p>
                <p><strong>Teléfono:</strong> <?php echo $user['Telefono']; ?> </p>
                <p><strong>Fecha de Registro:</strong> <?php echo $user['Fecha_Registro']; ?> </p>
            </div>
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