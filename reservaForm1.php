<?php
    session_start();
    require_once 'controladores/cReserva.php';
    $objReserva = new CReserva();

    $cursos = $objReserva->cMostrarCurso();

    if($cursos) {
        require_once 'vistas/vReservaForm1.php';
    } else {
        $mensaje = "No hay cursos disponibles";
        require_once 'vistas/vError.php';
    }
?>