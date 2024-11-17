<?php
include("eliminar_cliente.php");
?>
<!-- Modal -->
<div class="modal fade" id="editar<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="editarLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editar">Editar cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/editar_cliente.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre"
                            value="<?php echo $resultado['1'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido:</label>
                        <input class="form-control" type="text" name="apellido" id="apellido"
                            value="<?php echo $resultado['2'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control" type="text" name="email" id="email"
                            value="<?php echo $resultado['7'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono:</label>
                        <input class="form-control" type="text" name="telefono" id="telefono"
                            value="<?php echo $resultado['8'] ?>">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Contraseña:</label>
                        <input class="form-control" type="password" name="contrasena" id="contrasena"
                            value="<?php echo $resultado['9'] ?>">
                    </div>
                    <div class="my-3 d-flex justify-content-between">
                        <div>
                            <input type="hidden" name="id" value="<?php echo $resultado['0'] ?>">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver atrás</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#eliminar<?php echo $resultado['0'] ?>"
                                data-bs-dismiss="modal">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
