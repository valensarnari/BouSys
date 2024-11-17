<?php

include ('../../conexion.php');
include("../registro_login/validacion_sesion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$update = "UPDATE `cliente` SET `Nombre` = '$nombre', `Apellido` = '$apellido', `Email` = '$email', `Telefono` = '$telefono', `Contrasena` = '$contrasena' WHERE `cliente`.`id` = $id";
$query = mysqli_query($conexion, $update);

if(!$query) {
    echo ("No se pudo editar.");
}
else {
    header("Location: ../listado_clientes.php");
}