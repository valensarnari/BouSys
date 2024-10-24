<?php

include ('../../conexion.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_cochera = $_POST['numero_cochera'];
    $nuevo_estado = $_POST['nuevo_estado_cochera'];

    // Consulta para actualizar el estado de la cochera
    $update = "UPDATE cochera SET Estado = '$nuevo_estado' WHERE Numero_Cochera = $numero_cochera";
    $query = mysqli_query($conexion, $update);

    if (!$query) {
        echo "No se pudo actualizar el estado de la cochera.";
    } else {
        header("Location: ../habitaciones.php"); // Redirigir a habitaciones.php
        exit(); // Terminar la ejecución después de la redirección
    }
}

