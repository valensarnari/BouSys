<?php
session_start();
include("conexion.php");

// Verificar si el usuario está autenticado y si es cliente
if (isset($_SESSION['email']) && $_SESSION['rol'] == 'cliente') {
    // Usuario autenticado y es cliente, se muestra la página del cliente
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="styles_contacto_cliente.css">
    
</head>
<body>
   <!-- Barra de navegación -->
 <nav>
    <div class="logo"><a href="cliente.php">Cieri Propiedades</a></div>
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    <ul class="nav-links">
        <li><a href="cliente.php">Inicio</a></li>
        <li><a href="propiedades.php">Propiedades</a></li>
        <li><a href="favoritos.php">Favoritos</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="salir.php">Cerrar Sesion</a></li>
        
    </ul>
</nav>

    <!-- Formulario de Contacto -->
    <div class="container">
        <div class="box-info">
            <h1>CONTÁCTATE CON NOSOTROS</h1>
            <div class="data">
                <p><i class="fa-solid fa-phone"></i> +54 911 4443 2132</p>
                <p><i class="fa-solid fa-envelope"></i> BienesRaicesAhre@gmail.com</p>
                <p><i class="fa-solid fa-location-dot"></i> Av Corrientes 1234</p>
            </div>
            <div class="links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>
        <form action="enviar.php" method="post">
            <div class="input-box">
                <input type="text" name="nombre_completo" placeholder="Nombre y apellido" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" required placeholder="Correo electrónico">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input-box">
                <input type="text" name="asunto" placeholder="Asunto">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="input-box">
                <textarea name="comentario" placeholder="Escribe tu mensaje..."></textarea>
            </div>
            <button type="submit">Enviar mensaje</button>
        </form>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>Cieri Propiedades &copy; 2024</p>
    </footer>

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>

<?php
} else {
    // Si no está autenticado o no es cliente, redirigir a la página de inicio de sesión
    header('Location: ../login_form.html');
    exit();
}
?>