<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecciona tus Libros</title>
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
                    <h1>Selecciona tus Libros</h1>
                    <form action="reservaForm3.php" method="post">
                        <?php 
                            foreach($datosReserva['libros'] as $libro) {
                                echo '<label><input type="checkbox" name="libro[]" value="' . $libro['idLibro'] . '"> ' 
                                . $libro['titulo'] . ' - €' . number_format($libro['precio'], 2) . '</label><br>';
                            }
                        ?>
                        <input type="submit" class="boton mtb-2" value="Reservar libros">
                        <a href="ReservaForm1.php" class="boton mtb-2">Volver atrás</a>
                        <input type="hidden" name="tutor" value="<?php echo $datosReserva['tutor']?>"> <!-- En value cargamos los datos del form anterior para pasarlos al siguiente formulario -->
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