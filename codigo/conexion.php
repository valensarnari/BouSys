<?php

$conexion = mysqli_connect("localhost:3302", "root", "", "hotel");

if (!$conexion)
    echo "Error de conexión";