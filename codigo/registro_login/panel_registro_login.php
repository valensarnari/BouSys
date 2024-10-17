<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Login</title>
    <link rel="stylesheet" href="estilos.css"> 
</head>
<body>

<h2>Formulario de Registro</h2>
<form action="registro.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required><br>

    <label for="dni">DNI:</label>
    <input type="text" id="dni" name="dni" required><br>

    <!-- poner bien las nacionalidades gio -->
    <label for="nacionalidad">Nacionalidad:</label>
    <input type="text" id="nacionalidad" name="nacionalidad" required><br>

    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Otro">Otro</option>
    </select><br>

    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="telefono">Número de Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>

    <input type="submit" value="Registrarse">
</form>


<h2>Formulario de Login</h2>
 <!-- Formulario de Login -->
 <form action="login.php" method="POST">
            <h2>Login</h2>
            <label for="email_login">Email:</label>
            <input type="email" id="email_login" name="email_login" required><br>

            <label for="password_login">Contraseña:</label>
            <input type="password" id="password_login" name="password_login" required><br>

            <input type="submit" value="Iniciar Sesión">
        </form>

</body>
</html>
