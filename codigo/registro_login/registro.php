<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $nacionalidad = $_POST['nacionalidad'];
    $sexo = $_POST['sexo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    
    // Comprobar si la clave 'contrasena' existe en el array POST
    if(isset($_POST['contrasena'])) {
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Hash de la contraseña para mayor seguridad
    } else {
        echo "Error: La contraseña no fue proporcionada.";
        exit;
    }
    
   


    $jerarquia = 2; // Cliente por defecto

    // Verificar si el correo electrónico o el DNI ya están registrados en la tabla 'cliente'
    $query_check = "SELECT * FROM cliente WHERE Email = '$email' OR Documento = '$dni'";
    $result_check = mysqli_query($conexion, $query_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        echo "Error: El correo electrónico o DNI ya están registrados.";
    } else {
        // Insertar el nuevo cliente en la base de datos
        $query = "INSERT INTO cliente (Nombre, Apellido, Fecha_Nacimiento, Documento, Nacionalidad, Sexo, Email, Telefono, Contrasena, Fecha_Registro, jerarquia, Activo) 
                  VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$dni', '$nacionalidad', '$sexo', '$email', '$telefono', '$contrasena', NOW(), '$jerarquia', 1)";
        
        if (mysqli_query($conexion, $query)) {
            echo "Registro exitoso. Puedes iniciar sesión.";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
}
?>
