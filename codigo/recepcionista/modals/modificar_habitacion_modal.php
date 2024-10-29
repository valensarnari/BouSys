<?php
include("cancelar_reserva_modal.php");
?>
<!-- Modal -->
<div class="modal fade" id="modificar<?php echo $resultado['0'] ?>" tabindex="-1"
    aria-labelledby="modificarLabel<?php echo $resultado['0'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title text-info" id="modificarLabel<?php echo $resultado['0'] ?>">
                    <i class="fas fa-edit me-2"></i>Modificar Reserva
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de modificación -->
                <form action="actions/modificar_reserva.php" method="POST" id="formModificarReserva<?php echo $resultado['0'] ?>">
                    <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                    <input type="hidden" name="valor_original" value="<?php echo $resultado['7'] ?>">
                    <input type="hidden" name="nuevo_valor" id="input_nuevo_valor<?php echo $resultado['0'] ?>">
                    
                    <!-- Sección de fechas -->
                    <div class="card bg-secondary mb-4">
                        <div class="card-header bg-info text-dark">
                            <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Fechas de la Reserva</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" 
                                               id="fecha_inicio<?php echo $resultado['0'] ?>" 
                                               name="fecha_inicio" 
                                               class="form-control bg-dark text-light fecha-input"
                                               value="<?php echo $resultado['3'] ?>" 
                                               min="<?php echo date('Y-m-d'); ?>" 
                                               required>
                                        <label for="fecha_inicio">Fecha de Inicio</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" 
                                               id="fecha_fin<?php echo $resultado['0'] ?>" 
                                               name="fecha_fin" 
                                               class="form-control bg-dark text-light fecha-input"
                                               value="<?php echo $resultado['4'] ?>" 
                                               min="<?php echo date('Y-m-d'); ?>" 
                                               required>
                                        <label for="fecha_fin">Fecha de Fin</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información del precio -->
                    <div class="price-info-card" id="precio_info<?php echo $resultado['0'] ?>" style="display: none;">
                        <div class="card bg-dark border border-info mb-4">
                            <div class="card-header bg-info text-dark">
                                <h6 class="mb-0">
                                    <i class="fas fa-calculator me-2"></i>Resumen de Precios
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="price-details">
                                        <div class="price-item mb-2">
                                            <i class="fas fa-tag me-2"></i>
                                            <span class="price-label">Valor Original:</span>
                                            <span class="price-value">$<span id="valor_original<?php echo $resultado['0'] ?>"><?php echo number_format($resultado['7'], 2) ?></span></span>
                                        </div>
                                        <div class="price-item">
                                            <i class="fas fa-dollar-sign me-2"></i>
                                            <span class="price-label">Nuevo Valor:</span>
                                            <span class="price-value">$<span id="nuevo_valor<?php echo $resultado['0'] ?>">0.00</span></span>
                                        </div>
                                    </div>
                                    <div id="precio_validacion<?php echo $resultado['0'] ?>" class="text-end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Habitaciones -->
                    <div class="card bg-secondary mb-4">
                        <div class="card-header bg-info text-dark">
                            <h6 class="mb-0"><i class="fas fa-bed me-2"></i>Habitaciones Reservadas</h6>
                        </div>
                        <div class="card-body">
                            <?php include("habitaciones_reservadas.php"); ?>
                        </div>
                    </div>

                    <!-- Sección de Pagos -->
                    <div class="card bg-secondary mb-4">
                        <div class="card-header bg-info text-dark">
                            <h6 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Pagos Realizados</h6>
                        </div>
                        <div class="card-body">
                            <?php include("pagos_realizados.php"); ?>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between align-items-center border-top border-secondary pt-3">
                        <?php if ($resultado['2'] !== 'Cancelada'): ?>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#cancelar<?php echo $resultado['0'] ?>" data-bs-dismiss="modal">
                            <i class="fas fa-times-circle me-2"></i>Cancelar Reserva
                        </button>
                        <?php endif; ?>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-arrow-left me-2"></i>Volver
                            </button>
                            <button type="submit" class="btn btn-info ms-2" id="btnGuardar<?php echo $resultado['0'] ?>">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>

                <style>
                    .form-floating > .form-control {
                        background-color: #2a2a2a !important;
                        border-color: #444;
                        color: #fff !important;
                    }
                    .form-floating > label {
                        color: #aaa;
                    }
                    .form-floating > .form-control:focus {
                        border-color: #0dcaf0;
                        box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
                    }
                    .card {
                        border: none;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                    }
                    .card-header {
                        border-bottom: none;
                    }
                    .btn {
                        padding: 0.5rem 1.5rem;
                        font-weight: 500;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        transition: all 0.3s ease;
                    }
                    .btn:hover {
                        transform: translateY(-1px);
                        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
                    }
                    .alert {
                        border-radius: 10px;
                    }
                    .badge {
                        padding: 0.5em 1em;
                        font-weight: 500;
                    }
                    .price-info-card {
                        margin-bottom: 1.5rem;
                    }

                    .price-details {
                        flex-grow: 1;
                    }

                    .price-item {
                        display: flex;
                        align-items: center;
                        color: #e0e0e0;
                        font-size: 1.1rem;
                    }

                    .price-label {
                        font-weight: 500;
                        margin-right: 0.5rem;
                        color: #8e9cc0;
                    }

                    .price-value {
                        font-weight: 600;
                        color: #0dcaf0;
                    }

                    .badge.bg-danger {
                        background-color: #dc3545 !important;
                        color: #fff;
                    }

                    .badge.bg-success {
                        background-color: #198754 !important;
                        color: #fff;
                    }

                    .card-header {
                        background-color: #0dcaf0 !important;
                        color: #000 !important;
                        font-weight: 600;
                    }

                    .card-body {
                        background-color: #1a1a1a;
                    }
                </style>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const formId = <?php echo $resultado['0'] ?>;
                    const fechaInicio = document.getElementById('fecha_inicio' + formId);
                    const fechaFin = document.getElementById('fecha_fin' + formId);
                    const precioInfo = document.getElementById('precio_info' + formId);
                    const nuevoValorSpan = document.getElementById('nuevo_valor' + formId);
                    const valorOriginalSpan = document.getElementById('valor_original' + formId);
                    const precioValidacion = document.getElementById('precio_validacion' + formId);
                    const btnGuardar = document.getElementById('btnGuardar' + formId);
                    const valorOriginal = <?php echo $resultado['7'] ?>;

                    async function calcularNuevoPrecio() {
                        if (fechaInicio.value && fechaFin.value) {
                            if (fechaFin.value < fechaInicio.value) {
                                precioInfo.style.display = 'block';
                                precioValidacion.innerHTML = '<span class="badge bg-danger">La fecha de fin no puede ser anterior a la fecha de inicio</span>';
                                btnGuardar.disabled = true;
                                return;
                            }

                            const formData = new FormData();
                            formData.append('fecha_inicio', fechaInicio.value);
                            formData.append('fecha_fin', fechaFin.value);
                            formData.append('reserva_id', formId);

                            try {
                                const response = await fetch('actions/calcular_nuevo_precio.php', {
                                    method: 'POST',
                                    body: formData
                                });
                                const data = await response.json();
                                
                                precioInfo.style.display = 'block';
                                
                                if (!data.success) {
                                    precioValidacion.innerHTML = `<span class="badge bg-danger">${data.message}</span>`;
                                    btnGuardar.disabled = true;
                                    return;
                                }

                                nuevoValorSpan.textContent = data.nuevo_valor_formateado;
                                document.getElementById('input_nuevo_valor' + formId).value = data.nuevo_valor;
                                
                                const nuevoValor = parseFloat(data.nuevo_valor);
                                const valorMaximo = valorOriginal * 2;
                                
                                if (nuevoValor < valorOriginal) {
                                    precioValidacion.innerHTML = '<span class="badge bg-danger">El nuevo valor no puede ser menor al original</span>';
                                    btnGuardar.disabled = true;
                                } else if (nuevoValor > valorMaximo) {
                                    precioValidacion.innerHTML = '<span class="badge bg-danger">El nuevo valor no puede ser más del doble del original</span>';
                                    btnGuardar.disabled = true;
                                } else {
                                    precioValidacion.innerHTML = '<span class="badge bg-success">Precio válido</span>';
                                    btnGuardar.disabled = false;
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                precioValidacion.innerHTML = '<span class="badge bg-danger">Error al calcular el precio</span>';
                                btnGuardar.disabled = true;
                            }
                        }
                    }

                    fechaInicio.addEventListener('change', function() {
                        fechaFin.min = this.value;
                        calcularNuevoPrecio();
                    });

                    fechaFin.addEventListener('change', calcularNuevoPrecio);
                });
                </script>
            </div>
        </div>
    </div>
</div>
