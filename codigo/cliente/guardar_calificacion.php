<?php
session_start();
include("../conexion.php");

// Verificar si el usuario ha iniciado sesión
if (!(isset($_SESSION['usuario_jerarquia']) && $_SESSION['usuario_jerarquia'] == 2)) {
    header("Location: ../registro_login/panel_registro_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reserva = $_POST['id_reserva'];
    $calificacion = $_POST['calificacion'];
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;

    // Verificar que la reserva pertenezca al usuario actual
    $sql_verificar = "SELECT rt.* FROM reserva_total rt 
                     WHERE rt.id = ? AND rt.ID_Cliente = ? 
                     AND rt.Fecha_Fin < CURDATE()";
    
    $stmt = mysqli_prepare($conexion, $sql_verificar);
    mysqli_stmt_bind_param($stmt, "ii", $id_reserva, $_SESSION['usuario_id']);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        // Verificar que no exista una calificación previa
        $sql_check = "SELECT id FROM calificaciones WHERE ID_Reserva = ?";
        $stmt_check = mysqli_prepare($conexion, $sql_check);
        mysqli_stmt_bind_param($stmt_check, "i", $id_reserva);
        mysqli_stmt_execute($stmt_check);
        $result_check = mysqli_stmt_get_result($stmt_check);

        if (mysqli_num_rows($result_check) == 0) {
            // Insertar la calificación
            $sql_insertar = "INSERT INTO calificaciones (Calificacion, Comentario, ID_Reserva) VALUES (?, ?, ?)";
            $stmt_insertar = mysqli_prepare($conexion, $sql_insertar);
            mysqli_stmt_bind_param($stmt_insertar, "isi", $calificacion, $comentario, $id_reserva);
            
            if (mysqli_stmt_execute($stmt_insertar)) {
                header("Location: mis_reservas.php?success=1");
                exit();
            } else {
                header("Location: mis_reservas.php?error=1");
                exit();
            }
        } else {
            header("Location: mis_reservas.php?error=2"); // Ya existe una calificación
            exit();
        }
    } else {
        header("Location: mis_reservas.php?error=3"); // No autorizado
        exit();
    }
} else {
    header("Location: mis_reservas.php");
    exit();
}
