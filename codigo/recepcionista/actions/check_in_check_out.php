<?php
include ('../../conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];
    $accion = $_POST['accion'];

    // Iniciar transacción
    mysqli_begin_transaction($conexion);

    try {
        if ($accion == 'check_in') {
            // Actualizar Check_In
            $query = "UPDATE reserva_total SET Check_In = NOW() WHERE id = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "i", $reserva_id);
            mysqli_stmt_execute($stmt);

            // Registrar el pago
            $monto = $_POST['monto'];
            $medio_pago = $_POST['medio_pago'];
            
            $query_pago = "INSERT INTO pago (Fecha_Pago, Medio_De_Pago, Total, ID_Reserva) 
                          VALUES (NOW(), ?, ?, ?)";
            $stmt_pago = mysqli_prepare($conexion, $query_pago);
            mysqli_stmt_bind_param($stmt_pago, "sdi", $medio_pago, $monto, $reserva_id);
            mysqli_stmt_execute($stmt_pago);

        } elseif ($accion == 'check_out') {
            // Actualizar Check_Out
            $query = "UPDATE reserva_total SET Check_Out = NOW() WHERE id = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "i", $reserva_id);
            mysqli_stmt_execute($stmt);
        }

        // Confirmar transacción
        mysqli_commit($conexion);
        
        header("Location: ../reservas.php");
        exit();

    } catch (Exception $e) {
        // Revertir transacción en caso de error
        mysqli_rollback($conexion);
        echo "Error: " . $e->getMessage();
        exit();
    }
}
