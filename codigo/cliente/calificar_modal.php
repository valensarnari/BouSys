<div class="modal fade" id="calificarModal<?php echo $resultado['0']; ?>" tabindex="-1" aria-labelledby="calificarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calificarModalLabel">Calificar Estadía</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="guardar_calificacion.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_reserva" value="<?php echo $resultado['0']; ?>">
                    
                    <div class="mb-3">
                        <label for="calificacion" class="form-label">Calificación</label>
                        <select class="form-select" name="calificacion" required>
                            <option value="">Seleccione una calificación</option>
                            <option value="1">1 - Muy malo</option>
                            <option value="2">2 - Malo</option>
                            <option value="3">3 - Regular</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentario (opcional)</label>
                        <textarea class="form-control" name="comentario" rows="3" placeholder="Escriba su comentario aquí..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Calificación</button>
                </div>
            </form>
        </div>
    </div>
</div> 