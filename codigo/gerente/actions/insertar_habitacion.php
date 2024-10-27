<?php

include ('../../conexion.php');
include("../registro_login/validacion_sesion.php");


$numero = $_POST['numero'];
if($_POST['tipo'] == 0) {
    $tipo = "Simple";
} else if($_POST['tipo'] == 1) {
    $tipo = "Doble";
} else {
    $tipo = "Suite";
}
$precio = $_POST['precio'];
if($tipo == "Simple") {
    $puntos = 50;
} else if($tipo == "Doble") {
    $puntos = 200;
} else {
    $puntos = 500;
}
$adultos = $_POST['adultos'];
$ninos = $_POST['ninos'];

$insert = "INSERT INTO `habitacion` (`Numero_Habitacion`, `Tipo`, `Precio_Por_Noche`, `Estado`, `Puntos`, `Cantidad_Adultos_Maximo`, `Cantidad_Ninos_Maximo`) VALUES ('$numero', '$tipo', '$precio', 'Disponible', '$puntos', '$adultos', '$ninos');";
$query = mysqli_query($conexion, $insert);

if(!$query) {
    echo ("No se pudo insertar.");
}
else {
    header("Location: ../listado_habitaciones.php");
}