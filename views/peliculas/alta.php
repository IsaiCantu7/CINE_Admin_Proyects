<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Película</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-4">
        <h1>Alta de Película</h1>

        <div class="row">
            <div class="col-md-6">
                <form action="index.php?controller=PeliculasController&action=alta" method="POST">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo">
                    </div>
                    <div class="form-group">
                        <label for="director">Director:</label>
                        <input type="text" class="form-control" id="director" name="director">
                    </div>
                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <input type="text" class="form-control" id="genero" name="genero">
                    </div>
                    <div class="form-group">
                        <label for="duracion">Duración (minutos):</label>
                        <input type="number" class="form-control" id="duracion" name="duracion">
                    </div>
                    <div class="form-group">
                        <label for="clasificacion">Clasificación:</label>
                        <input type="text" class="form-control" id="clasificacion" name="clasificacion">
                    </div>
                    <div class="form-group">
                        <label for="sinopsis">Sinopsis:</label>
                        <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_estreno">Fecha de Estreno:</label>
                        <input type="date" class="form-control" id="fecha_estreno" name="fecha_estreno">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Película</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
