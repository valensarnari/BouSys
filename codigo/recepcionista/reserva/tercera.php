<?php
include("../../conexion.php");
include("../../registro_login/validacion_sesion.php");

$reserva_id = $_POST["reserva_id"];
$reserva_adultos = $_POST["reserva_adultos"];
$_POST["reserva_ninos"] == "" ? $reserva_ninos = "0" : $reserva_ninos = $_POST["reserva_ninos"];
isset($_POST["reserva_cuna"]) && $_POST["reserva_cuna"] != null ? $reserva_cuna = "1" : $reserva_cuna = "0";
$reserva_fecha_inicio = $_POST["reserva_fecha_inicio"];
$reserva_fecha_fin = $_POST["reserva_fecha_fin"];

$sql = "SELECT DISTINCT h.id, h.Numero_Habitacion, h.Cantidad_Adultos_Maximo, h.Cantidad_Ninos_Maximo
        FROM habitacion h
        WHERE NOT EXISTS (
            SELECT 1
            FROM reserva_total rt
            JOIN reserva_habitacion rh ON rt.id = rh.ID_Reserva
            WHERE rh.ID_Habitacion = h.id
            AND rt.Estado != 'Cancelada'
            AND (
                (rt.Fecha_Inicio <= ? AND rt.Fecha_Fin >= ?)
                OR (rt.Fecha_Inicio BETWEEN ? AND ?)
                OR (rt.Fecha_Fin BETWEEN ? AND ?)
                OR (? BETWEEN rt.Fecha_Inicio AND rt.Fecha_Fin)
            )
        )";

$stmt = $conexion->prepare($sql);
$stmt->bind_param(
    "sssssss",
    $reserva_fecha_inicio,
    $reserva_fecha_fin,
    $reserva_fecha_inicio,
    $reserva_fecha_fin,
    $reserva_fecha_inicio,
    $reserva_fecha_fin,
    $reserva_fecha_inicio
);
$stmt->execute();
$resultado = $stmt->get_result();

