<?php
// Verificar si la sesión no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar sesión solo si no está activa
}

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
    0 => ['panel_gerente.php', 'listado_clientes.php', 'listado_empleados.php', 'listado_habitaciones.php', 'reporte.php'], // Gerente
    1 => ['panel_recepcionista.php', 'habitaciones.php', 'listado_clientes_recepcionista.php', 'reservas.php', 'nueva_reserva.php', 'primera.php', 'segunda.php', 'tercera.php', 'cuarta.php', 'quinta.php', 'sexta.php', 'reserva_confirmada.php', 'procesar_reserva.php'], // Recepcionista
    2 => ['perfil.php', 'mis_reservas.php', 'panel_cliente.php', 'uno.php', 'dos.php', 'tres.php', 'cuatro.php', 'cinco.php', 'confirmacion_reserva.php', 'realizar_reserva.php'] // Cliente
];

// Verificar si el usuario tiene acceso a la página actual
if (!isset($allowed_routes[$jerarquia]) || !in_array($current_file, $allowed_routes[$jerarquia])) {
    // Si no tiene acceso o la jerarquía no es válida, redirigir a la página correspondiente
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
            header("Location: ../registro_login/panel_registro_login.php");
            break;
    }
    exit; // Detener la ejecución del script
}
?>
