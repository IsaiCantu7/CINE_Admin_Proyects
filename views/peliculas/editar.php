<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Película</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Editar Película</h1>
        <form action="index.php?controller=PeliculasController&action=editar" method="POST">
            <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula']; ?>">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $pelicula['titulo']; ?>">
            </div>
            <div class="form-group">
                <label for="director">Director:</label>
                <input type="text" class="form-control" id="director" name="director" value="<?php echo $pelicula['director']; ?>">
            </div>
            <div class="form-group">
                <label for="genero">Género:</label>
                <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $pelicula['genero']; ?>">
            </div>
            <div class="form-group">
                <label for="duracion">Duración (minutos):</label>
                <input type="number" class="form-control" id="duracion" name="duracion" value="<?php echo $pelicula['duracion_minutos']; ?>">
            </div>
            <div class="form-group">
                <label for="clasificacion">Clasificación:</label>
                <input type="text" class="form-control" id="clasificacion" name="clasificacion" value="<?php echo $pelicula['clasificacion']; ?>">
            </div>
            <div class="form-group">
                <label for="sinopsis">Sinopsis:</label>
                <textarea class="form-control" id="sinopsis" name="sinopsis"><?php echo $pelicula['sinopsis']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="fecha_estreno">Fecha de Estreno:</label>
                <input type="date" class="form-control" id="fecha_estreno" name="fecha_estreno" value="<?php echo $pelicula['fecha_estreno']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
