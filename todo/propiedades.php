<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Propiedades</title>
    <link rel="stylesheet" href="styles_propiedades.css">
</head>
<body>

    <!-- Barra de navegación -->
    <nav>
        <div class="logo"><a href="index.php">Cieri Propiedades</a></div>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="propiedades.php">Propiedades</a></li>
            <li><a href="contacto.html">Contacto</a></li>
            <li><a href="registro_form.html">Iniciar Sesión</a></li>
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
            // Conexión a la base de datos
            include("conexion.php");

            // Construir la consulta con filtros
            $consulta = "SELECT tipo, descripcion, imagen, precio, ubicacion, tipo_venta FROM contenido_principal WHERE 1=1";

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

            // Realizar la consulta
            $resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo '<div class="property">';
                    echo '<img src="seccion_admin/' . $row["imagen"] . '" alt="' . $row["tipo"] . '">';
                    echo '<h2>' . $row["tipo"] . '</h2>';
                    echo '<p>' . $row["descripcion"] . '</p>';
                    echo '<p><strong>Precio: </strong>$' . number_format($row["precio"], 2) . '</p>';
                    echo '<p><strong>Ubicación: </strong>' . $row["ubicacion"] . '</p>';
                    echo '<p><strong>Tipo: </strong>' . $row["tipo_venta"] . '</p>';
                    
                    echo '</div>';
                }
            } else {
                echo "0 resultados";
            }
            $conexion->close();
            ?>
        </div>
    </div>

        <!-- Pie de página -->
        <footer>
        <p>Cieri Propiedades &copy; 2024</p>
    </footer>
</body>
</html>
