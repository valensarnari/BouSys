<?php
$conexion = new mysqli("localhost", "root", "", "proyectolabo");

if ($conexion->connect_error) {
    die('No se pudo conectar a la base de datos, por favor comuníquese con el administrador del sistema');
}
?>
