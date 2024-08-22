<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Venta de Boletos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Alta de Venta de Boletos</h1>
        <form action="index.php?controller=VentasBoletosController&action=alta" method="POST">
            <div class="form-group">
                <label for="id_cliente">Cliente:</label>
                <select name="id_cliente" id="id_cliente" class="form-control" required>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_pelicula">Película:</label>
                <select name="id_pelicula" id="id_pelicula" class="form-control" required>
                    <?php foreach ($peliculas as $pelicula): ?>
                        <option value="<?php echo $pelicula['id_pelicula']; ?>"><?php echo htmlspecialchars($pelicula['titulo']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad_boletos">Cantidad de Boletos:</label>
                <input type="number" name="cantidad_boletos" id="cantidad_boletos" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="number" step="0.01" name="total" id="total" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
        </form>
    </div>
</body>
</html>
