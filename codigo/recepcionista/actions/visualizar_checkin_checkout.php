<?php
$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
//puse la conexion manual porque me tiraba error de direccionamiento, corregir y poner la direccion a conexion.php gio
if (!$conexion)
    echo "Error de conexión";

// Consulta para obtener las reservas con sus fechas de check-in y check-out
$sql = "SELECT id, ID_Cliente, Fecha_Inicio, Fecha_Fin, Check_In, Check_Out FROM reserva_total";
$result = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    // Mostrar el error específico de la consulta SQL
    die("Error en la consulta SQL: " . $conexion->error);
}

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>ID Reserva</th><th>ID Cliente</th><th>Fecha de Inicio</th><th>Fecha de Fin</th><th>Check-In</th><th>Check-Out</th></tr></thead><tbody>";

    // Mostrar cada reserva con sus fechas
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['ID_Cliente'] . "</td>";
        echo "<td>" . $row['Fecha_Inicio'] . "</td>";
        echo "<td>" . $row['Fecha_Fin'] . "</td>";
        echo "<td>" . $row['Check_In'] . "</td>";
        echo "<td>" . $row['Check_Out'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No hay reservas actualmente con fechas de check-in y check-out.</p>";
}


?>
