<?php
    session_start();
    require_once 'controladores/cReserva.php';
    $objReserva = new Creserva();

    $datosReserva = $objReserva->cAniadirLibrosReserva($_POST);

    if($datosReserva) {
        require_once 'vistas/vReservaForm2.php';
    } else {
        $mensaje = $objReserva->mensajeEstado;
        require_once 'vistas/vError.php';
    }
?>