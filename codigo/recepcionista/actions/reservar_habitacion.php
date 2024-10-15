<?php
$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
// Conexión manual, luego puedes cambiar a tu archivo de conexión.
// Verifica que la conexión sea exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $cliente_id = $_POST['cliente_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $valor_total = $_POST['valor_total'];
    $habitaciones = isset($_POST['habitaciones']) ? $_POST['habitaciones'] : []; // Array de habitaciones seleccionadas

    // Verificar si hay habitaciones seleccionadas
    if (empty($habitaciones)) {
        echo "Error: No se seleccionaron habitaciones.";
        exit;
    }

    // Iniciar transacción
    mysqli_begin_transaction($conexion);
    
    try {
        // Insertar en la tabla reserva_total
        $query_reserva_total = "INSERT INTO reserva_total (ID_Cliente, Estado, Fecha_Inicio, Fecha_Fin, Fecha_Reserva, Valor_Total) 
                                VALUES ('$cliente_id', 'Confirmada', '$fecha_inicio', '$fecha_fin', NOW(), '$valor_total')";
        
        if (!mysqli_query($conexion, $query_reserva_total)) {
            throw new Exception("Error al crear la reserva: " . mysqli_error($conexion));
        }

        // Obtener el ID de la reserva generada
        $id_reserva_total = mysqli_insert_id($conexion);

        // Insertar habitaciones en la tabla reserva_habitacion
        foreach ($habitaciones as $habitacion) {
            // Manejo del checkbox de cuna
            $cuna = isset($habitacion['cuna']) ? 1 : 0;

            $query_habitacion = "INSERT INTO reserva_habitacion (ID_Reserva, ID_Habitacion, Cantidad_Adultos, Cantidad_Ninos, Cuna) 
                                 VALUES ('$id_reserva_total', '{$habitacion['id']}', '{$habitacion['adultos']}', '{$habitacion['ninos']}', '$cuna')";

            if (!mysqli_query($conexion, $query_habitacion)) {
                throw new Exception("Error al insertar habitación: " . mysqli_error($conexion));
            }
        }

        // Confirmar la transacción
        mysqli_commit($conexion);
        header("Location: ../reservas.php");
    } catch (Exception $e) {
        // Revertir los cambios si algo falla
        mysqli_rollback($conexion);
        echo "Error en la transacción: " . $e->getMessage();
    }
}
?>
