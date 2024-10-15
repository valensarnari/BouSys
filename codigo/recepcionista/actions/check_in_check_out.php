<?php
include ('../../conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];
    $accion = $_POST['accion']; // 'check_in' o 'check_out'

    if ($accion == 'check_in') {
        // Actualizar la columna Check_In
        $query = "UPDATE reserva_total SET Check_In = NOW() WHERE id = '$reserva_id'";
    } elseif ($accion == 'check_out') {
        // Actualizar la columna Check_Out
        $query = "UPDATE reserva_total SET Check_Out = NOW() WHERE id = '$reserva_id'";
    }

    if (mysqli_query($conexion, $query)) {
        echo ucfirst($accion) . " realizado con éxito!";
    } else {
        echo "Error al realizar " . ucfirst($accion) . ": " . mysqli_error($conexion);
    }
}
?>
