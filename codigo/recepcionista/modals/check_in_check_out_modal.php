<div class="modal fade" id="checkinCheckoutModal" tabindex="-1" aria-labelledby="checkinCheckoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkinCheckoutModalLabel">Check-in / Check-out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/check_in_check_out.php" method="POST">
                    <label for="reserva_id">ID Reserva:</label>
                    <input type="text" id="reserva_id" name="reserva_id" class="form-control" required><br>

                    <input type="radio" id="check_in" name="accion" value="check_in">
                    <label for="check_in">Check-in</label><br>

                    <input type="radio" id="check_out" name="accion" value="check_out">
                    <label for="check_out">Check-out</label><br><br>

                    <input type="submit" value="Actualizar" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
</div>
