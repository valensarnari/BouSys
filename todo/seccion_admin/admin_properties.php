<?php

include("conexion.php");

// Verificar si el usuario está autenticado y si es administrador
if (isset($_SESSION['email']) && $_SESSION['rol'] == 'admin') {
    // Usuario autenticado y es administrador, se muestra la página del administrador
    ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Propiedades</title>
</head>
<body>
    <h2>Administrar Propiedades</h2>

    <!-- Para preguntar si quiere eliminar la propiedad -->
    <script>
        function confirmarEliminacion(id) {
            if (confirm('¿Está seguro de que quiere eliminar esta propiedad?')) {
                window.location.href = 'admin_delete_property.php?id=' + id;
            }
        }
    </script>

    <!-- Formulario para agregar nueva propiedad -->
    <h3>Agregar Nueva Propiedad</h3>
    <form method="POST" action="admin_add_property.php">
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Departamento">Departamento</option>
            <option value="Casa">Casa</option>
            <option value="Terreno">Terreno</option>
        </select>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        
        <label for="imagen">Imagen (URL):</label>
        <input type="text" id="imagen" name="imagen" required>
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required>
        
        <label for="ubicacion">Ubicación:</label>
        <select id="ubicacion" name="ubicacion" required>
            <option value="Buenos Aires Provincia">Buenos Aires Provincia</option>
            <option value="Buenos Aires Capital">Buenos Aires Capital</option>
            <option value="Fuera de Buenos Aires">Fuera de Buenos Aires</option>
        </select>
        
        <label for="tipo_venta">Tipo de Venta:</label>
        <select id="tipo_venta" name="tipo_venta" required>
            <option value="Compra">Compra</option>
            <option value="Alquiler">Alquiler</option>
        </select>
        
        <button type="submit">Agregar Propiedad</button>
    </form>

    <!-- Listado de propiedades existentes -->
    <h3>Propiedades Existentes</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Ubicación</th>
            <th>Tipo de Venta</th>
            <th>Acciones</th>
        </tr>
        <?php
        include("conexion.php");
        $consulta = "SELECT * FROM contenido_principal";
        $resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["tipo"] . '</td>';
                echo '<td>' . $row["descripcion"] . '</td>';
                echo '<td><img src="' . $row["imagen"] . '" alt="' . $row["descripcion"] . '" width="100"></td>';
                echo '<td>' . $row["precio"] . '</td>';
                echo '<td>' . $row["ubicacion"] . '</td>';
                echo '<td>' . $row["tipo_venta"] . '</td>';
                echo '<td>
                        <a href="admin_edit_property.php?id=' . $row["id"] . '">Editar</a>
                        <a href="#" onclick="confirmarEliminacion(' . $row["id"] . ')">Eliminar</a>
                    </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="8">No hay propiedades.</td></tr>';
        }
        ?>
    </table>
</body>
</html>
<?php
} else {
    // Si no está autenticado o no es administrador, redirigir a la página de inicio de sesión
    header('Location: ../login_form.html');
    exit();
}
?>
