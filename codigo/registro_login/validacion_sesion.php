<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, redirigir a la página de login
    header("Location: ../registro_login/panel_registro_login.php");
    exit;
}

// Obtener la jerarquía del usuario desde la sesión
$jerarquia = $_SESSION['usuario_jerarquia'];

// Obtener el archivo actual al que se está intentando acceder
$current_file = basename($_SERVER['PHP_SELF']);

// Definir las rutas permitidas según la jerarquía del usuario
$allowed_routes = [
    0 => ['panel_gerente.php'], // Gerente
    1 => ['panel_recepcionista.php'], // Recepcionista
    2 => ['panel_cliente.php'] // Cliente
];

// Verificar si el usuario tiene acceso a la página actual
if (!in_array($current_file, $allowed_routes[$jerarquia])) {
    // Si no tiene acceso, redirigirlo a su panel correspondiente
    switch ($jerarquia) {
        case 0: // Gerente
            header("Location: ../gerente/panel_gerente.php");
            break;
        case 1: // Recepcionista
            header("Location: ../recepcionista/panel_recepcionista.php");
            break;
        case 2: // Cliente
            header("Location: ../cliente/panel_cliente.php");
            break;
        default:
            // Si no se reconoce la jerarquía, redirigir al login
            header("Location: ../panel_registro_login.php");
            break;
    }
    exit; // Detener la ejecución del script
}
?>
