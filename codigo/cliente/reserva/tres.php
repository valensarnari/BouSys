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
        WHERE h.Activo != 0
        AND NOT EXISTS (
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

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Habitaciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../styles.css" rel="stylesheet">
    <script src="../../../script.js"></script>
    <link rel="icon" type="image/svg+xml" href="../../../icons/calendar-check.svg" />
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container.mt-5 {
            max-width: 900px;
            margin-top: 3rem !important;
        }

        .container.mt-5 h2 {
            color: #343a40;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .reservation-summary {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .habitacion-item {
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            border-radius: 8px;
            padding: 8px 20px;
        }

        .label {
            color: #007bff;
            font-weight: 600;
        }

        .paso-indicador {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .paso-indicador .badge {
            padding: 0.5em 1em;
            border-radius: 20px;
        }

        .content {
            flex: 1 0 auto;
            padding: 20px;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body class="container-fluid d-flex flex-column min-vh-100">
    <header class="row top-title">
        <h1>C o n t i n e n t a l&nbsp&nbsp&nbsp&nbsp&nbsp H o t e l</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../../pages/contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <!--
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page"
                            href="../../codigo/registro_login/panel_registro_login.php" data-section="nav" data-value="login"
                            style="color: #212529 !important;">
                            <i class="fas fa-user"></i> Ingreso</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a style="color: #212529 !important;" class="nav-link dropdown-toggle" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../perfil.php" data-section="nav" data-value="perfil">Mi
                                    Perfil</a></li>
                            <li><a class="dropdown-item" href="../mis_reservas.php" data-section="nav"
                                    data-value="reservas">Mis Reservas</a></li>
                            <li><a class="dropdown-item" href="../../registro_login/cerrar_sesion.php"
                                    data-section="nav" data-value="close">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" data-section="nav" data-value="language">
                            <i class="fas fa-globe"></i> Idioma
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <div id="flags" class="flags_item dropdown-item" data-language="en"><img
                                        src="../../../icons/gb.svg" alt="English" class="me-2" style="width: 20px;">
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es"><img
                                        src="../../../icons/es.svg" alt="Español" class="me-2" style="width: 20px;">
                                    Español
                                </div>
                            </li>
                            <li>
                                <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                        src="../../../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;">
                                    Português
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container mt-5">
            <h2 data-section="reservaTres.php" data-value="seleccion">Selección de Habitaciones</h2>

            <div class="reservation-summary">
                <p><span class="label" data-section="reservaTres.php" data-value="Adultos">Adultos:</span> <?php echo $reserva_adultos; ?></p>
                <p><span class="label" data-section="reservaTres.php" data-value="Niños">Niños:</span> <?php echo $reserva_ninos; ?></p>
                <p><span class="label" data-section="reservaTres.php" data-value="inicio">Fecha de inicio:</span> <?php echo $reserva_fecha_inicio; ?></p>
                <p><span class="label" data-section="reservaTres.php" data-value="fin">Fecha de fin:</span> <?php echo $reserva_fecha_fin; ?></p>
            </div>

            <form action="cuatro.php" method="POST">
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
                                            <span data-section="reservaTres.php" data-value="Habitacion">Habitación</span> <?php echo $habitacion['Numero_Habitacion']; ?> -
                                            <span data-section="reservaTres.php" data-value="Capacidad">Capacidad:</span> <?php echo $habitacion['Cantidad_Adultos_Maximo']; ?> <span data-section="reservaTres.php" data-value="Adultos">adultos</span>,
                                            <?php echo $habitacion['Cantidad_Ninos_Maximo']; ?> <span data-section="reservaTres.php" data-value="Niños">niños</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="ocupantes-inputs">
                                    <div class="form-group">
                                        <label for="adultos<?php echo $habitacion['id']; ?>" data-section="reservaTres.php" data-value="Adultos">Adultos:</label>
                                        <input type="number" class="form-control adultos-input"
                                            id="adultos<?php echo $habitacion['id']; ?>"
                                            name="habitaciones_adultos[<?php echo $habitacion['id']; ?>]" min="1"
                                            max="<?php echo $habitacion['Cantidad_Adultos_Maximo']; ?>" value="1" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="ninos<?php echo $habitacion['id']; ?>" data-section="reservaTres.php" data-value="Niños">Niños:</label>
                                        <input type="number" class="form-control ninos-input"
                                            id="ninos<?php echo $habitacion['id']; ?>"
                                            name="habitaciones_ninos[<?php echo $habitacion['id']; ?>]" min="0"
                                            max="<?php echo $habitacion['Cantidad_Ninos_Maximo']; ?>" value="0" disabled>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input cuna-checkbox" type="checkbox"
                                            name="habitaciones_cuna[<?php echo $habitacion['id']; ?>]" value="1"
                                            id="cuna<?php echo $habitacion['id']; ?>" disabled>
                                        <label class="form-check-label" for="cuna<?php echo $habitacion['id']; ?>" data-section="reservaTres.php" data-value="Cuna" >
                                            Cuna
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-center" data-section="reservaTres.php" data-value="Nohay">No hay habitaciones disponibles para las fechas seleccionadas.</p>
                    <?php } ?>
                </div>

                <div class="my-3 reservation-summary">
                    <p><span class="label" data-section="reservaTres.php" data-value="AdultosRestantes">Adultos restantes:</span> <span
                            id="adultosRestantes"><?php echo $reserva_adultos; ?></span></p>
                    <p><span class="label" data-section="reservaTres.php" data-value="NiñosRestantes">Niños restantes:</span> <span
                            id="ninosRestantes"><?php echo $reserva_ninos; ?></span></p>
                    <p><span class="label" data-section="reservaTres.php" data-value="CunasSeleccionadas">Cunas seleccionadas:</span> <span id="cunasSeleccionadas">0</span></p>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="paso-indicador">
                        <span class="badge bg-primary" data-section="reservaTres.php" data-value="Paso3-4">Paso 3 de 4</span>
                    </div>


                    <input type="hidden" name="reserva_id" value="<?php echo $reserva_id; ?>">
                    <input type="hidden" name="reserva_adultos" value="<?php echo $reserva_adultos; ?>">
                    <input type="hidden" name="reserva_ninos" value="<?php echo $reserva_ninos; ?>">
                    <input type="hidden" name="reserva_cuna" value="<?php echo $reserva_cuna; ?>">
                    <input type="hidden" name="reserva_fecha_inicio" value="<?php echo $reserva_fecha_inicio; ?>">
                    <input type="hidden" name="reserva_fecha_fin" value="<?php echo $reserva_fecha_fin; ?>">

                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled><span data-section="reservaTres.php" data-value="Siguiente">Siguiente</span></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Sobre nosotros</h5>
                    <p>Somos especialistas en viajes y reservas de hoteles. Nos encargamos de encontrar la mejor opción
                        para ti.</p>
                </div>
                <div class="col-md-6">
                    <h5>Links rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="../../index.php" class="text-white">Inicio</a></li>
                        <li><a href="../../pages/services.html" class="text-white">Servicios</a></li>
                        <li><a href="../../pages/rooms.html" class="text-white">Habitaciones</a></li>
                        <li><a href="../../pages/recommendations.html" class="text-white">Recomendaciones</a></li>
                        <li><a href="../../pages/contacto.html" class="text-white">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

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