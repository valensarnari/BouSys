

<!-- Modal -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="agregarLabel">Agregar cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/insertar_cliente.php" method="POST">
                    <div class="row my-3">
                        <div class="col-md-6"><label class="form-label">Nombre:</label>
                            <input class="form-control" type="text" name="nombre" id="nombre">
                        </div>
                        <div class="col-md-6"><label class="form-label">Apellido:</label>
                            <input class="form-control" type="text" name="apellido" id="apellido">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Documento:</label>
                        <input class="form-control" type="text" name="documento" id="documento">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nacionalidad:</label>
                        <input class="form-control" type="text" name="nacionalidad" id="nacionalidad">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6"><label class="form-label">Sexo:</label>
                            <select class="form-select" name="sexo">
                                <option value="Masculino" selected>Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="No binario">No binario</option>
                            </select>
                        </div>
                        <div class="col-md-6"><label class="form-label">Fecha de nacimiento:</label>
                            <input class="form-control" type="date" name="nacimiento" id="nacimiento">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono:</label>
                        <input class="form-control" type="text" name="telefono" id="telefono">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input class="form-control" type="password" name="contrasena" id="contrasena">
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