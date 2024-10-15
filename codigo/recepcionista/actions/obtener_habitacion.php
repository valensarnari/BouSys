<?php
$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
// Verifica la conexión
if (!$conexion) {
    echo "Error de conexión";
}

// Consulta para obtener habitaciones disponibles
$query_habitaciones = "SELECT id, Numero_Habitacion, Tipo, Precio_Por_Noche 
                       FROM habitacion 
                       WHERE Estado = 'Disponible' AND Activo = 1";
$result_habitaciones = mysqli_query($conexion, $query_habitaciones);

$habitaciones = [];
if (mysqli_num_rows($result_habitaciones) > 0) {
    while ($row = mysqli_fetch_assoc($result_habitaciones)) {
        $habitaciones[] = $row;
    }
}
?>
