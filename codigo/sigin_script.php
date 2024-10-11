<?php

session_start();

$conexion = new mysqli("localhost", "root", "", "hotel")
or die('no se pudo conectar al servidor');

        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];

        $consulta_existencia = mysqli_query(
            $conexion, "SELECT Email FROM cliente UNION SELECT Email FROM usuario_empleados");

        if(mysqli_num_rows($consulta_existencia) > 0)
        {
            $sql = "SELECT id, Nombre, Email, Contrasena, Jerarquia 
                    FROM cliente 
                    WHERE Email = ?
                    UNION
                    SELECT id, Nombre, Email, Contrasena, Jerarquia 
                    FROM usuario_empleados 
                    WHERE Email = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $email, $email);
            $stmt->execute();
            $stmt->bind_result($id, $nombre, $email, $hashed_password, $jerarquia);
            $stmt->fetch();

            if (password_verify($contrasena, $hashed_password)){
                $_SESSION['id'] = $id;
                $_SESSION['Email'] = $email;
                $_SESSION['Nombre'] = $nombre;
                $_SESSION['Jerarquia'] = $jerarquia;


                echo "Inicio de sesion exitoso";

            $stmt->close();
            }
            else
            {
                echo "Email o contraseña incorrectos1";
            }
        }
        else
        {    
            echo "Email o contraseña incorrectos";
        }

$conexion->close();
?>