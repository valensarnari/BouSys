<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$conexion->begin_transaction();

try {

    $reserva_id = $_POST['reserva_id'];
    $reserva_fecha_inicio = $_POST['reserva_fecha_inicio'];
    $reserva_fecha_fin = $_POST['reserva_fecha_fin'];

    $valor_total = isset($_SESSION['valor_con_descuento']) ? $_SESSION['valor_con_descuento'] : 0;

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
    // Obtener puntos del cliente
    $sql_cliente = "SELECT puntos FROM cliente WHERE id = ?";
    $stmt_cliente = $conexion->prepare($sql_cliente);
    $stmt_cliente->bind_param("i", $reserva_id);
    $stmt_cliente->execute();
    $resultado_cliente = $stmt_cliente->get_result();
    $cliente = $resultado_cliente->fetch_assoc();
    $puntos_cliente = $cliente['puntos'];

    // Obtener puntos de las habitaciones seleccionadas
    $puntos_totales = 0;
    foreach ($habitaciones_seleccionadas as $habitacion_id) {
        $sql_habitacion = "SELECT Puntos FROM habitacion WHERE id = ?";
        $stmt_habitacion = $conexion->prepare($sql_habitacion);
        $stmt_habitacion->bind_param("i", $habitacion_id);
        $stmt_habitacion->execute();
        $resultado_habitacion = $stmt_habitacion->get_result();
        $habitacion = $resultado_habitacion->fetch_assoc();
        $puntos_totales += $habitacion['Puntos'];
    }

    // Actualizar puntos del cliente
    $sql_actualizar_puntos = "UPDATE cliente SET Puntos = ? WHERE id = ?";
    $nuevos_puntos = $puntos_cliente + $puntos_totales;
    $stmt_actualizar = $conexion->prepare($sql_actualizar_puntos);
    $stmt_actualizar->bind_param("ii", $nuevos_puntos, $reserva_id);
    $stmt_actualizar->execute();


    //-----------------ACTUUALIZA ESTADO HABITACIONES-----------------
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
    $valor_con_descuento = $_SESSION['valor_con_descuento'];
    $sql_pago = "INSERT INTO pago (Fecha_Pago, Medio_De_Pago, Total, ID_Reserva) 
                 VALUES (NOW(), ?, ?, ?)";
    $stmt_pago = $conexion->prepare($sql_pago);
    $stmt_pago->bind_param("sdi", $medio_pago, $valor_con_descuento, $id_reserva_total);
    $stmt_pago->execute();

    $conexion->commit();

    header("Location: reserva_confirmada.php");
    exit();

} catch (Exception $e) {
    $conexion->rollback();
    echo "Error al procesar la reserva: " . $e->getMessage();
    exit();
}
