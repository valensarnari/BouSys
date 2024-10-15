<!-- Modal -->
<div class="modal fade" id="ingresar" tabindex="-1" aria-labelledby="ingresarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ingresarLabel">Ingresar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../BouSys/codigo/sigin_script.php" method="POST">
                    <div class="my-3">
                        <label class="form-label" for="email">Ingresa tu email:</label>
                        <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="contrasena">Ingresa tu contraseña:</label>
                        <input class="form-control" type="password" name="contrasena" placeholder="Contraseña">
                    </div>
                    <div class="my-3 d-flex justify-content-center">
                        <input class="btn btn-dark" type="submit" value="Iniciar sesión">
                        <div id="respuesta"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>