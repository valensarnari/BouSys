<?php

include ('../../conexion.php');

$id = $_POST['id'];

$delete = "UPDATE `habitacion` SET `Activo` = 0 WHERE `id` = $id;";
$query = mysqli_query($conexion, $delete);

if(!$query) {
    echo ("No se pudo eliminar.");
}
else {
    header("Location: ../listado_habitaciones.php");
}