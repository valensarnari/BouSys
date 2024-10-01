<?php

include ('../../conexion.php');

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

$insert = "INSERT INTO `usuario_empleados` (`Nombre`, `Email`, `Contrasena`, `Jerarquia`) VALUES ('$nombre', '$email', '$contrasena', '$rol');";
$query = mysqli_query($conexion, $insert);

if(!$query) {
    echo ("No se pudo insertar.");
}
else {
    header("Location: ../listado_empleados.php");
}