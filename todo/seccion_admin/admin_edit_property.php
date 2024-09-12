<?php
session_start();
include("conexion.php");

// Verificar si el usuario está autenticado y si es administrador
if (isset($_SESSION['email']) && $_SESSION['rol'] == 'admin') {
    // Usuario autenticado y es administrador, se muestra la página del administrador
    ?>


<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $ubicacion = $_POST['ubicacion'];
        $tipo_venta = $_POST['tipo_venta'];
        $imagen = $_POST['imagen']; // Ahora se obtiene como texto

        $consulta = "UPDATE contenido_principal SET tipo='$tipo', descripcion='$descripcion', imagen='$imagen', 
                     precio=$precio, ubicacion='$ubicacion', tipo_venta='$tipo_venta' WHERE id=$id";

        if (mysqli_query($conexion, $consulta)) {
            echo "Propiedad actualizada correctamente.";
        } else {
            echo "Error al actualizar la propiedad: " . mysqli_error($conexion);
        }
        mysqli_close($conexion);
        header("Location: admin.php?section=properties");
        exit();
    } else {
        $consulta = "SELECT * FROM contenido_principal WHERE id=$id";
        $resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        $propiedad = mysqli_fetch_assoc($resultado);
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Propiedad</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>
     <!-- Barra de navegación -->
     <nav>
            <div class="logo"><a href="admin.php">Panel Administrador</a></div>
            <ul>
                <li><a href="salir.php">Cerrar Sesion</a></li>
            </ul>
        </nav>

        <h1>Editar Propiedad</h1>
    

     


    <form method="POST" action="">
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Departamento" <?php if($propiedad['tipo'] == 'Departamento') echo 'selected'; ?>>Departamento</option>
            <option value="Casa" <?php if($propiedad['tipo'] == 'Casa') echo 'selected'; ?>>Casa</option>
            <option value="Terreno" <?php if($propiedad['tipo'] == 'Terreno') echo 'selected'; ?>>Terreno</option>
        </select>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $propiedad['descripcion']; ?></textarea>

        <label for="imagen">Imagen (URL):</label>
        <input type="text" id="imagen" name="imagen" value="<?php echo $propiedad['imagen']; ?>" required>
        <p>Imagen actual: <img src="<?php echo $propiedad['imagen']; ?>" alt="Imagen actual" width="100"></p>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="<?php echo $propiedad['precio']; ?>" required>

        <label for="ubicacion">Ubicación:</label>
        <select id="ubicacion" name="ubicacion" required>
            <option value="Buenos Aires Provincia" <?php if($propiedad['ubicacion'] == 'Buenos Aires Provincia') echo 'selected'; ?>>Buenos Aires Provincia</option>
            <option value="Buenos Aires Capital" <?php if($propiedad['ubicacion'] == 'Buenos Aires Capital') echo 'selected'; ?>>Buenos Aires Capital</option>
            <option value="Fuera de Buenos Aires" <?php if($propiedad['ubicacion'] == 'Fuera de Buenos Aires') echo 'selected'; ?>>Fuera de Buenos Aires</option>
        </select>

        <label for="tipo_venta">Tipo de Venta:</label>
        <select id="tipo_venta" name="tipo_venta" required>
            <option value="Compra" <?php if($propiedad['tipo_venta'] == 'Compra') echo 'selected'; ?>>Compra</option>
            <option value="Alquiler" <?php if($propiedad['tipo_venta'] == 'Alquiler') echo 'selected'; ?>>Alquiler</option>
        </select>

        <button type="submit">Actualizar Propiedad</button>
    </form>

     <!-- Pie de página -->
     <footer>
            <p>Cieri Propiedades &copy; 2024</p>
        </footer>
</body>
</html>
<?php
} else {
    // Si no está autenticado o no es administrador, redirigir a la página de inicio de sesión
    header('Location: ../login_form.html');
    exit();
}
?>