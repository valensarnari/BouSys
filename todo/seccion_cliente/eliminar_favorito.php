<?php
include("conexion.php");
session_start();

// Verificar si el usuario está autenticado y es cliente
if (!isset($_SESSION['email']) || $_SESSION['rol'] != 'cliente') {
    header('Location: ../login_form.html');
    exit();
}

if (isset($_POST['propiedad_id'])) {
    $propiedad_id = $_POST['propiedad_id'];
    $user_email = $_SESSION['email'];

    // Eliminar favorito
    $eliminar_favorito = "DELETE FROM favoritos WHERE usuario_email = '$user_email' AND propiedad_id = $propiedad_id";
    if (mysqli_query($conexion, $eliminar_favorito)) {
        header("Location: favoritos.php");
        
    } else {
        echo "error: " . mysqli_error($conexion);
    }
} else {
    echo "error: propiedad_id no definido.";
}
?>
