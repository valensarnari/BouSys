<!-- Modal -->
<div class="modal fade" id="cancelar<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="cancelarLabel<?php echo $resultado['0'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelarLabel<?php echo $resultado['0'] ?>">¡Atención!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que deseas cancelar esta reserva?</p>
            </div>
            <div class="modal-footer">
                <form action="actions/cancelar_reserva.php" method="POST">
                    <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver atrás</button>
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
