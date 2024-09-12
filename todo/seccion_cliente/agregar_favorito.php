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
    $email = $_SESSION['email'];

    // Verificar si el favorito ya existe
    $verificar_favorito = "SELECT * FROM favoritos WHERE usuario_email = '$email' AND propiedad_id = $propiedad_id";
    $resultado = mysqli_query($conexion, $verificar_favorito) or die(mysqli_error($conexion));

    if (mysqli_num_rows($resultado) == 0) {
        // Insertar nuevo favorito
        $insertar_favorito = "INSERT INTO favoritos (usuario_email, propiedad_id) VALUES ('$email', $propiedad_id)";
        if (mysqli_query($conexion, $insertar_favorito)) {
            echo "success";
        } else {
            echo "error: " . mysqli_error($conexion);
        }
    } else {
        echo "error: Esta propiedad ya está en tus favoritos.";
    }
} else {
    echo "error: propiedad_id no definido.";
}
?>
