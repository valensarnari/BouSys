<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$conexion->begin_transaction();

try {
    
    $reserva_id = $_POST['reserva_id'];
    $reserva_fecha_inicio = $_POST['reserva_fecha_inicio'];
    $reserva_fecha_fin = $_POST['reserva_fecha_fin'];

    $valor_total = isset($_SESSION['valor_total']) ? $_SESSION['valor_total'] : 0;

    $habitaciones_seleccionadas = isset($_POST['habitaciones']) ? $_POST['habitaciones'] : [];
    $habitaciones_adultos = isset($_POST['habitaciones_adultos']) ? $_POST['habitaciones_adultos'] : [];
    $habitaciones_ninos = isset($_POST['habitaciones_ninos']) ? $_POST['habitaciones_ninos'] : [];
    $habitaciones_cuna = isset($_POST['habitaciones_cuna']) ? $_POST['habitaciones_cuna'] : [];
    
    $reserva_cochera = isset($_POST['reserva_cochera']) ? $_POST['reserva_cochera'] : null;

    if ($valor_total === null || $valor_total === '') {
        throw new Exception("El valor total de la reserva no puede ser nulo.");
    }

    $sql_reserva_total = "INSERT INTO reserva_total (ID_Cliente, Estado, Fecha_Inicio, Fecha_Fin, Fecha_Reserva, Valor_Total) VALUES (?, 'Confirmada', ?, ?, NOW(), ?)";
    $stmt_reserva_total = $conexion->prepare($sql_reserva_total);

    $stmt_reserva_total->bind_param("issd", $reserva_id, $reserva_fecha_inicio, $reserva_fecha_fin, $valor_total);
    $stmt_reserva_total->execute();
    $id_reserva_total = $stmt_reserva_total->insert_id;

    $sql_reserva_habitacion = "INSERT INTO reserva_habitacion (ID_Reserva, ID_Habitacion, Cantidad_Adultos, Cantidad_Ninos, Cuna) VALUES (?, ?, ?, ?, ?)";
    $stmt_reserva_habitacion = $conexion->prepare($sql_reserva_habitacion);

    foreach ($habitaciones_seleccionadas as $habitacion_id) {
        $cantidad_adultos = isset($habitaciones_adultos[$habitacion_id]) ? intval($habitaciones_adultos[$habitacion_id]) : 1;
        $cantidad_ninos = isset($habitaciones_ninos[$habitacion_id]) ? intval($habitaciones_ninos[$habitacion_id]) : 0;
        $cuna = isset($habitaciones_cuna[$habitacion_id]) ? intval($habitaciones_cuna[$habitacion_id]) : 0;

        $stmt_reserva_habitacion->bind_param("iiiii", $id_reserva_total, $habitacion_id, $cantidad_adultos, $cantidad_ninos, $cuna);
        $stmt_reserva_habitacion->execute();
    }

    if ($reserva_cochera !== null && $reserva_cochera !== '') {
        $sql_reserva_cochera = "INSERT INTO reserva_cochera (ID_Reserva, ID_Cochera) VALUES (?, ?)";
        $stmt_reserva_cochera = $conexion->prepare($sql_reserva_cochera);
        $stmt_reserva_cochera->bind_param("ii", $id_reserva_total, $reserva_cochera);
        $stmt_reserva_cochera->execute();
    }

    // Procesar el pago
    $medio_pago = $_POST['medio_pago'];
    $sql_pago = "INSERT INTO pago (Fecha_Pago, Medio_De_Pago, Total, ID_Reserva) 
                 VALUES (NOW(), ?, ?, ?)";
    $stmt_pago = $conexion->prepare($sql_pago);
    $stmt_pago->bind_param("sdi", $medio_pago, $valor_total, $id_reserva_total);
    $stmt_pago->execute();

    $conexion->commit();

    header("Location: reserva_confirmada.php");
    exit();

} catch (Exception $e) {
    $conexion->rollback();
    echo "Error al procesar la reserva: " . $e->getMessage();
    exit();
}
