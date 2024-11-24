<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reserva tus libros</title>
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
                    <p><?php echo $mensaje; ?></p>
                </div>
            </div>
        </main>
        <?php
            require_once 'footer.php';
        ?>
    </body>
</html>