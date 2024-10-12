<?php
session_start();
include("conexion.php");

// Verificar si el usuario está autenticado y si es administrador
if (isset($_SESSION['email']) && $_SESSION['rol'] == 'admin') {
    // Usuario autenticado y es administrador, se muestra la página del administrador
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Panel de Control - Admin</title>
        <link rel="stylesheet" href="styles_admin.css">
    </head>
    <body>
        <!-- Barra de navegación -->
        <nav>
            <div class="logo"><a href="admin.php">Panel Administrador</a></div>
            <ul>
                <li><a href="salir.php">Cerrar Sesion</a></li>
            </ul>
        </nav>

        <div class="container">
            <h1>Bienvenido</h1>
            <section>  
                <ul>
                    <li><a href="admin.php?section=properties">Propiedades</a></li>
                    <li><a href="admin.php?section=contacts">Contactos</a></li>
                    <li><a href="admin.php?section=users">Usuarios</a></li>
                </ul>
            </section>

            <div class="content">
                <?php
                if (isset($_GET['section'])) {
                    $section = $_GET['section'];
                } else {
                    $section = 'properties';
                }

                switch ($section) {
                    case 'properties':
                        include('admin_properties.php');
                        break;
                    case 'contacts':
                        include('admin_contacts.php');
                        break;
                    case 'users': 
                            include('admin_users.php');
                            break;
                    default:
                        include('admin_properties.php');
                }
                ?>
            </div>
        </div>

        <!-- Pie de página -->
        <footer>
            <p>Cieri Propiedades &copy; 2024</p>
        </footer>
    </body>
    </html>
    <?php
} else {
    // Si no está autenticado o no es administrador, redirigir a la página de inicio de sesión
    header('Location: ../login_form.html');
    exit();
}
?>
