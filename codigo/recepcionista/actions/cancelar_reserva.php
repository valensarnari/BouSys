<?php
include('../../conexion.php');
//include("../registro_login/validacion_sesion.php");

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//$reserva_id = $_POST['reserva_id'];
$reserva_id = 13;
// Cambiar el estado de la reserva a 'Cancelada'
$query = "UPDATE reserva_total SET Estado = 'Cancelada' WHERE id = $reserva_id";
//---------------------tomo dato id cliente-------------------//
$consulta_id_cte = "SELECT id_cliente from reserva_total where reserva_total.id = $reserva_id";
$res_con = mysqli_query($conexion, $consulta_id_cte);
$fila_id_cte = mysqli_fetch_assoc($res_con);
//$fila_id_cte = intval($fila_id_cte);
var_dump($fila_id_cte);
//-------------------ver puntaje actual cliente------------------------------------------//
$cliente_puntos = "SELECT puntos FROM cliente WHERE id = $fila_id_cte";
$res_ptos_cte = mysqli_query($conexion, $cliente_puntos);
$fila_ptos_cte = mysqli_fetch_assoc($res_ptos_cte);
//var_dump($fila_ptos_cte);
//------------------dato id habitación-----------------------------//
//$consulta_rsv_habitacion = "SELECT 'id_habitacion' from 'reserva_habitacion r' WHERE $reserva_id = 'r.ID_Reserva'";
//$res = mysqli_query($conexion, $consulta_rsv_habitacion);
//$fila_id_habitacion = mysqli_fetch_assoc( $res);
//----------------dato puntos habitacion-----------------//
//$queryPtosHab = "SELECT puntos FROM habitacion WHERE id = $fila_id_habitacion";
//$res_1=mysqli_query($conexion, $queryPtosHab);
//$fila_puntos_hab= mysqli_fetch_assoc($res_1);
//----------------------------------------------------
//$cliente_resta="UPDATE 'cliente' SET 'Puntos'= 'Puntos'- $fila_id_habitacion['Puntos'] WHERE cliente.id = ";

/*
if (mysqli_query($conexion, $query)) {
    header("Location: ../reservas.php");
} else {
    echo "Error al cancelar la reserva: " . mysqli_error($conexion);
}*/
//}
?>