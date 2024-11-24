<?php
    require_once 'controladores/cReserva.php';
    $objReserva = new Creserva();

    $estado = $objReserva->cHacerReserva($_POST);

    if($estado) {
        $mensaje = 'Reserva realizada correctamente';
        require_once 'vistas/vConfirmacionReserva.php';
    } else {
        $mensaje = 'La reserva no ha podido realizarse';
        require_once 'vistas/vError.php';
    }

?>