<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #121212;
            color: #a8b2d1;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            width: 350px;
        }
        .form-title {
            color: #57cbff;
            text-align: center;
            margin-bottom: 20px;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        .input-group i {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #57cbff;
        }
        .input-group input, .input-group select {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #233554;
            border-radius: 5px;
            background-color: #112240;
            color: #ccd6f6;
            font-size: 16px;
            box-sizing: border-box;
        }
        .input-group input::placeholder, .input-group select::placeholder {
            color: #8892b0;
        }
        .input-group label {
            position: absolute;
            left: 35px;
            top: 12px;
            color: #8892b0;
            transition: 0.3s ease all;
            pointer-events: none;
        }
        .input-group input:focus ~ label, .input-group input:valid ~ label,
        .input-group select:focus ~ label, .input-group select:valid ~ label {
            top: -20px;
            font-size: 12px;
            color: #57cbff;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #57cbff;
            color: #020c1b;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #4aa3cc;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links p {
            margin-bottom: 5px;
        }
        .links button, .recover a {
            background: none;
            border: none;
            color: #57cbff;
            cursor: pointer;
            font-size: 14px;
        }
        .links button:hover, .recover a:hover {
            text-decoration: underline;
        }
        .recover {
            text-align: right;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <!-- Contenedor para el Registro -->
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Registro</h1>
        <form action="registro.php" method="POST">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                <label for="apellido">Apellido</label>
            </div>
            <div class="input-group">
                <i class="fas fa-id-card"></i>
                <input type="text" id="dni" name="dni" placeholder="DNI" required>
                <label for="dni">DNI</label>
            </div>
            <div class="input-group">
                <i class="fas fa-globe"></i>
                <input type="text" id="nacionalidad" name="nacionalidad" placeholder="Nacionalidad" required>
                <label for="nacionalidad">Nacionalidad</label>
            </div><br>
            <div class="input-group">
                <i class="fas fa-venus-mars"></i>
                <select id="sexo" name="sexo" required>
                    <option value="">Selecciona tu sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
                <label for="sexo">Sexo</label>
            </div><br>
            <div class="input-group">
                <i class="fas fa-calendar"></i>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-phone"></i>
                <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required>
                <label for="telefono">Teléfono</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                <label for="contrasena">Contraseña</label>
            </div>
            <input type="submit" class="btn" value="Registrarse">
        </form>
        <div class="links">
            <p>¿Ya tienes cuenta?</p>
            <button id="signInButton">Iniciar Sesión</button>
        </div>
    </div>

    <!-- Contenedor para el Login -->
    <div class="container" id="signIn">
        <h1 class="form-title">Iniciar Sesión</h1>
        <form action="login.php" method="POST">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email_login" name="email_login" placeholder="Email" required>
                <label for="email_login">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password_login" name="password_login" placeholder="Contraseña" required>
                <label for="password_login">Contraseña</label>
            </div>
            <p class="recover">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </p>
            <input type="submit" class="btn" value="Iniciar Sesión">
        </form>
        <div class="links">
            <p>¿No tienes cuenta?</p>
            <button id="signUpButton">Regístrate</button>
        </div>
    </div>

    <script src="script_registro_login.js"></script>

</body>

</html>