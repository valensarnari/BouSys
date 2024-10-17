
<!-- Modal -->
<div class="modal fade" id="detalle<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="detalleLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detalle">Detalle cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6"><label class="form-label">Nombre:</label>
                        <input disabled class="form-control" type="text" value="<?php echo $resultado['1'] ?>">
                    </div>
                    <div class="col-md-6"><label class="form-label">Apellido:</label>
                        <input disabled class="form-control" type="text" value="<?php echo $resultado['2'] ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Documento:</label>
                    <input disabled class="form-control" type="text" value="<?php echo $resultado['4'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nacionalidad:</label>
                    <input disabled class="form-control" type="text" value="<?php echo $resultado['5'] ?>">
                </div>
                <div class="row mb-3">
                    <div class="col-md-6"><label class="form-label">Sexo:</label>
                        <input disabled class="form-control" type="text" value="<?php echo $resultado['6'] ?>">
                    </div>
                    <div class="col-md-6"><label class="form-label">Fecha de nacimiento:</label>
                        <input disabled class="form-control" type="date" value="<?php echo $resultado['3'] ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input disabled class="form-control" type="text" value="<?php echo $resultado['7'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono:</label>
                    <input disabled class="form-control" type="text" value="<?php echo $resultado['8'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña:</label>
                    <input disabled class="form-control" type="password" value="<?php echo $resultado['9'] ?>">
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Fecha de registro:</label>
                        <input disabled class="form-control" type="datetime" value="<?php echo $resultado['10'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Puntos:</label>
                        <input disabled class="form-control" type="text" value="<?php echo $resultado['11'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>