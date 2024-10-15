<?php
$conexion = mysqli_connect("localhost", "root", "", "hotel"); 
//puse la conexion manual porque me tiraba error de direccionamiento, corregir y poner la direccion a conexion.php gio
if (!$conexion)
    echo "Error de conexión";

$salida = "";

if (isset($_POST['consulta'])) {
    $q = mysqli_real_escape_string($conexion, $_POST['consulta']);
    $query = "SELECT * FROM cliente WHERE Activo = 1 AND (id LIKE '%$q%' OR Documento LIKE '%$q%' OR Nombre LIKE '%$q%' OR Apellido LIKE '%$q%' OR Email LIKE '%$q%')";
} else {
    $query = "SELECT * FROM cliente WHERE Activo = 1";
}

$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $salida .= "
            <tr>
                <td>{$fila['Nombre']}</td>
                <td>{$fila['Apellido']}</td>
                <td>{$fila['Email']}</td>
                <td>{$fila['Documento']}</td>
                <td>
                    <button type='button' class='btn btn-success seleccionar-cliente' data-cliente-id='{$fila['id']}' data-cliente-nombre='{$fila['Nombre']} {$fila['Apellido']}'>
                        Seleccionar
                    </button>
                </td>
            </tr>
        ";
    }
} else {
    $salida .= "<tr><td colspan='5'>No se encontraron resultados</td></tr>";
}

echo $salida;
?>
