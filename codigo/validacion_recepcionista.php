<?php
    session_start();


    function validarGerente($destino){
        //Verifica la jerarquia de la sesion
        if (isset($_SESSION['Jerarquia']) && ($_SESSION['Jerarquia']) === '1') {
            //si el usuario tiene jerarquia 0 (Gerente) y no esta en la pagina de destino, redirigir
            if(basename($_SERVER['PHP_SELF']) !== $destino){
            header("Location: $destino");
            exit;
            } 
            // Si ya está en la página de destino, no se hace nada (ya pasó la validación)
        }else{
            // Si no tiene la jerarquía correcta, redirigir a la página de inicio
                header("Location: ../../index.html");

            }       
    }
?>