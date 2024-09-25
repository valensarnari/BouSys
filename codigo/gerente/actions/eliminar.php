<?php

include ('../../conexion.php');

$id = $_POST['id'];

$delete = "DELETE FROM `usuario_empleados` WHERE `id` = $id;";
$query = mysqli_query($conexion, $delete);

if(!$query) {
    echo ("No se pudo eliminar.");
}
else {
    header("Location: ../listado_empleados.php");
}