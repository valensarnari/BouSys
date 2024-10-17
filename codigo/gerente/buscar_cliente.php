<?php
include("../conexion.php");


$salida = "";

if (isset($_POST['consulta'])) {
    $q = mysqli_real_escape_string($conexion, $_POST['consulta']);
    $query = "SELECT * FROM cliente WHERE Activo = 1 AND Apellido LIKE '%" . $q . "%'";
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
                <td>{$fila['Nacionalidad']}</td>
                <td>{$fila['Sexo']}</td>
                <td>
                    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#detalle{$fila['id']}'><i class='fa-solid fa-address-card'></i></button>
                    <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editar{$fila['id']}'><i class='fa-solid fa-pen'></i></button>
                    <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#eliminar{$fila['id']}'><i class='fa-solid fa-trash'></i></button>
                </td>
            </tr>
        ";
    }
} else {
    $salida .= "<tr><td colspan='6'>No se encontraron resultados</td></tr>";
}

echo $salida;
