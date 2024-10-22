<?php
include('../../conexion.php');
//include("../registro_login/validacion_sesion.php");

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//$reserva_id = $_POST['reserva_id'];
$reserva_id = 13;
// Cambiar el estado de la reserva a 'Cancelada'
$query = "UPDATE reserva_total SET Estado = 'Cancelada' WHERE id == $reserva_id";
// Obtener los puntos de la habitación
$sql1 = "SELECT h.Puntos
        FROM reserva_habitacion rh
        JOIN habitacion h ON rh.ID_Habitacion = h.id
        WHERE rh.ID_Reserva = $id_reserva";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $habitacion_puntos = $row1["Puntos"];
} else {
    echo "No se encontraron puntos para la reserva.";
    $habitacion_puntos = 0;
}
//Dato puntos del cliente-----------------

$sql2 = "SELECT ID_Cliente FROM reserva_total WHERE id = $id_reserva";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $id_cliente = $row2["ID_Cliente"];
} else {
    echo "No se encontró el cliente para la reserva.";
    $id_cliente = null;
}
//-------restar puntos al cliente que canceló rsv----------------------//

if ($id_cliente !== null) {
    $sql3 = "UPDATE cliente SET Puntos = Puntos - $habitacion_puntos WHERE id = $id_cliente";
    if ($conn->query($sql3) === TRUE) {
        echo "Puntos actualizados correctamente.";
    } else {
        echo "Error al actualizar los puntos: " . $conn->error;
    }
}

$conn->close();




/*
if (mysqli_query($conexion, $query)) {
    header("Location: ../reservas.php");
} else {
    echo "Error al cancelar la reserva: " . mysqli_error($conexion);
}*/
//}
?>