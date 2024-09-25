<!-- Modal -->
<div class="modal fade" id="editar<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="editarLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editar">Editar empleado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/editar.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre"
                            value="<?php echo $resultado['1'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control" type="text" name="email" id="email"
                            value="<?php echo $resultado['2'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input class="form-control" type="password" name="contrasena" id="contrasena"
                            value="<?php echo $resultado['3'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rol:</label>
                        <select class="form-select" name="rol">
                            <option value="0" <?php if ($resultado['4'] == 0)
                                echo "selected" ?>>Gerente</option>
                                <option value="1" <?php if ($resultado['4'] == 1)
                                echo "selected" ?>>Recepcionista</option>
                            </select>
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