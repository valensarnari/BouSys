<!-- Modal -->
<div class="modal fade" id="eliminar<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eliminar">Atención!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Estás seguro que deseas eliminar este empleado?
            </div>
            <div class="modal-footer">
                <form action="actions/eliminar_empleado.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $resultado['0'] ?>">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>