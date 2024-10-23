    
<?php
//include("../registro_login/validacion_sesion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas Activas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
        }

        .reservation-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reservation-info {
            font-size: 16px;
            line-height: 1.5;
        }

        .reservation-info strong {
            display: block;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .cancel-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cancel-btn:hover {
            background-color: #c0392b;
        }
    </style>

    <script>
        function cancelarReserva(idReserva) {
            if (confirm("¿Estás seguro de que deseas cancelar esta reserva?")) {
                // Aquí podrías realizar una solicitud Ajax para cancelar la reserva en el servidor
                window.location.href = 'cancelar_reserva.php?id=' + idReserva;
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Mis Reservas</h1>
    </header>    
    <div class="container">
        <?php include 'mis_reservas_script.php'; ?>
    </div>
</body>
</html>