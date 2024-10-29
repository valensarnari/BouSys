<?php

include ('../../conexion.php');
include("../registro_login/validacion_sesion.php");

$id = $_POST['id'];
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

$update = "UPDATE `habitacion` SET `Numero_Habitacion` = '$numero', `Tipo` = '$tipo', `Precio_Por_Noche` = '$precio', `Puntos` = '$puntos', `Cantidad_Adultos_Maximo` = '$adultos', `Cantidad_Ninos_Maximo` = '$ninos' WHERE `habitacion`.`id` = $id";
$query = mysqli_query($conexion, $update);

if(!$query) {
    echo ("No se pudo editar.");
}
else {
    header("Location: ../listado_habitaciones.php");
}