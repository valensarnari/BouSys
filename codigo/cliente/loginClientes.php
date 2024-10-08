<?php

$conexion = new mysqli("localhost", "root", "", "BouSys");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$documento = $_POST['documento'];
$nacionalidad = $_POST['nacionalidad'];
$sexo = $_POST['sexo'];
$telefono = $_POST['phone'];
$mail = $_POST['mail'];
$constraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

$consulta_existencia = mysqli_query(
    $conexion, "SELECT * FROM clientes where documento ='$documento' OR mail = '$mail'");

if(mysqli_num_rows($consulta_existencia) > 0)
{
    echo "El usuario ya esta registrado";
}
else
{
    $sql =  "INSERT INTO clientes(nombre, apellido, fecha_nacimiento, documento, nacionalidad,
    sexo, telefono, mail, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssssss", $nombre, $apellido, $fecha_nacimiento, $documento, $nacionalidad,
     $sexo, $telefono, $mail, $constraseña);

    if($stmt->execute())
    {
        echo 'Registro exitoso';
    }
    else{
        echo "Error";
    }
     $stmt->close();
}

$conexion->close();

?>