<?php

include ('../../conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];

$update = "UPDATE `cliente` SET `Nombre` = '$nombre', `Apellido` = '$apellido', `Email` = '$email', `Telefono` = '$telefono', `Contrasena` = '$contrasena' WHERE `cliente`.`id` = $id";
$query = mysqli_query($conexion, $update);

if(!$query) {
    echo ("No se pudo editar.");
}
else {
    header("Location: ../listado_clientes.php");
}