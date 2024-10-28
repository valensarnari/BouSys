<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

// Verificar que el pago fue exitoso
if (!isset($_GET['collection_status']) || $_GET['collection_status'] !== 'approved') {
    header("Location: cinco.php?error=pago_no_aprobado");
    exit();
}

$conexion->begin_transaction();

try {
    // Obtener datos de la URL
    $reserva_id = $_GET['reserva_id'];
    $reserva_fecha_inicio = $_GET['reserva_fecha_inicio'];
    $reserva_fecha_fin = $_GET['reserva_fecha_fin'];
    
    // Decodificar arrays
    $habitaciones_seleccionadas = json_decode(base64_decode($_GET['habitaciones']), true);
    $habitaciones_adultos = json_decode(base64_decode($_GET['habitaciones_adultos']), true);
    $habitaciones_ninos = json_decode(base64_decode($_GET['habitaciones_ninos']), true);
    $habitaciones_cuna = json_decode(base64_decode($_GET['habitaciones_cuna']), true);
    
    $reserva_cochera = isset($_GET['reserva_cochera']) ? $_GET['reserva_cochera'] : null;
    $valor_total = $_GET['valor_total'];

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

    $conexion->commit();

    header("Location: confirmacion_reserva.php");
    exit();

} catch (Exception $e) {
    $conexion->rollback();
    echo "Error al procesar la reserva: " . $e->getMessage();
    exit();
}
