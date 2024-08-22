<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Películas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .pelicula {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h1>Listado de Películas</h1>

        <div class="row">
            <?php foreach ($peliculas as $pelicula): ?>
                <div class="col-md-4">
                    <div class="pelicula">
                        <h3><?php echo $pelicula['titulo']; ?></h3>
                        <p><strong>Director:</strong> <?php echo $pelicula['director']; ?></p>
                        <p><strong>Género:</strong> <?php echo $pelicula['genero']; ?></p>
                        <p><strong>Duración (min):</strong> <?php echo $pelicula['duracion_minutos']; ?></p>
                        <p><strong>Clasificación:</strong> <?php echo $pelicula['clasificacion']; ?></p>
                        <p><strong>Fecha de Estreno:</strong> <?php echo $pelicula['fecha_estreno']; ?></p>
                        <p><strong>Sinopsis:</strong> <?php echo $pelicula['sinopsis']; ?></p>
                        <a href="index.php?controller=PeliculasController&action=editar&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-primary">Editar</a>
                        <a href="index.php?controller=PeliculasController&action=eliminar&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Botón de Alta fuera del bucle -->
        <div class="mt-4">
            <a href="index.php?controller=PeliculasController&action=alta" class="btn btn-dark">Agregar Película</a>
        </div>
    </div>

</body>
</html>
