

<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
    $precio = $_POST['precio'];
    $ubicacion = $_POST['ubicacion'];
    $tipo_venta = $_POST['tipo_venta'];

    $consulta = "INSERT INTO contenido_principal (tipo, descripcion, imagen, precio, ubicacion, tipo_venta) 
                 VALUES ('$tipo', '$descripcion', '$imagen', $precio, '$ubicacion', '$tipo_venta')";

    if (mysqli_query($conexion, $consulta)) {
        echo "Propiedad agregada correctamente.";
    } else {
        echo "Error al agregar la propiedad: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
    header("Location: admin.php?section=properties");
    exit();
}
?>
