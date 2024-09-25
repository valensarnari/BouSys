<?php
include("modals/agregar_empleado.php");
include("../conexion.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---iconos --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <!---bootstrap css --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Lista de empleados</title>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <td scope="col">Nombre</td>
                            <td scope="col">Mail</td>
                            <td scope="col">Rol</td>
                            <td scope="col">Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = "SELECT id, Nombre, Email, Contrasena, Jerarquia FROM usuario_empleados ORDER BY id DESC;";
                        $query = mysqli_query($conexion, $select);
                        while ($resultado = mysqli_fetch_array($query)) {
                            ?>
                        <tr>
                            <td scope="row">
                                <?php echo $resultado['1'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $resultado['2'] ?>
                            </td>
                            <td scope="row">
                                <?php
                                if ($resultado['4'] == 0)
                                    echo "Gerente";
                                else
                                    echo "Recepcionista";
                                ?>
                            </td>
                            <td scope="row">
                                <!-- Activa modal de editar -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editar<?php echo $resultado['0'] ?>">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <!-- Activa modal de eliminar -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#eliminar<?php echo $resultado['0'] ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                            include("modals/eliminar_empleado.php");
                            include("modals/editar_empleado.php");
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Activa modal de agregar -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
                    Agregar empleado <i class="fa-solid fa-user-plus"></i>
                </button>
            </div>
        </div>
    </div>
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>