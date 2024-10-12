<?php
include("conexion.php");


// Manejo de búsqueda
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    $query = "SELECT * FROM usuarios WHERE rol = 'cliente' AND (nombre_completo LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%')";
} else {
    $query = "SELECT * FROM usuarios WHERE rol = 'cliente'";
}

// Manejo de eliminación
if (isset($_POST['delete'])) {
    $userId = $_POST['userId'];
    $deleteQuery = "DELETE FROM usuarios WHERE id = $userId";
    $conexion->query($deleteQuery);
    header("Location: admin.php?section=users");
}

$result = $conexion->query($query);

// Verificar si el usuario está autenticado y si es administrador
if (isset($_SESSION['email']) && $_SESSION['rol'] == 'admin') {
    // Usuario autenticado y es administrador, se muestra la página del administrador

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>
<body>
    <h2>Gestión de Usuarios</h2>
    <form method="post" action="admin.php?section=users">
        <input type="text" name="searchTerm" placeholder="Buscar usuarios" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit" name="search">Buscar</button>
        <button type="submit" name="clear">Limpiar Búsqueda</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre_completo']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <form method="post" action="admin.php?section=users" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                    <input type="hidden" name="userId" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
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
