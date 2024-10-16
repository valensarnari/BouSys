<?php
include ('../../conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $valor_total = $_POST['valor_total'];

    // Actualizar la tabla reserva_total
    $query = "UPDATE reserva_total 
              SET Fecha_Inicio = '$fecha_inicio', Fecha_Fin = '$fecha_fin', Valor_Total = '$valor_total' 
              WHERE id = '$reserva_id'";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: ../reservas.php");
    } else {
        echo "Error al modificar la reserva: " . mysqli_error($conexion);
    }
}
?>
