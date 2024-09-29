<?php

include ('../../conexion.php');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$documento = $_POST['documento'];
$nacionalidad = $_POST['nacionalidad'];
$sexo = $_POST['sexo'];
$nacimiento = $_POST['nacimiento'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];

$insert = "INSERT INTO `cliente` (`Nombre`, `Apellido`, `Fecha_Nacimiento`, `Documento`, `Nacionalidad`, `Sexo`, `Email`, `Telefono`, `Contrasena`, `Fecha_Registro`) VALUES ('$nombre', '$apellido', '$nacimiento', '$documento', '$nacionalidad', '$sexo', '$email', '$telefono', '$contrasena', NOW());";
$query = mysqli_query($conexion, $insert);

if(!$query) {
    echo ("No se pudo insertar.");
}
else {
    header("Location: ../listado_clientes.php");
}