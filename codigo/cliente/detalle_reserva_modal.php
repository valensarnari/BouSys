<!-- Modal de Detalles y Modificación -->
<div class="modal fade" id="detalles<?php echo $resultado['0'] ?>" tabindex="-1"
    aria-labelledby="detallesLabel<?php echo $resultado['0'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesLabel<?php echo $resultado['0'] ?>">
                    Detalles y Modificación de la Reserva
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Sección de Modificación -->
                <?php
                $fecha_actual = date('Y-m-d');
                if ($fecha_actual < $resultado['3']) { // Si la reserva aún no comenzó
                ?>
                    <form action="modificar_reserva.php" method="POST" class="mb-4" id="formModificarReserva<?php echo $resultado['0'] ?>">
                        <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                        <input type="hidden" name="valor_original" value="<?php echo $resultado['7'] ?>">
                        <input type="hidden" name="nuevo_valor" id="input_nuevo_valor<?php echo $resultado['0'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                    <input type="date" class="form-control fecha-input" 
                                           id="fecha_inicio<?php echo $resultado['0'] ?>" 
                                           name="fecha_inicio" value="<?php echo $resultado['3'] ?>" 
                                           min="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                    <input type="date" class="form-control fecha-input" 
                                           id="fecha_fin<?php echo $resultado['0'] ?>" 
                                           name="fecha_fin" value="<?php echo $resultado['4'] ?>" 
                                           min="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- Nuevo div para mostrar el cálculo del precio -->
                        <div class="alert alert-info" id="precio_info<?php echo $resultado['0'] ?>" style="display: none;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1"><strong>Valor Original:</strong> $<span id="valor_original<?php echo $resultado['0'] ?>"><?php echo number_format($resultado['7'], 2) ?></span></p>
                                    <p class="mb-1"><strong>Nuevo Valor:</strong> $<span id="nuevo_valor<?php echo $resultado['0'] ?>">0.00</span></p>
                                </div>
                                <div id="precio_validacion<?php echo $resultado['0'] ?>" class="text-end">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary" id="btnGuardar<?php echo $resultado['0'] ?>">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#cancelar<?php echo $resultado['0'] ?>" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Cancelar Reserva
                            </button>
                        </div>
                    </form>

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

                        // Función para calcular el nuevo precio
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
                                    const response = await fetch('calcular_nuevo_precio.php', {
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
                                    
                                    // Validaciones de precio
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

                        // Event listeners
                        fechaInicio.addEventListener('change', function() {
                            fechaFin.min = this.value;
                            calcularNuevoPrecio();
                        });

                        fechaFin.addEventListener('change', calcularNuevoPrecio);
                    });
                    </script>
                <?php
                } else {
                ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        Esta reserva ya comenzó y no puede ser modificada. Solo se pueden modificar reservas antes de su fecha de inicio.
                    </div>
                <?php
                }
                ?>

                <!-- Sección de Habitaciones -->
                <h6 class="mb-3">Habitaciones Reservadas:</h6>
                <?php
                $sql_habitaciones = "SELECT h.Numero_Habitacion, h.Tipo, rh.Cantidad_Adultos, 
                                          rh.Cantidad_Ninos, rh.Cuna 
                                   FROM reserva_habitacion rh 
                                   JOIN habitacion h ON rh.ID_Habitacion = h.id 
                                   WHERE rh.ID_Reserva = " . $resultado['0'];
                $query_habitaciones = mysqli_query($conexion, $sql_habitaciones);

                if (mysqli_num_rows($query_habitaciones) > 0) {
                    echo "<div class='list-group mb-4'>";
                    while ($habitacion = mysqli_fetch_array($query_habitaciones)) {
                        echo "<div class='list-group-item'>";
                        echo "<div class='d-flex justify-content-between align-items-center'>";
                        echo "<h6 class='mb-1'>Habitación " . $habitacion['Numero_Habitacion'] . " - " . $habitacion['Tipo'] . "</h6>";
                        echo "</div>";
                        echo "<p class='mb-1'>Adultos: " . $habitacion['Cantidad_Adultos'] . "</p>";
                        echo "<p class='mb-1'>Niños: " . ($habitacion['Cantidad_Ninos'] ?? '0') . "</p>";
                        echo "<p class='mb-0'>Cuna: " . ($habitacion['Cuna'] ? 'Sí' : 'No') . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p class='text-muted'>No hay habitaciones registradas para esta reserva.</p>";
                }
                ?>

                <!-- Sección de Pagos -->
                <h6 class="mb-3">Pagos Realizados:</h6>
                <?php
                $sql_pagos = "SELECT Fecha_Pago, Medio_De_Pago, Descuento, Aumento, Total 
                             FROM pago 
                             WHERE ID_Reserva = " . $resultado['0'];
                $query_pagos = mysqli_query($conexion, $sql_pagos);

                // Obtener el valor total de la reserva
                $valor_total = $resultado['7']; // Valor_Total de la reserva
                $total_pagado = 0;

                if (mysqli_num_rows($query_pagos) > 0) {
                    echo "<div class='list-group'>";
                    while ($pago = mysqli_fetch_array($query_pagos)) {
                        echo "<div class='list-group-item'>";
                        echo "<div class='d-flex justify-content-between align-items-center'>";
                        echo "<div>";
                        echo "<p class='mb-1'><strong>Fecha:</strong> " . $pago['Fecha_Pago'] . "</p>";
                        echo "<p class='mb-1'><strong>Medio de pago:</strong> " . $pago['Medio_De_Pago'] . "</p>";
                        if ($pago['Descuento'] > 0)
                            echo "<p class='mb-1'><strong>Descuento:</strong> $" . $pago['Descuento'] . "</p>";
                        if ($pago['Aumento'] > 0)
                            echo "<p class='mb-1'><strong>Aumento:</strong> $" . $pago['Aumento'] . "</p>";
                        echo "</div>";
                        echo "<div class='text-end'>";
                        echo "<h6 class='mb-0'>$" . $pago['Total'] . "</h6>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        $total_pagado += $pago['Total'];
                    }
                    echo "</div>";
                } else {
                    echo "<p class='text-muted'>No se han realizado pagos para esta reserva.</p>";
                }

                // Calcular el monto restante
                $monto_restante = $valor_total - $total_pagado;

                // Mostrar resumen de pagos
                echo "<div class='card mt-3'>";
                echo "<div class='card-body'>";
                echo "<div class='row'>";

                // Valor total de la reserva
                echo "<div class='col-md-4'>";
                echo "<div class='text-center'>";
                echo "<h6 class='mb-1'>Valor Total</h6>";
                echo "<h5 class='mb-0'>$" . number_format($valor_total, 2) . "</h5>";
                echo "</div>";
                echo "</div>";

                // Total pagado
                echo "<div class='col-md-4'>";
                echo "<div class='text-center'>";
                echo "<h6 class='mb-1'>Total Pagado</h6>";
                echo "<h5 class='mb-0'>$" . number_format($total_pagado, 2) . "</h5>";
                echo "</div>";
                echo "</div>";

                // Monto restante
                echo "<div class='col-md-4'>";
                echo "<div class='text-center'>";
                echo "<h6 class='mb-1'>Resta Pagar</h6>";
                echo "<h5 class='mb-0 " . ($monto_restante > 0 ? 'text-danger' : 'text-success') . "'>";
                echo "$" . number_format($monto_restante, 2);
                echo "</h5>";
                echo "</div>";
                echo "</div>";

                echo "</div>";
                echo "</div>";
                echo "</div>";
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Cancelación -->
<div class="modal fade" id="cancelar<?php echo $resultado['0'] ?>" 
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="cancelarLabel<?php echo $resultado['0'] ?>"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelarLabel<?php echo $resultado['0'] ?>">Confirmar Cancelación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <p>¿Estás seguro que deseas cancelar esta reserva?</p>
                </div>

                <?php
                // Consultar los pagos realizados
                $sql_pagos = "SELECT Fecha_Pago, Medio_De_Pago, Descuento, Aumento, Total 
                             FROM pago 
                             WHERE ID_Reserva = " . $resultado['0'];
                $query_pagos = mysqli_query($conexion, $sql_pagos);

                // Obtener el valor total de la reserva
                $valor_total = $resultado['7']; // Valor_Total de la reserva
                $total_pagado = 0;

                if (mysqli_num_rows($query_pagos) > 0) {
                    echo "<p><strong>Pagos realizados hasta el momento:</strong></p>";
                    echo "<ul class='list-group mb-3'>";
                    while ($pago = mysqli_fetch_array($query_pagos)) {
                        echo "<li class='list-group-item'>";
                        echo "<div class='d-flex justify-content-between align-items-center'>";
                        echo "<div>";
                        echo "<p class='mb-1'>Fecha: " . $pago['Fecha_Pago'] . "</p>";
                        echo "<p class='mb-1'>Medio de pago: " . $pago['Medio_De_Pago'] . "</p>";
                        if ($pago['Descuento'] > 0)
                            echo "<p class='mb-1'>Descuento: $" . $pago['Descuento'] . "</p>";
                        if ($pago['Aumento'] > 0)
                            echo "<p class='mb-1'>Aumento: $" . $pago['Aumento'] . "</p>";
                        echo "</div>";
                        echo "<div class='text-end'>";
                        echo "<h6 class='mb-0'>$" . number_format($pago['Total'], 2) . "</h6>";
                        echo "</div>";
                        echo "</div>";
                        echo "</li>";
                        $total_pagado += $pago['Total'];
                    }
                    echo "</ul>";

                    // Calcular el monto restante
                    $monto_restante = $valor_total - $total_pagado;

                    // Mostrar resumen de pagos
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<div class='row'>";

                    // Valor total de la reserva
                    echo "<div class='col-md-4'>";
                    echo "<div class='text-center'>";
                    echo "<h6 class='mb-1'>Valor Total</h6>";
                    echo "<h5 class='mb-0'>$" . number_format($valor_total, 2) . "</h5>";
                    echo "</div>";
                    echo "</div>";

                    // Total pagado
                    echo "<div class='col-md-4'>";
                    echo "<div class='text-center'>";
                    echo "<h6 class='mb-1'>Total Pagado</h6>";
                    echo "<h5 class='mb-0'>$" . number_format($total_pagado, 2) . "</h5>";
                    echo "</div>";
                    echo "</div>";

                    // Monto restante
                    echo "<div class='col-md-4'>";
                    echo "<div class='text-center'>";
                    echo "<h6 class='mb-1'>Resta Pagar</h6>";
                    echo "<h5 class='mb-0 " . ($monto_restante > 0 ? 'text-danger' : 'text-success') . "'>";
                    echo "$" . number_format($monto_restante, 2);
                    echo "</h5>";
                    echo "</div>";
                    echo "</div>";

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<p class='text-muted'>No se han realizado pagos para esta reserva.</p>";
                    echo "<div class='alert alert-info'>";
                    echo "<strong>Valor total de la reserva: $" . number_format($valor_total, 2) . "</strong>";
                    echo "</div>";
                }
                ?>
            </div>
            <div class="modal-footer">
                <form action="cancelar_reserva.php" method="POST">
                    <input type="hidden" name="reserva_id" value="<?php echo $resultado['0'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver atrás</button>
                    <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>
                </form>
            </div>
        </div>
    </div>
</div>