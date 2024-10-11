<?php

$conexion = mysqli_connect("localhost:3306", "root", "", "hotel");

if (!$conexion)
    echo "Error de conexión";

?>