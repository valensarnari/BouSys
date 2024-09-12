<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cieri Propiedades</title>
    <link rel="stylesheet" href="styles_index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <div class="logo"><a href="index.php">Cieri Propiedades</a></div>
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <ul class="nav-links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="propiedades.php">Propiedades</a></li>
            <li><a href="contacto.html">Contacto</a></li>
            <li><a href="registro_form.html">Iniciar Sesión</a></li>
        </ul>
    </nav>

    <!-- Encabezado de la página -->
    <header>
        <h1>Tu Sitio de Bienes Raíces</h1>
        <p>Encuentra la propiedad perfecta para ti.</p>
    </header>

    <!-- Buscar Propiedad -->
    <section class="busqueda">
        <div class="opciones">
            <button class="tab" id="alquilar" onclick="setType('Alquiler')">Alquilar</button>
            <button class="tab" id="comprar" onclick="setType('Compra')">Comprar</button>
        </div>
        <div class="filtros">
            <select id="propertyType" onchange="setPropertyType(this.value)">
                <option value="">Tipo de Propiedad</option>
                <option value="Casa">Casa</option>
                <option value="Departamento">Departamento</option>
                <option value="Terreno">Terreno</option>
            </select>
            <input type="text" id="searchLocationInput" placeholder="Ubicación">
            <input type="text" id="searchDescriptionInput" placeholder="Descripción">
            <button onclick="searchProperties()">Buscar</button>
        </div>
    </section>

    <!-- Contenido principal -->
    <section class="propiedades">
        <article class="propiedad">
            <h2 id="propertyTitle">Propiedad 1</h2>
            <p id="propertyDescription">Descripción de la propiedad.</p>
            <a id="propertyDetails" href="#"></a>
            <img id="propertyImage" src="" alt="Imagen de propiedad" data-fancybox="gallery">
            <p><strong>Precio: </strong><span id="propertyPrice"></span></p>
            <p><strong>Ubicación: </strong><span id="propertyLocation"></span></p>
            <p><strong>Tipo: </strong><span id="propertySaleType"></span></p>
        </article>
        <div class="navigation">
            <button id="prevProperty" onclick="prevProperty()">Anterior</button>
            <button id="nextProperty" onclick="nextProperty()">Siguiente</button>
        </div>
    </section>

    <!-- Pie de página -->
    <footer>
        <p>Cieri Propiedades &copy; 2024</p>
    </footer>

    <script>
        let type = '';
        let propertyType = '';
        let properties = [];
        let currentPropertyIndex = 0;

        <?php
        // Conexión a la base de datos
        include("conexion.php");

        // Realizar la consulta para obtener las propiedades
        $consulta = "SELECT id, tipo, descripcion, imagen, precio, ubicacion, tipo_venta FROM contenido_principal";
        $resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));

        // Convertir resultados de la consulta a formato JSON
        $propiedades = array();
        while($row = mysqli_fetch_assoc($resultado)) {
            $propiedades[] = $row;
        }
        echo "properties = " . json_encode($propiedades) . ";";
        ?>

        function setType(selectedType) {
            type = selectedType;
        }

        function setPropertyType(selectedPropertyType) {
            propertyType = selectedPropertyType;
        }

        function searchProperties() {
            let searchLocationInput = document.getElementById("searchLocationInput").value;
            let searchDescriptionInput = document.getElementById("searchDescriptionInput").value;
            let queryParams = `?tipo_venta=${type}&tipo=${propertyType}&ubicacion=${searchLocationInput}&descripcion=${searchDescriptionInput}`;
            window.location.href = `propiedades.php${queryParams}`;
        }

        function showProperty(index) {
            if (properties.length > 0) {
                document.getElementById("propertyTitle").innerText = properties[index].tipo;
                document.getElementById("propertyDescription").innerText = properties[index].descripcion;
                document.getElementById("propertyDetails").href = `detalle.php?id=${properties[index].id}`;
                document.getElementById("propertyImage").src = `seccion_admin/${properties[index].imagen}`;
                document.getElementById("propertyPrice").innerText = `$${properties[index].precio.toLocaleString()}`;
                document.getElementById("propertyLocation").innerText = properties[index].ubicacion;
                document.getElementById("propertySaleType").innerText = properties[index].tipo_venta;
            }
        }

        function nextProperty() {
            currentPropertyIndex = (currentPropertyIndex + 1) % properties.length;
            showProperty(currentPropertyIndex);
        }

        function prevProperty() {
            currentPropertyIndex = (currentPropertyIndex - 1 + properties.length) % properties.length;
            showProperty(currentPropertyIndex);
        }

        $(document).ready(function() {
            showProperty(currentPropertyIndex); // Mostrar la primera propiedad inicialmente
            setInterval(nextProperty, 6000); // Cambiar propiedad cada 6 segundos

            $('[data-fancybox="gallery"]').fancybox({
                // Opciones para Fancybox gallery
            });
        });

        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>
