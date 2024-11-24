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
                    <h1>Reserva Libros</h1>
                    <form action="reservaForm2.php" method="post">
                        <label for="tutor">Padre/Madre/Tutor Legal (Opcional)</label>
                        <input type="text" id="tutor" name="tutor" placeholder="Nombre del padre, madre o tutor legal">
                        <label for="dni">DNI</label>
                        <input type="text" id="dni" name="dni" minlength="9" maxlength="9" placeholder="DNI">
                        <label for="nombre">Nombre del alumno</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre del alumno">
                        <label for="cursos">Selecciona el curso al que perteneces</label>
                        <select name="cursos" id="cursos">
                            <option value="" disabled selected>Selecciona un curso</option>
                            <?php 
                                foreach ($cursos as $curso) { 
                                    echo "<option value='{$curso['codCurso']}'>{$curso['codCurso']} - {$curso['nombreCurso']}</option>"; 
                                } 
                            ?>
                        </select>

                        <input type="submit" class="boton mtb-2" value="Siguiente">
                    </form>
                    <a href="inicio.html" class="boton">Volver</a>
                </div>
            </div>
        </main>
        <?php
            require_once 'footer.php';
        ?>
    </body>
</html>