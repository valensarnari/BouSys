<div class="modal fade" id="check_in<?php echo $resultado['0'] ?>" tabindex="-1" aria-labelledby="check_inLabel<?php echo $resultado['0'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title text-info" id="check_inLabel<?php echo $resultado['0'] ?>">
                    <i class="fas fa-door-open me-2"></i>Check-in / Check-out
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Verificar estado de check-in y check-out
                $tiene_checkin = $resultado['5'] != "0000-00-00 00:00:00" && $resultado['5'] !== null; // Check_In
                $tiene_checkout = $resultado['6'] != "0000-00-00 00:00:00" && $resultado['6'] !== null; // Check_Out

                if ($tiene_checkout) {
                    // Si ya tiene check-out, mostrar mensaje
                    ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Esta reserva ya tiene registrado el check-out (<?php echo $resultado['6'] ?>).
                    </div>
                    <?php
                } elseif ($tiene_checkin && !$tiene_checkout) {
                    // Si tiene check-in pero no check-out, solo mostrar opción de check-out
                    ?>
                    <form action="actions/check_in_check_out.php" method="POST">
                        <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                        <input type="hidden" name="accion" value="check_out">
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Esta reserva ya tiene registrado el check-in (<?php echo $resultado['5'] ?>).
                            Solo puede realizar el check-out.
                        </div>

                        <div class="modal-footer border-top border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-sign-out-alt me-2"></i>Realizar Check-out
                            </button>
                        </div>
                    </form>
                    <?php
                } else {
                    // Si no tiene check-in, mostrar formulario normal de check-in
                    ?>
                    <form action="actions/check_in_check_out.php" method="POST">
                        <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                        <input type="hidden" name="accion" value="check_in">
                        
                        <!-- Sección de Pago para Check-in -->
                        <div id="pagoSection<?php echo $resultado['0'] ?>">
                            <?php
                            // Calcular monto pendiente
                            $query_pagos = "SELECT COALESCE(SUM(Total), 0) as total_pagado FROM pago WHERE ID_Reserva = ?";
                            $stmt_pagos = mysqli_prepare($conexion, $query_pagos);
                            mysqli_stmt_bind_param($stmt_pagos, "i", $resultado['0']);
                            mysqli_stmt_execute($stmt_pagos);
                            $result_pagos = mysqli_stmt_get_result($stmt_pagos);
                            $total_pagado = mysqli_fetch_assoc($result_pagos)['total_pagado'];
                            
                            $monto_pendiente = $resultado['7'] - $total_pagado;
                            ?>
                            
                            <div class="alert alert-info">
                                <strong>Monto pendiente a pagar: $<?php echo number_format($monto_pendiente, 2) ?></strong>
                                <input type="hidden" name="monto" value="<?php echo $monto_pendiente ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Método de Pago</label>
                                <select name="medio_pago" class="form-select bg-dark text-light border-secondary" required>
                                    <option value="">Seleccione un método de pago</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Mercado Pago">Mercado Pago</option>
                                    <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                                    <option value="Tarjeta de débito">Tarjeta de débito</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer border-top border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-sign-in-alt me-2"></i>Realizar Check-in
                            </button>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
function togglePagoSection(id) {
    const pagoSection = document.getElementById('pagoSection' + id);
    const checkInRadio = document.getElementById('check_in_radio' + id);
    
    if (checkInRadio.checked) {
        pagoSection.style.display = 'block';
    } else {
        pagoSection.style.display = 'none';
    }
}
</script>