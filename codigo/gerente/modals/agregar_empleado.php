<!-- Modal -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="agregarLabel">Agregar empleado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/insertar_empleado.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input class="form-control" type="password" name="contrasena" id="contrasena">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rol:</label>
                        <select class="form-select" name="rol">
                            <option value="0">Gerente</option>
                            <option value="1" selected>Recepcionista</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <input class="btn btn-primary my-1" type="submit" value="Guardar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>