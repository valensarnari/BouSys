<div class="modal fade" id="check_in<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="check_inLabel<?php echo $resultado['0'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="check_inLabel<?php echo $resultado['0'] ?>">Check-in / Check-out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/check_in_check_out.php" method="POST">
                    <div class="my-3">
                        <input checked type="radio" id="check_in" name="accion" value="check_in" class="form-check-input">
                        <label for="check_in" class="form-label">Check-in</label>
                    </div>
                    <div class="mb-3">
                        <input type="radio" id="check_out" name="accion" value="check_out" class="form-check-input">
                        <label for="check_out" class="form-label">Check-out</label>
                    </div>
                    <div class="my-5">
                        <input type="submit" value="Actualizar" class="btn btn-info">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver
                            atrás</button>
                        <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>