<?php
$sql_habitaciones = "SELECT h.Numero_Habitacion, h.Tipo, rh.Cantidad_Adultos, 
                           rh.Cantidad_Ninos, rh.Cuna 
                    FROM reserva_habitacion rh 
                    JOIN habitacion h ON rh.ID_Habitacion = h.id 
                    WHERE rh.ID_Reserva = " . $resultado['0'];
$query_habitaciones = mysqli_query($conexion, $sql_habitaciones);

if (mysqli_num_rows($query_habitaciones) > 0) {
    echo "<div class='list-group mb-4'>";
    while ($habitacion = mysqli_fetch_array($query_habitaciones)) {
        echo "<div class='list-group-item'>";
        echo "<div class='d-flex justify-content-between align-items-center'>";
        echo "<h6 class='mb-1'>Habitación " . $habitacion['Numero_Habitacion'] . " - " . $habitacion['Tipo'] . "</h6>";
        echo "</div>";
        echo "<p class='mb-1'>Adultos: " . $habitacion['Cantidad_Adultos'] . "</p>";
        echo "<p class='mb-1'>Niños: " . ($habitacion['Cantidad_Ninos'] ?? '0') . "</p>";
        echo "<p class='mb-0'>Cuna: " . ($habitacion['Cuna'] ? 'Sí' : 'No') . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p class='text-muted'>No hay habitaciones registradas para esta reserva.</p>";
}
?>
