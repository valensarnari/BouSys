<?php

// cierra cualquier sesion que ya estaba abierta
include('cerrar_conexion.php');

session_start();

include('conexion.php');

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

$consulta_existencia = mysqli_query(
    $conexion,
    "SELECT Email FROM cliente UNION SELECT Email FROM usuario_empleados"
);

if (mysqli_num_rows($consulta_existencia) > 0) {
    $sql = "SELECT id, Nombre, Email, Contrasena, Jerarquia 
                    FROM cliente 
                    WHERE Email = ?
                    UNION
                    SELECT id, Nombre, Email, Contrasena, Jerarquia 
                    FROM usuario_empleados 
                    WHERE Email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $stmt->bind_result($id, $nombre, $email, $hashed_password, $jerarquia);
    $stmt->fetch();

    if (password_verify($contrasena, $hashed_password)) {
        $_SESSION['id'] = $id;
        $_SESSION['Email'] = $email;
        $_SESSION['Nombre'] = $nombre;
        $_SESSION['Jerarquia'] = $jerarquia;

        
        if($jerarquia == 0) {
            header("Location: ../codigo/gerente/listado_empleados.php");
        } elseif($jerarquia == 1) {
            // header("Location: ../codigo/recepcionista");
        } else {
            // header("Location: ../codigo/cliente");
        }

        $stmt->close();
    } else {
        echo "Email o contraseña incorrectos1";
    }
} else {
    echo "Email o contraseña incorrectos";
}

$conexion->close();
