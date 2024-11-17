<?php
session_start(); // Iniciar la sesión

// Verificar si hay una sesión activa
if (isset($_SESSION['usuario_id'])) {
    // Destruir la sesión
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión

    // Redirigir a la página de login
    header("Location: panel_registro_login.php"); // Cambia esto a la ruta correcta
    exit;
} else {
    // Si no hay sesión activa, redirigir directamente a la página de login
    header("Location: panel_registro_login.php");
    exit;
}
?>
