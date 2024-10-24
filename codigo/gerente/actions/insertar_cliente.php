<?php

$conexion = mysqli_connect("localhost", "root", "", "hotel") 
or die('No se pudo conectar al servidor');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$documento = $_POST['documento'];
$nacionalidad = $_POST['nacionalidad'];
$sexo = $_POST['sexo'];
$nacimiento = $_POST['nacimiento'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Modificamos la consulta para usar prepared statements
$consulta_existencia = $conexion->prepare("SELECT * FROM cliente WHERE Documento = ? OR Email = ?");
$consulta_existencia->bind_param("ss", $documento, $email);
$consulta_existencia->execute();
$resultado = $consulta_existencia->get_result();

if($resultado->num_rows > 0)
{
    echo "El usuario ya está registrado.";
}
else 
{
    $sql = "INSERT INTO `cliente` (`Nombre`, `Apellido`, `Fecha_Nacimiento`, `Documento`, `Nacionalidad`, `Sexo`, `Email`, `Telefono`, `Contrasena`, `Fecha_Registro`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssisssss", $nombre, $apellido, $nacimiento, $documento, $nacionalidad, $sexo, $email, $telefono, $contrasena);

    if($stmt->execute())
    {
        header("Location: ../listado_clientes.php");
        exit();
    }
    else{
        echo "No se pudo insertar: " . $stmt->error;
    }
    $stmt->close();
}

$conexion->close();

?>
