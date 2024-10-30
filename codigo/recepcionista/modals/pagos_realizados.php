<?php
$sql_pagos = "SELECT Fecha_Pago, Medio_De_Pago, Descuento, Aumento, Total 
              FROM pago 
              WHERE ID_Reserva = " . $resultado['0'];
$query_pagos = mysqli_query($conexion, $sql_pagos);

$total_pagado = 0;

if (mysqli_num_rows($query_pagos) > 0) {
    echo "<div class='list-group mb-3'>";
    while ($pago = mysqli_fetch_array($query_pagos)) {
        echo "<div class='list-group-item'>";
        echo "<div class='d-flex justify-content-between align-items-center'>";
        echo "<div>";
        echo "<p class='mb-1'>Fecha: " . $pago['Fecha_Pago'] . "</p>";
        echo "<p class='mb-1'>Medio de pago: " . $pago['Medio_De_Pago'] . "</p>";
        if ($pago['Descuento'] > 0)
            echo "<p class='mb-1'>Descuento: $" . $pago['Descuento'] . "</p>";
        if ($pago['Aumento'] > 0)
            echo "<p class='mb-1'>Aumento: $" . $pago['Aumento'] . "</p>";
        echo "</div>";
        echo "<div class='text-end'>";
        echo "<h6 class='mb-0'>$" . number_format($pago['Total'], 2) . "</h6>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        $total_pagado += $pago['Total'];
    }
    echo "</div>";

    // Mostrar resumen de pagos
    $monto_restante = $resultado['7'] - $total_pagado;
    
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<div class='row'>";
    echo "<div class='col-md-4'>";
    echo "<div class='text-center'>";
    echo "<h6 class='mb-1'>Valor Total</h6>";
    echo "<h5 class='mb-0'>$" . number_format($resultado['7'], 2) . "</h5>";
    echo "</div>";
    echo "</div>";
    echo "<div class='col-md-4'>";
    echo "<div class='text-center'>";
    echo "<h6 class='mb-1'>Total Pagado</h6>";
    echo "<h5 class='mb-0'>$" . number_format($total_pagado, 2) . "</h5>";
    echo "</div>";
    echo "</div>";
    echo "<div class='col-md-4'>";
    echo "<div class='text-center'>";
    echo "<h6 class='mb-1'>Resta Pagar</h6>";
    echo "<h5 class='mb-0 " . ($monto_restante > 0 ? 'text-danger' : 'text-success') . "'>";
    echo "$" . number_format($monto_restante, 2);
    echo "</h5>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo "<p class='text-muted'>No se han realizado pagos para esta reserva.</p>";
}
?> 