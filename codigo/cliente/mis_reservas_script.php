<?php

session_start();

$id = $_SESSION['usuario_id'];

$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
// Verificar si la conexión fue exitosa
if (!$conexion) {
    echo "Error de conexión";
    exit;
}

$sql = "SELECT 
    rt.id AS ID_Reserva, 
    rt.ID_Cliente, 
    rt.Valor_Total, 
    GROUP_CONCAT(h.Numero_Habitacion ORDER BY h.Numero_Habitacion SEPARATOR ', ') AS Numeros_Habitaciones_Reservadas, 
    SUM(rh.Cantidad_Adultos) AS Total_Adultos, 
    SUM(rh.Cantidad_Ninos) AS Total_Ninos, 
    rt.Fecha_Inicio, 
    rt.Fecha_Fin, 
    rt.Estado,  -- Traer el estado de la reserva
    CASE 
        WHEN rc.ID_Cochera IS NOT NULL THEN 'Sí' 
        ELSE 'No' 
    END AS Tiene_Garage, 
    CASE 
        WHEN SUM(rh.Cuna) > 0 THEN 'Sí' 
        ELSE 'No' 
    END AS Tiene_Cuna  -- Considerar si al menos una habitación tiene cuna
FROM 
    reserva_total rt
JOIN 
    reserva_habitacion rh ON rt.id = rh.ID_Reserva
JOIN 
    habitacion h ON rh.ID_Habitacion = h.id  
LEFT JOIN 
    reserva_cochera rc ON rt.id = rc.ID_Reserva
WHERE 
    rt.ID_Cliente = '$id'  -- Filtras por el ID del cliente
    AND rt.Estado != 'Cancelada'  -- Filtras para no mostrar reservas canceladas
GROUP BY 
    rt.id, rt.ID_Cliente, rt.Valor_Total, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Estado, rc.ID_Cochera;
";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="reservation-card">';
        echo '<div class="reservation-info">';
        echo '<strong>' . 'Habitaciones: ' . $row["Numeros_Habitaciones_Reservadas"] . '</strong>';
        echo 'Adultos: ' . $row["Total_Adultos"] . ' Menores: ' . $row["Total_Ninos"] . '<br>';
        echo 'Fecha de entrada: ' . $row["Fecha_Inicio"] . '<br>';
        echo 'Fecha de salida: ' . $row["Fecha_Fin"] . '<br>';
        echo 'Cochera: ' . $row['Tiene_Garage'] . '<br>';
        echo 'Cuna: ' . $row['Tiene_Cuna'] . '<br>';
        echo 'Valor: ' . $row["Valor_Total"];
        echo '</div>';
        echo '<button class="cancel-btn" onclick="cancelarReserva(' . $row["ID_Reserva"] . ')">Cancelar</button>';
        echo '</div>';
    }
} else {
    echo '<p>No tienes reservas activas.</p>';
}

$conexion->close();
?>