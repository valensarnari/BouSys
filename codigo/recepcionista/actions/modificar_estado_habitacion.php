<?php

$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
//puse la conexion manual porque me tiraba error de direccionamiento, corregir y poner la direccion a conexion.php gio
if (!$conexion)
    echo "Error de conexión";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_habitacion = $_POST['numero_habitacion'];
    $nuevo_estado = $_POST['nuevo_estado'];

    // Consulta para actualizar el estado de la habitación
    $update = "UPDATE habitacion SET Estado = '$nuevo_estado' WHERE Numero_Habitacion = $numero_habitacion";
    $query = mysqli_query($conexion, $update);

    if (!$query) {
        echo "No se pudo actualizar el estado.";
    } else {
        header("Location: ../habitaciones.php"); // Redirigir a habitaciones.php
        exit(); // Terminar la ejecución después de la redirección
    }
}

?>