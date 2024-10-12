<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    
    // Verificar que los campos no estén vacíos
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $conexion = new mysqli("localhost", "root", "", "proyectolabo");

        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        $stmt = $conexion->prepare("SELECT password, rol FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hash, $rol);
        $stmt->fetch();

        if ($hash && password_verify($password, $hash)) {
            $_SESSION['email'] = $email;
            $_SESSION['rol'] = $rol;
            $_SESSION['id'] = $user['id']; // Almacenar el ID del usuario en la sesión

            if ($rol == 'admin') {
                header("Location: seccion_admin/admin.php");
            } else {
                header("Location: seccion_cliente/cliente.php");
            }
            exit();
        } else {
            // Si la autenticación falla
            include("login_form.html");
            echo "<h1 class='bad'>ERROR EN LA AUTENTIFICACION</h1>";
        }

        $stmt->close();
        $conexion->close();
    } else {
        // Si los campos están vacíos
        include("login_form.html");
        echo "<h1 class='bad'>Por favor, rellene todos los campos</h1>";
    }
}
?>
