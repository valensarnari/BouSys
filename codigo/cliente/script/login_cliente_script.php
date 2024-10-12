<?php

$conexion = mysqli_connect("localhost", "root", "", "hotel") 
or die('no se pudo conectar al servidor');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$documento = $_POST['documento'];
$nacionalidad = $_POST['nacionalidad'];
$sexo = $_POST['sexo'];
$nacimiento = $_POST['nacimiento'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$consulta_existencia = mysqli_query($conexion, "SELECT * FROM cliente where Documento ='$documento' OR Email = '$email'");

if(mysqli_num_rows($consulta_existencia) > 0)
{
    echo ("El usuario ya esta registrado.");
}
else 
{
    $sql =  "INSERT INTO `cliente` (`Nombre`, `Apellido`, `Fecha_Nacimiento`, `Documento`, `Nacionalidad`, `Sexo`, `Email`, `Telefono`, `Contrasena`, `Fecha_Registro`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssisssss", $nombre, $apellido, $nacimiento, $documento, $nacionalidad, $sexo, $email, $telefono, $contrasena);

    if($stmt->execute())
    {
        echo 'Registro exitoso';
    }
    else{
        echo "Error";
    }
     $stmt->close();


/*    $insert = "INSERT INTO `cliente` (`Nombre`, `Apellido`, `Fecha_Nacimiento`, `Documento`, `Nacionalidad`, `Sexo`, `Email`, `Telefono`, `Contrasena`, `Fecha_Registro`) VALUES ('$nombre', '$apellido', '$nacimiento', '$documento', '$nacionalidad', '$sexo', '$email', '$telefono', '$contrasena', NOW());";
    $query = mysqli_query($conexion, $insert);

    if(!$query) {
        echo ("No se pudo insertar.");
    }
    else {
        echo ("Insertado correctamente.");
    }
*/
}

$conexion->close();

?>
