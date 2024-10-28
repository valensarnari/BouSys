<?php
require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $reserva_id = $_POST['reserva_id'];
    
    // Primero verificar disponibilidad de las habitaciones
    $sql_verificar = "SELECT h.id, h.Numero_Habitacion 
                     FROM reserva_habitacion rh 
                     JOIN habitacion h ON rh.ID_Habitacion = h.id 
                     WHERE rh.ID_Reserva = ? 
                     AND EXISTS (
                         SELECT 1 
                         FROM reserva_habitacion rh2 
                         JOIN reserva_total rt ON rh2.ID_Reserva = rt.id 
                         WHERE rh2.ID_Habitacion = h.id 
                         AND rt.Estado = 'Confirmada'
                         AND rt.id != ?
                         AND (
                             (? BETWEEN rt.Fecha_Inicio AND rt.Fecha_Fin)
                             OR (? BETWEEN rt.Fecha_Inicio AND rt.Fecha_Fin)
                             OR (rt.Fecha_Inicio BETWEEN ? AND ?)
                         )
                     )";
                     
    $stmt = mysqli_prepare($conexion, $sql_verificar);
    mysqli_stmt_bind_param($stmt, "iissss", $reserva_id, $reserva_id, $fecha_inicio, $fecha_fin, $fecha_inicio, $fecha_fin);
    mysqli_stmt_execute($stmt);
    $resultado_verificacion = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($resultado_verificacion) > 0) {
        // Hay habitaciones no disponibles
        $habitaciones_ocupadas = [];
        while ($row = mysqli_fetch_assoc($resultado_verificacion)) {
            $habitaciones_ocupadas[] = $row['Numero_Habitacion'];
        }
        
        echo json_encode([
            'success' => false,
            'message' => 'Las siguientes habitaciones no están disponibles para las fechas seleccionadas: ' . implode(', ', $habitaciones_ocupadas)
        ]);
        exit;
    }
    
    // Si llegamos aquí, las habitaciones están disponibles
    // Calcular la cantidad de días
    $fecha1 = new DateTime($fecha_inicio);
    $fecha2 = new DateTime($fecha_fin);
    $diff = $fecha1->diff($fecha2);
    $dias = $diff->days + 1; // +1 porque incluimos el día de inicio
    
    // Obtener las habitaciones de la reserva y sus precios
    $sql = "SELECT h.Precio_Por_Noche 
            FROM reserva_habitacion rh 
            JOIN habitacion h ON rh.ID_Habitacion = h.id 
            WHERE rh.ID_Reserva = ?";
            
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $reserva_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    $nuevo_valor = 0;
    while ($habitacion = mysqli_fetch_assoc($resultado)) {
        $nuevo_valor += $habitacion['Precio_Por_Noche'] * $dias;
    }
    
    echo json_encode([
        'success' => true,
        'nuevo_valor' => $nuevo_valor,
        'nuevo_valor_formateado' => number_format($nuevo_valor, 2, '.', ',')
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}
?> 