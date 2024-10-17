<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles_registro_login.css">
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
            </div>
            <div class="input-group">
                <i class="fas fa-venus-mars"></i>
                <select id="sexo" name="sexo" required>
                    <option value="">Selecciona tu sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
                <label for="sexo">Sexo</label>
            </div>
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
