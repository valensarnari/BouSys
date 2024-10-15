<?php
$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
//puse la conexion manual porque me tiraba error de direccionamiento, corregir y poner la direccion a conexion.php gio
if (!$conexion)
    echo "Error de conexión";

if (isset($_GET['cliente_busqueda']) && !empty($_GET['cliente_busqueda'])) {
    $busqueda = $_GET['cliente_busqueda'];

    $query = "SELECT id, Nombre, Apellido FROM cliente 
              WHERE id LIKE '%$busqueda%' 
              OR Documento LIKE '%$busqueda%' 
              OR Nombre LIKE '%$busqueda%' 
              OR Apellido LIKE '%$busqueda%' 
              OR Email LIKE '%$busqueda%'";
    
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<ul class='list-group mt-3'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $nombre_completo = $row['Nombre'] . ' ' . $row['Apellido'];
            // Enlace con el ID del cliente seleccionado y nombre
            echo "<li class='list-group-item'>";
            echo "<a href='reservar_habitacion.php?cliente_id=" . $row['id'] . "&nombre_cliente=" . urlencode($nombre_completo) . "'>";
            echo $nombre_completo . " (ID: " . $row['id'] . ")";
            echo "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No se encontraron resultados.";
    }
}
?>
