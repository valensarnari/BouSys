<div class="modal fade" id="calificarModal<?php echo $resultado['0']; ?>" tabindex="-1" aria-labelledby="calificarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calificarModalLabel" data-section="calificar_modal.php" data-value="Calificar">Calificar Estadía</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="guardar_calificacion.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_reserva" value="<?php echo $resultado['0']; ?>">
                    
                    <div class="mb-3">
                        <label for="calificacion" class="form-label" data-section="calificar_modal.php" data-value="Calificacion">Calificación</label>
                        <select class="form-select" name="calificacion" required>
                            <option value="" data-section="calificar_modal.php" data-value="Seleccione">Seleccione una calificación</option>
                            <option value="1" data-section="calificar_modal.php" data-value="1">1 - Muy malo</option>
                            <option value="2" data-section="calificar_modal.php" data-value="2">2 - Malo</option>
                            <option value="3" data-section="calificar_modal.php" data-value="3">3 - Regular</option>
                            <option value="4" data-section="calificar_modal.php" data-value="4">4 - Bueno</option>
                            <option value="5" data-section="calificar_modal.php" data-value="5">5 - Excelente</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="comentario" class="form-label" data-section="calificar_modal.php" data-value="Comentario">Comentario (opcional)</label>
                        <textarea class="form-control" name="comentario" rows="3" placeholder="Escriba su comentario aquí..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span data-section="calificar_modal.php" data-value="Cancelar">Cancelar</span></button>
                    <button type="submit" class="btn btn-primary"><span data-section="calificar_modal.php" data-value="Guardar">Guardar Calificación</span></button>
                </div>
            </form>
        </div>
    </div>
</div> 