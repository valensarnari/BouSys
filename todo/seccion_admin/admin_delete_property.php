

<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $consulta = "DELETE FROM contenido_principal WHERE id=$id";

    if (mysqli_query($conexion, $consulta)) {
        echo "Propiedad eliminada correctamente.";
    } else {
        echo "Error al eliminar la propiedad: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
    header("Location: admin.php?section=properties");
    exit();
}
?>
