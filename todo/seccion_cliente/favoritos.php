<?php
include("conexion.php");
session_start();

// Verificar si el usuario está autenticado y es cliente
if (!isset($_SESSION['email']) || $_SESSION['rol'] != 'cliente') {
    header('Location: ../login_form.html');
    exit();
}

$user_email = $_SESSION['email'];

$consulta = "SELECT c.id, c.tipo, c.descripcion, c.imagen, c.precio, c.ubicacion, c.tipo_venta
             FROM contenido_principal c
             JOIN favoritos f ON c.id = f.propiedad_id
             WHERE f.usuario_email = '$user_email'";

$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

$propiedades = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $propiedades[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Favoritos - Cieri Propiedades</title>
    <link rel="stylesheet" href="styles_cliente.css">
</head>
<body>
    <nav>
        <div class="logo"><a href="cliente.php">Cieri Propiedades</a></div>
        <ul class="nav-links">
            <li><a href="cliente.php">Inicio</a></li>
            <li><a href="propiedades.php">Propiedades</a></li>
            <li><a href="favoritos.php">Favoritos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="salir.php">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <div class="favoritos-container">
        <section class="propiedades">
            <?php if (empty($propiedades)): ?>
                <p>No tienes propiedades en tus favoritos.</p>
            <?php else: ?>
                <?php foreach ($propiedades as $propiedad): ?>
                    <article class="propiedad">
                        <h2><?php echo $propiedad['tipo']; ?></h2>
                        <p><?php echo $propiedad['descripcion']; ?></p>
                        <img src="<?php echo '../seccion_admin/' . $propiedad['imagen']; ?>" alt="Imagen de la propiedad">
                        <form  method="POST" action="eliminar_favorito.php">
                            <input type="hidden" name="propiedad_id" value="<?php echo $propiedad['id']; ?>">
                            <button type="submit" class="eliminar-favorito">Eliminar de Favoritos</button>
                        </form>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <!-- Pie de página -->
        <footer>
            <p>Cieri Propiedades &copy; 2024</p>
        </footer>
    </div>
</body>
</html>
