<?php
include ('../../conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $nuevo_valor = $_POST['nuevo_valor'];
    
    // Validar que la fecha de fin sea posterior a la de inicio
    if ($fecha_fin < $fecha_inicio) {
        $_SESSION['error'] = "La fecha de fin debe ser posterior a la fecha de inicio";
        header("Location: ../reservas.php");
        exit();
    }

    // Verificar disponibilidad de las habitaciones para las nuevas fechas
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
        $_SESSION['error'] = "Las habitaciones no están disponibles para las fechas seleccionadas";
        header("Location: ../reservas.php");
        exit();
    }

    // Validar el nuevo valor
    $sql_valor_original = "SELECT Valor_Total FROM reserva_total WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql_valor_original);
    mysqli_stmt_bind_param($stmt, "i", $reserva_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $valor_original = $row['Valor_Total'];

    if ($nuevo_valor < $valor_original || $nuevo_valor > ($valor_original * 2)) {
        $_SESSION['error'] = "El nuevo valor está fuera del rango permitido";
        header("Location: ../reservas.php");
        exit();
    }

    // Actualizar la reserva
    $sql_update = "UPDATE reserva_total 
                   SET Fecha_Inicio = ?, 
                       Fecha_Fin = ?,
                       Valor_Total = ? 
                   WHERE id = ?";
    
    $stmt = mysqli_prepare($conexion, $sql_update);
    mysqli_stmt_bind_param($stmt, "ssdi", $fecha_inicio, $fecha_fin, $nuevo_valor, $reserva_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Reserva modificada exitosamente";
    } else {
        $_SESSION['error'] = "Error al modificar la reserva";
    }
}

header("Location: ../reservas.php");
exit();
?>
