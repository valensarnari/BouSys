<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../styles.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../../icons/home.png" />
    <script src="../../script.js"></script>
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
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .custom-navbar {
            background-color: #E6F3FF;
        }

        .custom-navbar .nav-link {
            color: #333333;
            font-weight: 500;
        }

        .custom-navbar .nav-link:hover {
            color: #0056b3;
        }

        .custom-navbar .dropdown-menu {
            background-color: #E6F3FF;
        }

        .custom-navbar .dropdown-item:hover {
            background-color: #CCE5FF;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        .links {
            text-align: center;
            margin-top: 1rem;
        }

        .links a,
        .links button {
            color: #007bff;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
        }

        .links a:hover,
        .links button:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-group input:focus,
        .input-group select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            background-color: white;
            padding: 0 5px;
            font-size: 14px;
            color: #6c757d;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .input-group input:focus+label,
        .input-group input:not(:placeholder-shown)+label,
        .input-group select:focus+label,
        .input-group select:not(:placeholder-shown)+label {
            top: 0;
            font-size: 12px;
            color: #007bff;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .links {
            margin-top: 1rem;
            text-align: center;
        }

        .links a,
        .links button {
            color: #007bff;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .links a:hover,
        .links button:hover {
            text-decoration: underline;
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
                        <a class="nav-link text-dark" href="../../index.php" data-section="nav"
                            data-value="home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/services.php" data-section="nav"
                            data-value="services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/rooms.php" data-section="nav"
                            data-value="rooms">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/recommendations.php" data-section="nav"
                            data-value="recommendations">Recomendaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/contacto.php" data-section="nav"
                            data-value="contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="../../pages/receptions.php" data-section="nav"
                            data-value="receptions">
                            <img src="../../icons/calendar-check.svg" alt="Reservas"> Reservas
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page"
                            href="../../codigo/registro_login/panel_registro_login.php" data-section="nav"
                            data-value="login" style="color: #212529 !important;">
                            <i class="fas fa-user"></i> Ingreso</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" data-section="nav" data-value="language">
                            <i class="fas fa-globe"></i> Idioma
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <div id="flags" class="flags_item dropdown-item" data-language="en"><img
                                        src="../../icons/gb.svg" alt="English" class="me-2" style="width: 20px;">
                                    English
                                </div>
                            </li>
                            <li>
                                <div id="flag-es" class="flags_item_es dropdown-item" data-language="es"><img
                                        src="../../icons/es.svg" alt="Español" class="me-2" style="width: 20px;">
                                    Español
                                </div>
                            </li>
                            <li>
                                <div id="flag-pt" class="flags_item_pt dropdown-item" data-language="pt"><img
                                        src="../../icons/pt.svg" alt="Português" class="me-2" style="width: 20px;">
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
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- Contenedor para el Login -->
                            <div id="signIn">
                                <h2 data-section="panel_registro_login.php" data-value="iniciar">Iniciar Sesión</h2>
                                <form action="login.php" method="POST">
                                    <div class="input-group">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="email_login" name="email_login" placeholder="Email"
                                            required>
                                        <label for="email_login">Email</label>
                                    </div>
                                    <div class="input-group">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="password_login" name="password_login"
                                            placeholder="Contraseña" required>
                                        <label for="password_login" data-section="panel_registro_login.php"
                                            data-value="contrasena">Contraseña</label>
                                    </div>
                                    <p class="recover">
                                        <a href="#" data-section="panel_registro_login.php"
                                            data-value="contrasena Olvidada">¿Olvidaste tu contraseña?</a>
                                    </p>
                                    <input type="submit" class="btn" id="e" value="Iniciar Sesión">
                                </form>
                                <div class="links">
                                    <p><span data-section="panel_registro_login.php" data-value="no tiene cuenta">¿No
                                            tienes cuenta? </span><button id="signUpButton"><span
                                                data-section="panel_registro_login.php"
                                                data-value="registrar">Regístrate</span></button></p>
                                    <p><a href="#"><span data-section="panel_registro_login.php"
                                                data-value="contrasena Olvidada">¿Olvidaste tu contraseña?</span></a>
                                    </p>
                                </div>
                            </div>

                            <!-- Contenedor para el Registro -->
                            <div id="signup" style="display:none;">
                                <h2 data-section="panel_registro_login.php" data-value="registro">Registro</h2>
                                <form action="registro.php" method="POST">
                                    <div class="input-group">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required
                                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{3,25}" oninvalid="(() => {
                                                const modalDiv = document.createElement('div');
                                                modalDiv.innerHTML = `
                                                    <div class='modal fade' id='nombreModal' tabindex='-1' aria-hidden='true'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title'>Aviso</h5>
                                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <p>Solo se permiten letras, mínimo 3 caracteres y máximo 25 caracteres</p>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Aceptar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                document.body.appendChild(modalDiv);
                                                const modal = new bootstrap.Modal(document.getElementById('nombreModal'));
                                                modal.show();
                                                document.getElementById('nombreModal').addEventListener('hidden.bs.modal', function() {
                                                    document.body.removeChild(modalDiv);
                                                });
                                            })()" oninput="this.setCustomValidity('')" minlength="3" maxlength="25"
                                            onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/.test(event.key)">
                                        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Error de validación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p id="mensajeError"></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            function mostrarError(mensaje) {
                                                document.getElementById('mensajeError').textContent = mensaje;
                                                var modal = new bootstrap.Modal(document.getElementById('errorModal'));
                                                modal.show();
                                            }
                                        </script>
                                        <label for="nombre" data-section="panel_registro_login.php"
                                            style="display: none;" data-value="Nombre">Nombre</label>
                                    </div>
                                    <div class="input-group">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="apellido" name="apellido" placeholder="Apellido" required
                                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{3,25}" oninvalid="(function(){
                                                const modalDiv = document.createElement('div');
                                                modalDiv.innerHTML = `
                                                    <div class='modal fade' id='apellidoModal' tabindex='-1'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title'>Error de validación</h5>
                                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <p>Solo se permiten letras, mínimo 3 caracteres y máximo 25 caracteres</p>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Aceptar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                document.body.appendChild(modalDiv);
                                                const modal = new bootstrap.Modal(document.getElementById('apellidoModal'));
                                                modal.show();
                                                document.getElementById('apellidoModal').addEventListener('hidden.bs.modal', function() {
                                                    document.body.removeChild(modalDiv);
                                                });
                                            })()" oninput="this.setCustomValidity('')" minlength="3" maxlength="25"
                                            onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/.test(event.key)">
                                        <label for="apellido" data-section="panel_registro_login.php"
                                            data-value="Apellido">Apellido</label>
                                    </div>
                                    <div class="input-group">
                                        <i class="fas fa-id-card"></i>
                                        <input type="text" id="dni" name="dni" placeholder="DNI" required minlength="7"
                                            maxlength="8" pattern="[0-9]{7,8}" oninvalid="(function(){
                                                const modalDiv = document.createElement('div');
                                                modalDiv.innerHTML = `
                                                    <div class='modal fade' id='dniModal' tabindex='-1'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title'>Error de validación</h5>
                                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <p>El DNI debe tener entre 7 y 8 números</p>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Aceptar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                document.body.appendChild(modalDiv);
                                                const modal = new bootstrap.Modal(document.getElementById('dniModal'));
                                                modal.show();
                                                document.getElementById('dniModal').addEventListener('hidden.bs.modal', function() {
                                                    document.body.removeChild(modalDiv);
                                                });
                                            })()" oninput="this.setCustomValidity('')"
                                            onkeypress="return /[0-9]/.test(event.key)">
                                        <label for="dni" data-section="panel_registro_login.php"
                                            data-value="Documento">Documento</label>
                                    </div>
                                    <div class="input-group">
                                        <i class="fas fa-globe"></i>
                                        <input type="text" id="nacionalidad" name="nacionalidad"
                                            placeholder="Nacionalidad" required minlength="4" maxlength="20"
                                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{4,20}" oninvalid="(function(){
                                                const modalDiv = document.createElement('div');
                                                modalDiv.innerHTML = `
                                                    <div class='modal fade' id='nacionalidadModal' tabindex='-1'>
                                                        <div class='modal-dialog'>
                                                            <div class='modal-content'>
                                                                <div class='modal-header'>
                                                                    <h5 class='modal-title'>Error de validación</h5>
                                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                </div>
                                                                <div class='modal-body'>
                                                                    <p>La nacionalidad debe tener entre 4 y 20 caracteres</p>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Aceptar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                document.body.appendChild(modalDiv);
                                                const modal = new bootstrap.Modal(document.getElementById('nacionalidadModal'));
                                                modal.show();
                                                document.getElementById('nacionalidadModal').addEventListener('hidden.bs.modal', function() {
                                                    document.body.removeChild(modalDiv);
                                                });
                                            })()" oninput="this.setCustomValidity('')"
                                            onkeypress="return /[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/.test(event.key)">
                                        <label for="nacionalidad" data-section="panel_registro_login.php"
                                            data-value="Nacionalidad">Nacionalidad</label>
                                    </div><br>
                                    <div class="input-group">
                                        <i class="fas fa-venus-mars"></i>
                                        <select id="sexo" name="sexo" required>
                                            <option value="" data-section="panel_registro_login.php"
                                                data-value="SeleccionaSexo">Selecciona tu sexo</option>
                                            <option value="Masculino" data-section="panel_registro_login.php"
                                                data-value="Masculino">Masculino</option>
                                            <option value="Femenino" data-section="panel_registro_login.php"
                                                data-value="Femenino">Femenino</option>
                                            <option value="Otro" data-section="panel_registro_login.php"
                                                data-value="Otro">Otro</option>
                                        </select>
                                        <label for="sexo" data-section="panel_registro_login.php"
                                            data-value="Sexo">Sexo</label>
                                    </div><br>
                                    <div class="input-group">
                                        <i class="fas fa-calendar"></i>
                                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required
                                            onchange="validarEdad(this)">
                                        <label for="fecha_nacimiento" data-section="panel_registro_login.php"
                                            data-value="nacimiento">Fecha de Nacimiento</label>
                                        <script>
                                            function validarEdad(input) {
                                                const fechaNacimiento = new Date(input.value);
                                                const hoy = new Date();
                                                let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                                                const mes = hoy.getMonth() - fechaNacimiento.getMonth();

                                                if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                                                    edad--;
                                                }

                                                if (edad < 18) {
                                                    const modalDiv = document.createElement('div');
                                                    modalDiv.innerHTML = `
                                                        <div class="modal fade" id="edadModal" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Aviso</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Debes ser mayor de 18 años para registrarte</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    `;
                                                    document.body.appendChild(modalDiv);
                                                    const modal = new bootstrap.Modal(document.getElementById('edadModal'));
                                                    modal.show();
                                                    input.value = '';
                                                    document.getElementById('edadModal').addEventListener('hidden.bs.modal', function () {
                                                        document.body.removeChild(modalDiv);
                                                    });
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="input-group">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="email" name="email" required
                                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$" maxlength="35"
                                            title="El correo electrónico debe contener @ y terminar en .com, máximo 35 caracteres"
                                            oninvalid="mostrarModalError(this)" placeholder="Email">
                                        <script>
                                            function mostrarModalError(input) {
                                                const modalDiv = document.createElement('div');
                                                modalDiv.innerHTML = `
                                                    <div class="modal fade" id="emailModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Error</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>El correo electrónico debe contener @ y terminar en .com, máximo 35 caracteres</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                document.body.appendChild(modalDiv);
                                                const modal = new bootstrap.Modal(document.getElementById('emailModal'));
                                                modal.show();
                                                document.getElementById('emailModal').addEventListener('hidden.bs.modal', function () {
                                                    document.body.removeChild(modalDiv);
                                                });
                                            }
                                        </script>
                                        <label for="email" style="display: none;">Email</label>
                                    </div>
                                    <div class="input-group">
                                        <i class="fas fa-phone"></i>
                                        <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required
                                            minlength="9" maxlength="15" pattern="[0-9]{9,15}"
                                            title="El teléfono debe tener entre 9 y 15 números"
                                            oninvalid="mostrarModalErrorTelefono(this)">
                                        <script>
                                            function mostrarModalErrorTelefono(input) {
                                                const modalDiv = document.createElement('div');
                                                modalDiv.innerHTML = `
                                                    <div class="modal fade" id="telefonoModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Error</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>El teléfono debe tener entre 9 y 15 números</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                document.body.appendChild(modalDiv);
                                                const modal = new bootstrap.Modal(document.getElementById('telefonoModal'));
                                                modal.show();
                                                document.getElementById('telefonoModal').addEventListener('hidden.bs.modal', function () {
                                                    document.body.removeChild(modalDiv);
                                                });
                                            }
                                        </script>
                                        <label for="telefono" data-section="panel_registro_login.php"
                                            data-value="Telefono" style="display: none;">Teléfono</label>
                                    </div>
                                    <div class="input-group">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="contrasena" name="contrasena"
                                            placeholder="Contraseña" required minlength="5"
                                            pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$"
                                            oninvalid="mostrarModalErrorContrasena(this)">
                                        <script>
                                            function mostrarModalErrorContrasena(input) {
                                                const modalDiv = document.createElement('div');
                                                modalDiv.innerHTML = `
                                                    <div class="modal fade" id="contrasenaModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Error</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>La contraseña debe tener al menos 5 caracteres y contener al menos una letra y un número</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `;
                                                document.body.appendChild(modalDiv);
                                                const modal = new bootstrap.Modal(document.getElementById('contrasenaModal'));
                                                modal.show();
                                                document.getElementById('contrasenaModal').addEventListener('hidden.bs.modal', function () {
                                                    document.body.removeChild(modalDiv);
                                                });
                                            }
                                        </script>
                                        <label for="contrasena" data-section="panel_registro_login.php"
                                            data-value="contrasena" style="display: none;">Contraseña</label>
                                    </div>
                                    <input type="submit" class="btn" value="Registrarse">
                                </form>
                                <div class="links">
                                    <p><span data-section="panel_registro_login.php" data-value="ya tiene cuenta">¿Ya
                                            tienes cuenta? </span><button id="signInButton"><span
                                                data-section="panel_registro_login.php" data-value="iniciar">Iniciar
                                                Sesión</span></button></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre Nosotros</h5>
                    <p>Información sobre la empresa.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="../../index.php" class="text-white">Inicio</a></li>
                        <li><a href="../../pages/rooms.html" class="text-white">Habitaciones</a></li>
                        <li><a href="../../pages/services.html" class="text-white">Servicios</a></li>
                        <li><a href="../../pages/recommendations.html" class="text-white">Recomendaciones</a></li>
                        <li><a href="../../pages/contacto.html" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <!-- Aquí puedes agregar más contenido si lo deseas -->
                </div>
            </div>
            <div class="text-center py-3">
                © 2024 Tu Empresa. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const signUpButton = document.getElementById('signUpButton');
            const signInButton = document.getElementById('signInButton');
            const signUpForm = document.getElementById('signup');
            const signInForm = document.getElementById('signIn');

            signUpButton.addEventListener('click', function (e) {
                e.preventDefault();
                signInForm.style.display = 'none';
                signUpForm.style.display = 'block';
            });

            signInButton.addEventListener('click', function (e) {
                e.preventDefault();
                signUpForm.style.display = 'none';
                signInForm.style.display = 'block';
            });
        });
    </script>
</body>

</html>