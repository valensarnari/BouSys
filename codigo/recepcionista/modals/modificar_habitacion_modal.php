<?php
$conexion = mysqli_connect("localhost", "root", "", "hotel");
include("../registro_login/validacion_sesion.php");
//puse la conexion manual porque me tiraba error de direccionamiento, corregir y poner la direccion a conexion.php gio
if (!$conexion)
    echo "Error de conexión";


$salida = "";
?>

<div class="modal fade" id="modificarModal" tabindex="-1" aria-labelledby="modificarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarModalLabel">Modificar Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/modificar_reserva.php" method="POST">
                    <label for="reserva_id">ID Reserva:</label>
                    <!---   <input type="text" id="reserva_id" name="reserva_id" class="form-control" required><br>
--->
                    <?php
                    // Consulta para obtener los ID de reservas
                    $sql = "SELECT id FROM reserva_habitacion WHERE 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<label for="reserva_id">ID Reserva:</label>';
                        echo '<select id="reserva_id" name="reserva_id" class="form-control" required>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id_reserva"] . '">' . $row["id_reserva"] . '</option>';
                        }
                        echo '</select><br>';
                    } else {
                        echo "No se encontraron reservas";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>

                    <label for="fecha_inicio">Fecha Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required><br>

                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required><br>

                    <label for="valor_total">Valor Total:</label>
                    <input type="number" id="valor_total" name="valor_total" class="form-control" required><br>

                    <input type="submit" value="Modificar" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
</div>