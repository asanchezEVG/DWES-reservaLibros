<?php
    // var_dump($_POST);
    session_start();
    require_once 'controladores/cReserva.php';
    $objReserva = new CReserva();

    // En la tabla usuarios van los padres
    // Al llamar este método se comprueban los valores de $_POST y te devuelve el precio total

    $total = $objReserva->cPrecioTotal($_POST); // Esto se puede

    if($total) {
        $datosReserva = $_POST;
        require_once 'vistas/vReservaForm3.php';
    } else {
        $mensaje = $objReserva->mensajeEstado;
        require_once 'vistas/vError.php';
    }
?>