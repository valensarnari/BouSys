<?php
$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
//puse la conexion manual porque me tiraba error de direccionamiento, corregir y poner la direccion a conexion.php gio
if (!$conexion)
    echo "Error de conexión";



// Consulta para obtener todas las reservas
$query = "SELECT rt.id, rt.Estado, rt.Fecha_Inicio, rt.Fecha_Fin, rt.Valor_Total, c.Nombre 
          FROM reserva_total rt 
          JOIN cliente c ON rt.ID_Cliente = c.id";
$result = mysqli_query($conexion, $query);
?>

<table>
    <tr>
        <th>ID Reserva</th>
        <th>Cliente</th>
        <th>Estado</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Valor Total</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['Nombre']; ?></td>
        <td><?php echo $row['Estado']; ?></td>
        <td><?php echo $row['Fecha_Inicio']; ?></td>
        <td><?php echo $row['Fecha_Fin']; ?></td>
        <td><?php echo $row['Valor_Total']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
