<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que los campos no estén vacíos
    if (!empty($_POST['nombre_completo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $nombre_completo = $_POST['nombre_completo'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        include("conexion.php");

        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_completo, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre_completo, $email, $password);

        if ($stmt->execute()) {
            header("Location: login_form.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conexion->close();
    } else {
        // Si los campos están vacíos
        include("registro_form.html");
        echo "<h1 class='bad'>Por favor, rellene todos los campos</h1>";
    }
}
?>

</body>
</html>
