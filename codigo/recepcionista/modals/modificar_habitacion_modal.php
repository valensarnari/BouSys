<?php
include("cancelar_reserva_modal.php");
?>
<!-- Modal -->
<div class="modal fade" id="modificar<?php echo $resultado['0'] ?>" tabindex="-1"
    aria-labelledby="modificarLabel<?php echo $resultado['0'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarLabel<?php echo $resultado['0'] ?>">Modificar Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/modificar_reserva.php" method="POST">
                    <div class="my-3">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control"
                            value="<?php echo $resultado['3'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha Fin:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control"
                            value="<?php echo $resultado['4'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="valor_total" class="form-label">Valor Total:</label>
                        <input type="number" id="valor_total" name="valor_total" class="form-control"
                            value="<?php echo $resultado['7'] ?>" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <?php if ($resultado['2'] !== 'Cancelada'): ?>
                        <div>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#cancelar<?php echo $resultado['0'] ?>" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                        </div>
                        <?php endif; ?>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver
                                atrás</button>
                            <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                            <input type="submit" value="Modificar" class="btn btn-warning">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
