<?php

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
    <title>Lista de clientes</title>
</head>

<body>
    <div class="d-flex">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none"> <!--direccionar -->
                    <span class="fs-5 d-none d-sm-inline">BouSys</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="../../" class="nav-link align-middle px-0"> <!--cambiar -->
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-house"></i> Volver a inicio 
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="habitaciones.php" class="nav-link align-middle px-0"> <!--cambiar -->
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-user"></i> Habitaciones
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="listado_clientes_recepcionista.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-address-book"></i> Gestión de clientes
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reservas.php" class="nav-link align-middle px-0"> <!--cambiar -->
                            <span class="ms-1 d-none d-sm-inline">
                                <i class="fa-solid fa-chart-simple"></i> Reservas
                            </span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"  
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false"> <!--direccionar  -->
                        <span class="d-none d-sm-inline mx-1">nombreperfil</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li> <!--direccionar-->
                    </ul>
                </div>
            </div>
        </div>



    <!-- Visualizar reservas (siempre visible) -->
    <div class="container my-4">
        <h2>Reservas Actuales</h2>

        <div id="reservas-list">
            <?php include('actions/visualizar_reserva.php'); ?>
        </div>

        <!-- Botones para abrir modales -->
        <div class="mt-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reservarModal">
                Reservar Habitación
            </button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modificarModal">
                Modificar Reserva
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelarModal">
                Cancelar Reserva
            </button>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#checkinCheckoutModal">
                Check-in / Check-out
            </button>
        </div>
    </div>



    <!-- Incluir los modales -->
    <?php include('modals/reservar_habitacion_modal.php'); ?>
    <?php include('modals/modificar_habitacion_modal.php'); ?>
    <?php include('modals/cancelar_reserva_modal.php'); ?>
    <?php include('modals/check_in_check_out_modal.php'); ?>


    <div>

    <?php include('actions/visualizar_checkin_checkout.php'); ?>
    
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    </div>
</body>

<!---bootstrap js --->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

   



</html>