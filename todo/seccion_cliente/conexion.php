<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'proyectolabo';

$conexion = new mysqli($host, $user, $password, $db);

if ($conexion->connect_error) {
    die('Error en la conexión: ' . $conexion->connect_error);
}
?>
