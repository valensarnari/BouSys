<?php

include ('../../conexion.php');

$id = $_POST['id'];

$delete = "DELETE FROM `cliente` WHERE `id` = $id;";
$query = mysqli_query($conexion, $delete);

if(!$query) {
    echo ("No se pudo eliminar.");
}
else {
    header("Location: ../listado_clientes.php");
}