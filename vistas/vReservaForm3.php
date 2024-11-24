<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmar Reserva</title>
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php
            require_once 'header.php';
            require_once 'nav.php';
        ?>
        <main>
            <div class="tabla">
                <div class="container">
                    <h1>Confirmar Reserva</h1>
                    <form action="almacenarReserva.php" method="post">
                        <label for="precio">Precio total de tu reserva</label>
                        <input type="text" id="precio" name="precio" readonly value="€<?php echo number_format($total, 2); ?>">
                        
                        <label for="justificante">Adjuntar Justificante de Pago</label>
                        <input type="file" id="justificante" name="justificante" required>
                        
                        <input type="submit" class="boton mtb-2" value="Confirmar Reserva">
                        <a href="ReservaForm2.php" class="boton mtb-2">Volver atrás</a>
                        <?php 
                            /**
                             * $datosReserva['libro'] es un array con los id's de los libros seleccionados
                             * Aquí concatenamos para poner uno detrás de otro separados por # para luego
                             * Hacer un "split" (explode) para obtener el array
                             */
                            $inputHidden = '<input type="hidden" name="libro" value="';
                            foreach($datosReserva['libro'] as $idLibro) {
                                $inputHidden = $inputHidden . $idLibro . '#';
                            }
                            $inputHidden = substr($inputHidden, 0, -1);
                            $inputHidden = $inputHidden . '">';
                            echo $inputHidden; // Esto es lo que manda el array de libros al navegador
                        ?>
                        <input type="hidden" name="tutor" value="<?php echo $datosReserva['tutor']?>">
                        <input type="hidden" name="dni" value="<?php echo $datosReserva['dni']?>">
                        <input type="hidden" name="nombre" value="<?php echo $datosReserva['nombre']?>">
                        <input type="hidden" name="cursos" value="<?php echo $datosReserva['cursos']?>">
                    </form>
                </div>
            </div>
        </main>
        <?php
            require_once 'footer.php';
        ?>
    </body>
</html>