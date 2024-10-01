<?php

include ('../../conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

$update = "UPDATE `usuario_empleados` SET `Nombre` = '$nombre', `Email` = '$email', `Contrasena` = '$contrasena', `Jerarquia` = '$rol' WHERE `usuario_empleados`.`id` = $id";
$query = mysqli_query($conexion, $update);

if(!$query) {
    echo ("No se pudo editar.");
}
else {
    header("Location: ../listado_empleados.php");
}