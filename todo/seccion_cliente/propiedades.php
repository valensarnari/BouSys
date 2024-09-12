<?php
session_start();
include("conexion.php");

// Verificar si el usuario está autenticado y si es cliente
if (isset($_SESSION['email']) && $_SESSION['rol'] == 'cliente') {
    $user_email = $_SESSION['email']; // Asegurarnos de definir esta variable

    // El resto del código
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Propiedades</title>
    <link rel="stylesheet" href="styles_propiedades_cliente.css">
</head>
<body>

   <!-- Barra de navegación -->
   <nav>
        <div class="logo"><a href="cliente.php">Cieri Propiedades</a></div>
        <div class="menu-icon" onclick="toggleMenu()"></div>
        <ul class="nav-links">
            <li><a href="cliente.php">Inicio</a></li>
            <li><a href="propiedades.php">Propiedades</a></li>
            <li><a href="favoritos.php">Favoritos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="salir.php">Cerrar Sesion</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Propiedades</h1>
        
        <!-- Formulario de Filtros -->
        <form method="GET" action="">
            <div class="filter-group">
                <label for="precio_min">Precio Mínimo:</label>
                <input type="number" id="precio_min" name="precio_min" min="0" value="<?php echo isset($_GET['precio_min']) ? $_GET['precio_min'] : ''; ?>">
            </div>
            <div class="filter-group">
                <label for="precio_max">Precio Máximo:</label>
                <input type="number" id="precio_max" name="precio_max" min="0" value="<?php echo isset($_GET['precio_max']) ? $_GET['precio_max'] : ''; ?>">
            </div>
            <div class="filter-group">
                <label for="tipo_venta">Tipo de Venta:</label>
                <select id="tipo_venta" name="tipo_venta">
                    <option value="">Todos</option>
                    <option value="Compra" <?php echo (isset($_GET['tipo_venta']) && $_GET['tipo_venta'] == 'Compra') ? 'selected' : ''; ?>>Compra</option>
                    <option value="Alquiler" <?php echo (isset($_GET['tipo_venta']) && $_GET['tipo_venta'] == 'Alquiler') ? 'selected' : ''; ?>>Alquiler</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="tipo">Tipo de Propiedad:</label>
                <select id="tipo" name="tipo">
                    <option value="">Todos</option>
                    <option value="Casa" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Casa') ? 'selected' : ''; ?>>Casa</option>
                    <option value="Departamento" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Departamento') ? 'selected' : ''; ?>>Departamento</option>
                    <option value="Terreno" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Terreno') ? 'selected' : ''; ?>>Terreno</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="ubicacion">Ubicación:</label>
                <select id="ubicacion" name="ubicacion">
                    <option value="">Todas</option>
                    <option value="Buenos Aires Capital" <?php echo (isset($_GET['ubicacion']) && $_GET['ubicacion'] == 'Buenos Aires Capital') ? 'selected' : ''; ?>>Buenos Aires Capital</option>
                    <option value="Buenos Aires Provincia" <?php echo (isset($_GET['ubicacion']) && $_GET['ubicacion'] == 'Buenos Aires Provincia') ? 'selected' : ''; ?>>Buenos Aires Provincia</option>
                    <option value="Fuera de Buenos Aires" <?php echo (isset($_GET['ubicacion']) && $_GET['ubicacion'] == 'Fuera de Buenos Aires') ? 'selected' : ''; ?>>Fuera de Buenos Aires</option>
                </select>
            </div>
            <div class="filter-buttons">
                <button type="submit">Filtrar</button>
                <button type="button" onclick="window.location.href='propiedades.php'">Limpiar Filtros</button>
            </div>
        </form>
        
        <div class="properties">
            <?php
            // Construir la consulta con filtros
            $consulta = "SELECT id, tipo, descripcion, imagen, precio, ubicacion, tipo_venta FROM contenido_principal WHERE 1=1";

            // Añadir filtros a la consulta
            if (isset($_GET['precio_min']) && $_GET['precio_min'] != '') {
                $precio_min = $_GET['precio_min'];
                $consulta .= " AND precio >= $precio_min";
            }

            if (isset($_GET['precio_max']) && $_GET['precio_max'] != '') {
                $precio_max = $_GET['precio_max'];
                $consulta .= " AND precio <= $precio_max";
            }

            if (isset($_GET['tipo_venta']) && $_GET['tipo_venta'] != '') {
                $tipo_venta = $_GET['tipo_venta'];
                $consulta .= " AND tipo_venta = '$tipo_venta'";
            }

            if (isset($_GET['tipo']) && $_GET['tipo'] != '') {
                $tipo = $_GET['tipo'];
                $consulta .= " AND tipo = '$tipo'";
            }

            if (isset($_GET['ubicacion']) && $_GET['ubicacion'] != '') {
                $ubicacion = $_GET['ubicacion'];
                $consulta .= " AND ubicacion = '$ubicacion'";
            }

            $resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
            
            if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<div class='property'>";
                    echo "<img src='../seccion_admin/".$row['imagen']."' alt='Imagen de la propiedad'>";
                    echo "<h3>".$row['tipo']."</h3>";
                    echo "<p>".$row['descripcion']."</p>";
                    echo "<p>Precio: ".$row['precio']."</p>";
                    echo "<p>Ubicación: ".$row['ubicacion']."</p>";
                    echo "<p>Tipo de Venta: ".$row['tipo_venta']."</p>";

                    // Consultar si la propiedad ya está en favoritos
                    $propiedad_id = $row['id'];
                    $favorito_consulta = "SELECT * FROM favoritos WHERE usuario_email = '$user_email' AND propiedad_id = $propiedad_id";
                    $favorito_resultado = mysqli_query($conexion, $favorito_consulta);

                    if (mysqli_num_rows($favorito_resultado) > 0) {
                        // Si está en favoritos, mostrar el botón para eliminar de favoritos
                        echo "<button id='favorito-".$row['id']."' onclick='eliminarFavorito(".$row['id'].")'>Eliminar de Favoritos</button>";
                    } else {
                        // Si no está en favoritos, mostrar el botón para añadir a favoritos
                        echo "<button id='favorito-".$row['id']."' onclick='agregarFavorito(".$row['id'].")'>Añadir a Favoritos</button>";
                    }

                    echo "</div>";
                }
            } else {
                echo "<p>No se encontraron propiedades que coincidan con los filtros.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>Cieri Propiedades &copy; 2024</p>
    </footer>

    <script>
        function toggleMenu() {
            var menu = document.querySelector('.nav-links');
            menu.classList.toggle('active');
        }

        function agregarFavorito(propiedadId) {
            fetch('agregar_favorito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'propiedad_id=' + propiedadId
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    document.getElementById('favorito-' + propiedadId).innerText = 'Eliminar de Favoritos';
                    document.getElementById('favorito-' + propiedadId).onclick = () => eliminarFavorito(propiedadId);
                } else {
                    alert('Error al agregar favorito: ' + data);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function eliminarFavorito(propiedadId) {
            fetch('eliminar_favorito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'propiedad_id=' + propiedadId
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    document.getElementById('favorito-' + propiedadId).innerText = 'Añadir a Favoritos';
                    document.getElementById('favorito-' + propiedadId).onclick = () => agregarFavorito(propiedadId);
                } else {
                    alert('Error al eliminar favorito: ' + data);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>

<?php
} else {
    // Redirigir a la página de inicio de sesión si no está autenticado
    header('Location: ../login_form.html');
    exit();
}
?>
