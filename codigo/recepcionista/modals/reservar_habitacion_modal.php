<?php
// Incluir el archivo que obtiene las habitaciones
include 'actions/obtener_habitacion.php';
?>


<div class="modal fade" id="reservarModal" tabindex="-1" aria-labelledby="reservarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservarModalLabel">Reservar Habitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/reservar_habitacion.php" method="POST">
                    <label for="cliente_id">ID Cliente:</label>
                    <input type="text" id="cliente_id" name="cliente_id" class="form-control" required><br>

                    <label for="fecha_inicio">Fecha Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required><br>

                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required><br>

                    <label for="valor_total">Valor Total:</label>
                    <input type="number" id="valor_total" name="valor_total" class="form-control" required><br>

                    <!-- Selección de habitaciones dinámicas -->
                    <label for="habitaciones">Habitaciones:</label>
                    <div id="habitaciones">
                        <?php foreach ($habitaciones as $habitacion): ?>
                            <div class="habitacion">
                                <label for="habitacion_<?php echo $habitacion['id']; ?>">Habitación <?php echo $habitacion['Numero_Habitacion']; ?></label>
                                <input type="checkbox" id="habitacion_<?php echo $habitacion['id']; ?>" name="habitaciones[<?php echo $habitacion['id']; ?>][id]" value="<?php echo $habitacion['id']; ?>"> 
                                <input type="number" name="habitaciones[<?php echo $habitacion['id']; ?>][adultos]" placeholder="Adultos" required>
                                <input type="number" name="habitaciones[<?php echo $habitacion['id']; ?>][ninos]" placeholder="Niños">
                                <input type="checkbox" name="habitaciones[<?php echo $habitacion['id']; ?>][cuna]" value="1"> Cuna
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <input type="submit" value="Reservar" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript para deshabilitar inputs de habitaciones no seleccionadas
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.habitacion-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Deshabilitar todos los inputs de habitaciones
            checkboxes.forEach(cb => {
                if (cb !== this) {
                    cb.checked = false; // Desmarcar otros checkboxes
                    const inputs = cb.closest('.habitacion').querySelectorAll('input[type="number"], input[type="checkbox"]');
                    inputs.forEach(input => {
                        input.disabled = true; // Deshabilitar inputs
                    });
                } else {
                    const inputs = cb.closest('.habitacion').querySelectorAll('input[type="number"], input[type="checkbox"]');
                    inputs.forEach(input => {
                        input.disabled = false; // Habilitar inputs solo para la habitación seleccionada
                    });
                }
            });
        });
    });
});
</script>