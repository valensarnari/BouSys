<?php

include ('../../conexion.php');


$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$estado = $_POST['estado'];
$puntos = $_POST['puntos'];
$adultos = $_POST['adultos'];
$ninos = $_POST['ninos'];

$insert = "INSERT INTO `habitacion` (`Numero_Habitacion`, `Tipo`, `Precio_Por_Noche`, `Estado`, `Puntos`, `Cantidad_Adultos_Maximo`, `Cantidad_Ninos_Maximo`) VALUES ('$numero', '$tipo', '$precio', '$estado', '$puntos', '$adultos', '$ninos');";
$query = mysqli_query($conexion, $insert);

if(!$query) {
    echo ("No se pudo insertar.");
}
else {
    header("Location: ../listado_habitaciones.php");
}