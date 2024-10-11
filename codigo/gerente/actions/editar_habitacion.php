<?php

include ('../../conexion.php');

$id = $_POST['id'];
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$estado = $_POST['estado'];
$puntos = $_POST['puntos'];
$adultos = $_POST['adultos'];
$ninos = $_POST['ninos'];

$update = "UPDATE `habitacion` SET `Numero_Habitacion` = '$numero', `Tipo` = '$tipo', `Precio_Por_Noche` = '$precio', `Estado` = '$estado', `Puntos` = '$puntos', `Cantidad_Adultos_Maximo` = '$adultos', `Cantidad_Ninos_Maximo` = '$ninos' WHERE `habitacion`.`id` = $id";
$query = mysqli_query($conexion, $update);

if(!$query) {
    echo ("No se pudo editar.");
}
else {
    header("Location: ../listado_habitaciones.php");
}