$max_habitaciones = $reserva_adultos;
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <!---bootstrap css --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Reserva de habitación</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        h2 {
            color: #007bff;
        }

        .form-control {
            background-color: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .form-control::placeholder {
            color: #888;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .sidebar {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .sidebar a {
            color: #007bff;
        }

        .sidebar a:hover {
            color: #0056b3;
        }

        .reservation-summary {
            background-color: #2a2a2a;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .reservation-summary p {
            margin-bottom: 5px;
        }

        .reservation-summary .label {
            color: #007bff;
            font-weight: bold;
        }

        .habitacion-item {
            background-color: #2a2a2a;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .habitacion-info {
            margin-bottom: 10px;
        }

        .ocupantes-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .ocupantes-inputs .form-group {
            flex: 1;
        }

        .form-check-input {
            background-color: #2a2a2a;
            border-color: #444;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-label {
            color: #e0e0e0;
        }



        /* Ajustes para el texto en el sidebar */
        .nav-link {
            color: #e0e0e0 !important;
        }

        .nav-link:hover {
            color: #0dcaf0 !important;
        }

        /* Ajustes para el dropdown del usuario */
        .dropdown-menu-dark {
            background-color: #2a2a2a;
        }

        .dropdown-item {
            color: #e0e0e0;
        }

        .dropdown-item:hover {
            background-color: #0dcaf0;
            color: #000;
        }

        /* Estilos para el sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: linear-gradient(180deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 20px;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 20px 0;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h3 {
            color: #0dcaf0;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .nav-pills .nav-link {
            color: #e0e0e0 !important;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0 !important;
            transform: translateX(5px);
        }

        .nav-pills .nav-link.active {
            background-color: #0dcaf0;
            color: #000 !important;
        }

        .nav-pills .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Perfil de usuario en el sidebar */
        .user-profile {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .user-profile .dropdown-toggle {
            background-color: rgba(13, 202, 240, 0.1);
            padding: 10px 15px;
            border-radius: 8px;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-profile .dropdown-toggle:after {
            margin-left: auto;
        }

        .user-profile .dropdown-menu {
            background-color: #2a2a2a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .user-profile .dropdown-item {
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .user-profile .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Ajuste del contenido principal */
        .main-content {
            margin-left: 260px;
            /* Ancho del sidebar */
            padding: 30px;
            width: calc(100% - 260px);
            /* Ancho total menos el sidebar */
        }

        .container {
            max-width: 600px;
            /* O el ancho máximo que prefieras */
            margin: 0 auto;
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>BouSys</h3>
            </div>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="../../../" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../listado_clientes_recepcionista.php" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Gestión de Clientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../habitaciones.php" class="nav-link">
                        <i class="fa-solid fa-hotel"></i>
                        <span>Gestión de Habitaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../reservas.php" class="nav-link">
                        <i class="fa-solid fa-book"></i>
                        <span>Gestión de Reservas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../nueva_reserva.php" class="nav-link active">
                        <i class="fa-solid fa-plus"></i>
                        <span>Nueva Reserva</span>
                    </a>
                </li>
            </ul>
            <div class="user-profile">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-circle fa-2x me-2"></i>
                    <span>
                        <?php echo $_SESSION['usuario_nombre']; ?>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li>
                        <a class="dropdown-item" href="../../registro_login/cerrar_sesion.php">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            <span>Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="container">
                <h2 class="text-center mb-4">Seleccionar habitaciones disponibles</h2>
                <div class="reservation-summary">
                    <p><span class="label">Adultos:</span>
                        <?php echo $reserva_adultos; ?>
                    </p>
                    <p><span class="label">Niños:</span>
                        <?php echo $reserva_ninos; ?>
                    </p>
                    <p><span class="label">Fecha de inicio:</span>
                        <?php echo $reserva_fecha_inicio; ?>
                    </p>
                    <p><span class="label">Fecha de fin:</span>
                        <?php echo $reserva_fecha_fin; ?>
                    </p>
                </div>
                <form action="cuarta.php" method="POST">
                    <div class="my-3">
                        <?php if ($resultado->num_rows > 0) { ?>
                        <?php while ($habitacion = $resultado->fetch_assoc()) { ?>
                        <div class="habitacion-item">
                            <div class="habitacion-info">
                                <div class="form-check">
                                    <input class="form-check-input habitacion-checkbox" type="checkbox"
                                        name="habitaciones[]" value="<?php echo $habitacion['id']; ?>"
                                        id="habitacion<?php echo $habitacion['id']; ?>"
                                        data-adultos-max="<?php echo $habitacion['Cantidad_Adultos_Maximo']; ?>"
                                        data-ninos-max="<?php echo $habitacion['Cantidad_Ninos_Maximo']; ?>">
                                    <label class="form-check-label" for="habitacion<?php echo $habitacion['id']; ?>">
                                        Habitación
                                        <?php echo $habitacion['Numero_Habitacion']; ?> -
                                        Capacidad:
                                        <?php echo $habitacion['Cantidad_Adultos_Maximo']; ?> adultos,
                                        <?php echo $habitacion['Cantidad_Ninos_Maximo']; ?> niños
                                    </label>
                                </div>
                            </div>
                            <div class="ocupantes-inputs">
                                <div class="form-group">
                                    <label for="adultos<?php echo $habitacion['id']; ?>">Adultos:</label>
                                    <input type="number" class="form-control adultos-input"
                                        id="adultos<?php echo $habitacion['id']; ?>"
                                        name="habitaciones_adultos[<?php echo $habitacion['id']; ?>]" min="1"
                                        max="<?php echo $habitacion['Cantidad_Adultos_Maximo']; ?>" value="1" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="ninos<?php echo $habitacion['id']; ?>">Niños:</label>
                                    <input type="number" class="form-control ninos-input"
                                        id="ninos<?php echo $habitacion['id']; ?>"
                                        name="habitaciones_ninos[<?php echo $habitacion['id']; ?>]" min="0"
                                        max="<?php echo $habitacion['Cantidad_Ninos_Maximo']; ?>" value="0" disabled>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input cuna-checkbox" type="checkbox"
                                        name="habitaciones_cuna[<?php echo $habitacion['id']; ?>]" value="1"
                                        id="cuna<?php echo $habitacion['id']; ?>" disabled>
                                    <label class="form-check-label" for="cuna<?php echo $habitacion['id']; ?>">
                                        Cuna
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } else { ?>
                        <p class="text-center">No hay habitaciones disponibles para las fechas seleccionadas.</p>
                        <?php } ?>
                    </div>

                    <div class="my-3 reservation-summary">
                        <p><span class="label">Adultos restantes:</span> <span id="adultosRestantes">
                                <?php echo $reserva_adultos; ?>
                            </span></p>
                        <p><span class="label">Niños restantes:</span> <span id="ninosRestantes">
                                <?php echo $reserva_ninos; ?>
                            </span></p>
                        <p><span class="label">Cunas seleccionadas:</span> <span id="cunasSeleccionadas">0</span></p>
                    </div>

                    <div class="d-flex justify-content-end align-items-end">
                        <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                        <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                        <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                        <input type="hidden" name="reserva_cuna" value="<?php echo $reserva_cuna; ?>">
                        <input type="hidden" name="reserva_fecha_inicio" value="<?php echo $reserva_fecha_inicio; ?>">
                        <input type="hidden" name="reserva_fecha_fin" value="<?php echo $reserva_fecha_fin; ?>">

                        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Siguiente</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            let adultosRestantes = parseInt(<?php echo $reserva_adultos; ?>);
            let ninosRestantes = parseInt(<?php echo $reserva_ninos; ?>);
            const maxAdultos = adultosRestantes;
            const maxNinos = ninosRestantes;
            const maxHabitaciones = <?php echo $max_habitaciones; ?>;
            let habitacionesSeleccionadas = 0;
            let cunasSeleccionadas = 0;

            const updateCounters = () => {
                const adultosRestantesElement = document.getElementById('adultosRestantes');
                const ninosRestantesElement = document.getElementById('ninosRestantes');
                const cunasSeleccionadasElement = document.getElementById('cunasSeleccionadas');
                const submitBtn = document.getElementById('submitBtn');

                adultosRestantesElement.innerText = adultosRestantes < 0 ? 0 : adultosRestantes;
                ninosRestantesElement.innerText = ninosRestantes < 0 ? 0 : ninosRestantes;
                cunasSeleccionadasElement.innerText = cunasSeleccionadas;

                if (adultosRestantes <= 0 && ninosRestantes <= 0) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }

                const checkboxes = document.querySelectorAll('.habitacion-checkbox:not(:checked)');
                const adultosInputs = document.querySelectorAll('.adultos-input:not(:disabled)');

                if (adultosRestantes <= 0) {
                    checkboxes.forEach(checkbox => checkbox.disabled = true);
                    adultosInputs.forEach(input => {
                        input.max = parseInt(input.value);
                    });
                } else {
                    checkboxes.forEach(checkbox => checkbox.disabled = false);
                    adultosInputs.forEach(input => {
                        input.max = Math.min(parseInt(input.getAttribute('data-max')), adultosRestantes + parseInt(input.value));
                    });
                }
            }

            const checkboxes = document.querySelectorAll('.habitacion-checkbox');

            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', function () {
                    const habitacionId = this.value;
                    const adultosInput = document.getElementById(`adultos${habitacionId}`);
                    const ninosInput = document.getElementById(`ninos${habitacionId}`);
                    const cunaCheckbox = document.getElementById(`cuna${habitacionId}`);

                    if (this.checked) {
                        if (habitacionesSeleccionadas < maxHabitaciones && adultosRestantes > 0) {
                            adultosInput.disabled = false;
                            ninosInput.disabled = false;
                            cunaCheckbox.disabled = false;
                            adultosRestantes -= parseInt(adultosInput.value);
                            ninosRestantes -= parseInt(ninosInput.value);
                            habitacionesSeleccionadas++;
                        } else {
                            alert("No se pueden seleccionar más habitaciones o no quedan adultos disponibles.");
                            this.checked = false;
                            return;
                        }
                    } else {
                        adultosInput.disabled = true;
                        ninosInput.disabled = true;
                        cunaCheckbox.disabled = true;
                        adultosRestantes += parseInt(adultosInput.value);
                        ninosRestantes += parseInt(ninosInput.value);
                        habitacionesSeleccionadas--;
                    }

                    updateCounters();
                });
            });

            document.querySelectorAll('.adultos-input, .ninos-input').forEach((input) => {
                input.addEventListener('change', function () {
                    const habitacionId = this.id.replace('adultos', '').replace('ninos', '');
                    const checkbox = document.getElementById(`habitacion${habitacionId}`);
                    const adultosInput = document.getElementById(`adultos${habitacionId}`);
                    const ninosInput = document.getElementById(`ninos${habitacionId}`);

                    if (checkbox.checked) {
                        const oldAdultos = parseInt(adultosInput.getAttribute('data-old-value') || adultosInput.min);
                        const oldNinos = parseInt(ninosInput.getAttribute('data-old-value') || ninosInput.min);
                        const newAdultos = parseInt(adultosInput.value);
                        const newNinos = parseInt(ninosInput.value);
                        const maxAdultos = parseInt(checkbox.getAttribute('data-adultos-max'));
                        const maxNinos = parseInt(checkbox.getAttribute('data-ninos-max'));

                        if (this.classList.contains('adultos-input')) {
                            if (newAdultos > maxAdultos) {
                                alert(`El número máximo de adultos para esta habitación es ${maxAdultos}.`);
                                this.value = Math.min(oldAdultos, maxAdultos);
                                return;
                            }
                            if (newAdultos > oldAdultos && adultosRestantes <= 0) {
                                alert("No hay suficientes adultos disponibles.");
                                this.value = oldAdultos;
                                return;
                            }
                        } else if (this.classList.contains('ninos-input')) {
                            if (newNinos > maxNinos) {
                                alert(`El número máximo de niños para esta habitación es ${maxNinos}.`);
                                this.value = Math.min(oldNinos, maxNinos);
                                return;
                            }
                            if (newNinos > oldNinos && ninosRestantes <= 0) {
                                alert("No hay suficientes niños disponibles.");
                                this.value = oldNinos;
                                return;
                            }
                        }

                        adultosRestantes += oldAdultos - newAdultos;
                        ninosRestantes += oldNinos - newNinos;

                        adultosInput.setAttribute('data-old-value', newAdultos);
                        ninosInput.setAttribute('data-old-value', newNinos);

                        updateCounters();
                    }
                });
            });

            document.querySelectorAll('.cuna-checkbox').forEach((cunaCheckbox) => {
                cunaCheckbox.addEventListener('change', function () {
                    cunasSeleccionadas = document.querySelectorAll('.cuna-checkbox:checked').length;
                    updateCounters();
                });
            });

            updateCounters();
        </script>

        <!---bootstrap js --->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

</body>

</html>