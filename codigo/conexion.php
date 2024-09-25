<?php

$conexion = mysqli_connect("localhost", "root", "", "hotel");

if (!$conexion)
    echo "Error de conexión";