<?php
// Incluir el archivo que obtiene las habitaciones
include 'actions/obtener_habitacion.php';

?>

<div class="modal fade" id="reservarModal" tabindex="-1" aria-labelledby="reservarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservarModalLabel">Reservar Habitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/reservar_habitacion.php" method="POST">
                    <!-- Buscador de clientes -->
                    <label for="buscar_cliente">Buscar Cliente:</label>
                    <input type="text" id="buscar_cliente" class="form-control" placeholder="Buscar por ID, Documento, Nombre, Apellido o Email">
                    <div id="resultado_busqueda"></div>
                    
                    <!-- Campo que se llenará automáticamente con el ID del cliente seleccionado -->
                    <label for="cliente_id">ID Cliente:</label>
                    <input type="text" id="cliente_id" name="cliente_id" class="form-control" readonly required><br>

                    <!-- Número de adultos y niños para filtrar habitaciones -->
                    <label for="adultos">Número de adultos:</label>
                    <input type="number" id="adultos" name="adultos" class="form-control" required><br>

                    <label for="ninos">Número de niños:</label>
                    <input type="number" id="ninos" name="ninos" class="form-control"><br>

                        <!-- FALTA AGREGAR LA CUNA, FALTA AGREGAR LA CUNA NO OLVIDARSE NO OLVIDARSE NO OLVIDARSE -->

                     <!-- Selección de habitaciones dinámicas filtradas -->
                     <label for="habitaciones">Habitaciones Disponibles:</label>
                    <div id="habitaciones">
                        <?php foreach ($habitaciones as $habitacion): ?>
                            <div class="habitacion">
                                <label for="habitacion_<?php echo $habitacion['id']; ?>">
                                    Habitación <?php echo $habitacion['Numero_Habitacion']; ?> - Máx <?php echo $habitacion['Cantidad_Adultos_Maximo']; ?> adultos, <?php echo $habitacion['Cantidad_Ninos_Maximo']; ?> niños
                                </label>
                                <input type="checkbox" class="habitacion-checkbox" id="habitacion_<?php echo $habitacion['id']; ?>" 
                                       data-precio="<?php echo $habitacion['Precio_Por_Noche']; ?>"
                                       data-max-adultos="<?php echo $habitacion['Cantidad_Adultos_Maximo']; ?>"
                                       data-max-ninos="<?php echo $habitacion['Cantidad_Ninos_Maximo']; ?>" 
                                       name="habitaciones[<?php echo $habitacion['id']; ?>][id]" value="<?php echo $habitacion['id']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <label for="fecha_inicio">Fecha Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required disabled><br>

                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required disabled><br>

                    <label for="valor_total">Valor Total:</label>
                    <input type="number" id="valor_total" name="valor_total" class="form-control" readonly required><br>

                   

                    <input type="submit" value="Reservar" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para buscar y seleccionar cliente -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Evento para el campo de búsqueda
    document.getElementById('buscar_cliente').addEventListener('input', function() {
        let consulta = this.value;
        if (consulta !== "") {
            fetch('actions/buscar_cliente.php', {
                method: 'POST',
                body: new URLSearchParams('consulta=' + consulta),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('resultado_busqueda').innerHTML = data;
            });
        } else {
            document.getElementById('resultado_busqueda').innerHTML = "";
        }
    });

    // Evento para seleccionar cliente y rellenar el campo de ID
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('seleccionar-cliente')) {
            let clienteId = e.target.getAttribute('data-cliente-id');
            document.getElementById('cliente_id').value = clienteId;
        }
    });

    // Calcular el valor total basado en las fechas y las habitaciones seleccionadas
    const valorTotalInput = document.getElementById('valor_total');
    const fechaInicioInput = document.getElementById('fecha_inicio');
    const fechaFinInput = document.getElementById('fecha_fin');

    // Función para calcular las noches
    function calcularNoches() {
        const fechaInicio = new Date(fechaInicioInput.value);
        const fechaFin = new Date(fechaFinInput.value);
        const unDia = 24 * 60 * 60 * 1000; // Milisegundos en un día

        // Calcular la diferencia en días
        if (fechaInicio && fechaFin && fechaFin > fechaInicio) {
            const noches = Math.round((fechaFin - fechaInicio) / unDia);
            return noches;
        }
        return 0; // Si las fechas no son válidas
    }

    // Evento para calcular el valor total
    fechaInicioInput.addEventListener('change', actualizarValorTotal);
    fechaFinInput.addEventListener('change', actualizarValorTotal);

    function actualizarValorTotal() {
        const noches = calcularNoches();
        let total = 0;
        const checkboxes = document.querySelectorAll('.habitacion-checkbox:checked');
        
        checkboxes.forEach(checkbox => {
            const precioPorNoche = parseFloat(checkbox.dataset.precio);
            total += precioPorNoche * noches;
        });

        valorTotalInput.value = total; // Actualiza el valor total
    }
});
</script>

<script>
// Función para habilitar/deshabilitar los campos de habitaciones seleccionadas y filtrar por adultos/niños
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.habitacion-checkbox');
    const adultosInput = document.getElementById('adultos');
    const ninosInput = document.getElementById('ninos');

    // Filtrar habitaciones según la cantidad de adultos y niños
    function filtrarHabitaciones() {
        const numAdultos = parseInt(adultosInput.value) || 0;
        const numNinos = parseInt(ninosInput.value) || 0;

        checkboxes.forEach(checkbox => {
            const maxAdultos = parseInt(checkbox.dataset.maxAdultos);
            const maxNinos = parseInt(checkbox.dataset.maxNinos);

            if (numAdultos > maxAdultos || numNinos > maxNinos) {
                checkbox.disabled = true;  // Deshabilitar si no cumple con la capacidad
            } else {
                checkbox.disabled = false;
            }
        });
    }

    // Ejecutar el filtro al cambiar los valores de adultos o niños
    adultosInput.addEventListener('input', filtrarHabitaciones);
    ninosInput.addEventListener('input', filtrarHabitaciones);
});
</script>

<script>

        // Función para habilitar/deshabilitar los campos de fechas y controlar la selección de habitaciones
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.habitacion-checkbox');
        const fechaInicioInput = document.getElementById('fecha_inicio');
        const fechaFinInput = document.getElementById('fecha_fin');
        
        // Inicializar los campos de fecha como deshabilitados
        fechaInicioInput.disabled = true;
        fechaFinInput.disabled = true;

        // Función para habilitar los campos de fecha
        function habilitarFechas() {
            const anyCheckboxChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            
            // Habilitar o deshabilitar campos de fecha
            fechaInicioInput.disabled = !anyCheckboxChecked;
            fechaFinInput.disabled = !anyCheckboxChecked;
        }

        // Mostrar campos solo si la habitación está seleccionada
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', habilitarFechas);
        });
    });


</script>
