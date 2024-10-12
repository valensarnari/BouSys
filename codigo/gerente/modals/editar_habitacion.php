<!-- Modal -->
<div class="modal fade" id="editar<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="editarLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editar">Editar Habitacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/editar_habitacion.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Numero:</label>
                        <input class="form-control" type="text" name="numero" id="numero"
                            value="<?php echo $resultado['1'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo:</label>
                        <select class="form-select" name="tipo">
                            <option value="0" <?php if ($resultado['2'] == 0)
                                echo "selected" ?>>Simple
                            </option>
                            <option value="1" <?php if ($resultado['2'] == 1)
                                echo "selected" ?>>Doble
                            </option>
                            <option value="2" <?php if ($resultado['2'] == 2)
                                echo "selected" ?>>Suite
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio:</label>
                        <input class="form-control" type="number" name="precio" id="precio"
                            value="<?php echo $resultado['3'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado:</label>
                        <select class="form-select" name="estado">
                            <option value="0" <?php if ($resultado['4'] == 0)
                                echo "selected" ?>>Ocupado
                            </option>
                            <option value="1" <?php if ($resultado['4'] == 1)
                                echo "selected" ?>>Disponible
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Puntos:</label>
                        <input class="form-control" type="number" name="puntos" id="puntos"
                            value="<?php echo $resultado['5'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adultos:</label>
                        <input class="form-control" type="number" name="adultos" id="adultos"
                            value="<?php echo $resultado['6'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ninos:</label>
                        <input class="form-control" type="number" name="ninos" id="ninos"
                            value="<?php echo $resultado['7'] ?>">
                    </div>
                        <div class="my-4">
                            <input type="hidden" name="id" value="<?php echo $resultado['0'] ?>">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>