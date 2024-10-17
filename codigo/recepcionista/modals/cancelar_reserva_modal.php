
<div class="modal fade" id="cancelarModal" tabindex="-1" aria-labelledby="cancelarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelarModalLabel">Cancelar Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/cancelar_reserva.php" method="POST">
                    <label for="reserva_id">ID Reserva:</label>
                    <input type="text" id="reserva_id" name="reserva_id" class="form-control" required><br>
                    <input type="submit" value="Cancelar Reserva" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>
