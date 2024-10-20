<?php
include ('../../conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];

    // Cambiar el estado de la reserva a 'Cancelada'
    $query = "UPDATE reserva_total SET Estado = 'Cancelada' WHERE id = '$reserva_id'";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: ../reservas.php");
    } else {
        echo "Error al cancelar la reserva: " . mysqli_error($conexion);
    }
}
?>
