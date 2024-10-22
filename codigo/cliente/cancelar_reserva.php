<?php

//NO FUNCIONA TODAVIA!!!!!!!!!!!

$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
// Verificar si la conexión fue exitosa
if (!$conexion) {
    echo "Error de conexión";
    exit;
}

$id = intval($_GET['idReserva']);

// Eliminar la reserva de la base de datos
$sql = "UPDATE reserva_total SET `Estado` = 'Cancelada' WHERE id = $id";

if ($conexion->query($sql) === TRUE) {
    echo "Reserva cancelada correctamente.";
} else {
    echo "Error al cancelar la reserva: " . $conexion->error;
}

$conexion->close();

header('Location: mis_reservas.php');
?>