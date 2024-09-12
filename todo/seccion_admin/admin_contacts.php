<?php

include("conexion.php");

// Verificar si el usuario está autenticado y si es administrador
if (isset($_SESSION['email']) && $_SESSION['rol'] == 'admin') {
    // Usuario autenticado y es administrador, se muestra la página del administrador
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Revisar Contactos</title>
</head>
<body>
    <h2>Revisar Contactos</h2>
    <table>
        <tr>
            
            <th>Nombre</th>
            <th>Email</th>
            <th>Asunto</th>
            <th>Comentario</th>
        </tr>
        <?php
        $consulta = "SELECT * FROM contactos";
        $resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo '<tr>';
                
                echo '<td>' . $row["nombre"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '<td>' . $row["asunto"] . '</td>';
                echo '<td>' . $row["comentario"] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No hay contactos.</td></tr>';
        }
        ?>
    </table>
</body>
</html>
<?php
} else {
    // Si no está autenticado o no es administrador, redirigir a la página de inicio de sesión
    header('Location: ../login_form.html');
    exit();
}
?>