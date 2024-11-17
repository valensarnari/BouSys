<!-- Modal -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="agregarLabel">Agregar habitacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/insertar_habitacion.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Numero:</label>
                        <input class="form-control" type="text" name="numero" id="numero">
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Tipo:</label>
                        <select class="form-select" name="tipo">
                            <option value="0" selected >Simple</option>
                            <option value="1">Doble</option>
                            <option value="2">Suite</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio:</label>
                        <input class="form-control" type="number" name="precio" id="precio">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adultos:</label>
                        <input class="form-control" type="number" name="adultos" id="adultos">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ninos:</label>
                        <input class="form-control" type="number" name="ninos" id="ninos">
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