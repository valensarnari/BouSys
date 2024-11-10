<?php
session_start();
include("../conexion.php");
// Verificar si la conexión fue exitosa
if (!$conexion) {
    echo "Error de conexión";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email_login'];
    $contrasena = $_POST['password_login'];

    // Consultar el usuario en la tabla 'cliente' (con 'j' minúscula)
    $query_cliente = "SELECT * FROM cliente WHERE Email = '$email' AND Activo = 1";
    $result_cliente = mysqli_query($conexion, $query_cliente);

    if ($result_cliente && mysqli_num_rows($result_cliente) > 0) {
        $cliente = mysqli_fetch_assoc($result_cliente);

        // Verificar la contraseña ingresada con la almacenada en la base de datos
        if (password_verify($contrasena, $cliente['Contrasena'])) {
            // Si la contraseña es correcta, iniciar sesión y almacenar información de usuario en la sesión
            $_SESSION['usuario_id'] = $cliente['id'];
            $_SESSION['usuario_nombre'] = $cliente['Nombre'];
            $_SESSION['usuario_jerarquia'] = $cliente['Jerarquia']; // 'jerarquia' en minúscula

            // Redirigir según la jerarquía del usuario
            switch ($cliente['Jerarquia']) {
                case 0: // Gerente
                    header("Location: ../gerente/panel_gerente.php");
                    break;
                case 1: // Recepcionista
                    header("Location: ../recepcionista/panel_recepcionista.php");
                    break;
                case 2: // Cliente
                    header("Location: ../cliente/perfil.php");
                    break;
                default:
                    header("Location: panel_registro_login.php");
                    break;
            }
            exit; // Asegúrate de finalizar la ejecución después de redirigir

        } else {
            echo "Error: Contraseña incorrecta.";
        }
    } else {
        // Si no se encuentra en la tabla cliente, buscar en la tabla usuario_empleados (con 'J' mayúscula)
        $query_empleado = "SELECT * FROM usuario_empleados WHERE Email = '$email' AND Activo = 1";
        $result_empleado = mysqli_query($conexion, $query_empleado);

        if ($result_empleado && mysqli_num_rows($result_empleado) > 0) {
            $empleado = mysqli_fetch_assoc($result_empleado);

            // Verificar la contraseña ingresada con la almacenada en la base de datos
            if (password_verify($contrasena, $empleado['Contrasena'])) {
                // Si la contraseña es correcta, iniciar sesión y almacenar información de usuario en la sesión
                $_SESSION['usuario_id'] = $empleado['id'];
                $_SESSION['usuario_nombre'] = $empleado['Nombre'];
                $_SESSION['usuario_jerarquia'] = $empleado['Jerarquia']; // 'Jerarquia' con mayúscula

                // Redirigir según la jerarquía del usuario
                switch ($empleado['Jerarquia']) {
                    case 0: // Gerente
                        header("Location: ../gerente/panel_gerente.php");
                        break;
                    case 1: // Recepcionista
                        header("Location: ../recepcionista/panel_recepcionista.php");
                        break;
                    default:
                        header("Location: panel_registro_login.php");
                        break;
                }
                exit;
                
            } else {
                echo "Error: Contraseña incorrecta.";
            }
        } else {
            echo "Error: El correo electrónico no está registrado.";
        }
    }
}
?>
