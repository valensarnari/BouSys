<?php

include("../../conexion.php");



 
    
    // Consulta para obtener todas las habitaciones activas
    $sql = "SELECT Numero_Habitacion, Tipo, Estado, Precio_Por_Noche, Puntos, Cantidad_Adultos_Maximo, Cantidad_Ninos_Maximo 
            FROM habitacion 
            WHERE Activo = 1";
    $result = $conexion->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Número de Habitación</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Precio por Noche</th>
                <th>Puntos</th>
                <th>Adultos Máximo</th>
                <th>Niños Máximo</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["Numero_Habitacion"]) . "</td>
                    <td>" . htmlspecialchars($row["Tipo"]) . "</td>
                    <td>" . htmlspecialchars($row["Estado"]) . "</td>
                    <td>" . htmlspecialchars($row["Precio_Por_Noche"]) . "</td>
                    <td>" . htmlspecialchars($row["Puntos"]) . "</td>
                    <td>" . htmlspecialchars($row["Cantidad_Adultos_Maximo"]) . "</td>
                    <td>" . htmlspecialchars($row["Cantidad_Ninos_Maximo"]) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron habitaciones activas.";
    }
    
    
    ?>
    
