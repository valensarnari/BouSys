<?php
include ('../../conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    
    // Verificar disponibilidad
    $sql_check = "SELECT COUNT(*) as conflictos
                  FROM reserva_habitacion rh1
                  JOIN reserva_total rt1 ON rh1.ID_Reserva = rt1.id
                  WHERE rt1.id != ? 
                  AND rt1.Estado = 'Confirmada'
                  AND rt1.Fecha_Inicio <= ? 
                  AND rt1.Fecha_Fin >= ?
                  AND rh1.ID_Habitacion IN (
                      SELECT rh2.ID_Habitacion 
                      FROM reserva_habitacion rh2 
                      WHERE rh2.ID_Reserva = ?
                  )";
    
    $stmt = mysqli_prepare($conexion, $sql_check);
    mysqli_stmt_bind_param($stmt, "issi", $reserva_id, $fecha_fin, $fecha_inicio, $reserva_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row['conflictos'] > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Las habitaciones no están disponibles para las fechas seleccionadas'
        ]);
        exit();
    }

    // Calcular el nuevo precio
    $sql_precio = "SELECT h.Precio_Por_Noche, rh.Cantidad_Adultos, rh.Cantidad_Ninos
                   FROM reserva_habitacion rh
                   JOIN habitacion h ON rh.ID_Habitacion = h.id
                   WHERE rh.ID_Reserva = ?";
    
    $stmt = mysqli_prepare($conexion, $sql_precio);
    mysqli_stmt_bind_param($stmt, "i", $reserva_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $nuevo_valor = 0;
    $dias = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24);
    
    while ($habitacion = mysqli_fetch_assoc($result)) {
        $precio_base = $habitacion['Precio_Por_Noche'];
        $adultos = $habitacion['Cantidad_Adultos'];
        $ninos = $habitacion['Cantidad_Ninos'];
        
        // Cálculo del precio por habitación
        $precio_habitacion = $precio_base * $dias;
        $precio_habitacion += ($adultos > 2) ? ($adultos - 2) * ($precio_base * 0.2) * $dias : 0;
        $precio_habitacion += $ninos * ($precio_base * 0.1) * $dias;
        
        $nuevo_valor += $precio_habitacion;
    }

    echo json_encode([
        'success' => true,
        'nuevo_valor' => $nuevo_valor,
        'nuevo_valor_formateado' => number_format($nuevo_valor, 2)
    ]);
    exit();
}

echo json_encode([
    'success' => false,
    'message' => 'Solicitud inválida'
]); 