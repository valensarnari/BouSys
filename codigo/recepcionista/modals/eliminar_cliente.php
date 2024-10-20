<!-- Modal -->
<div class="modal fade" id="eliminar<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="eliminarLabel<?php echo $resultado['0'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarLabel<?php echo $resultado['0'] ?>">¡Atención!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que deseas eliminar este cliente?</p>
                <p>Nombre: <?php echo $resultado['1'] . ' ' . $resultado['2']; ?></p>
                <p>Email: <?php echo $resultado['7']; ?></p>
            </div>
            <div class="modal-footer">
                <form action="actions/eliminar_cliente.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $resultado['0'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
