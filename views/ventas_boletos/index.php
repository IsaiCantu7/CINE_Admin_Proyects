<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ventas de Boletos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Lista de Ventas de Boletos</h1>

    <!-- Formulario para filtrar por rango de fechas -->
    <div class="form-group">
        <form action="index.php" method="GET">
            <input type="hidden" name="controller" value="VentasBoletosController">
            <input type="hidden" name="action" value="filtrar">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : ''; ?>" placeholder="dd/mm/aaaa">
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : ''; ?>" placeholder="dd/mm/aaaa">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>

    <!-- Botón para regresar a ver todas las ventas -->
    <?php if (isset($filtrado) && $filtrado): ?>
        <a href="index.php?controller=VentasBoletosController&action=index" class="btn btn-secondary mb-3">Ver todas las ventas</a>
    <?php endif; ?>

    <!-- Tabla para mostrar las ventas (filtradas o todas las ventas) -->
    <div class="lista-ventas">
        <table class="table">
            <thead>
                <th>ID Venta</th>
                <th>Cliente</th>
                <th>Película</th>
                <th>Cantidad de Boletos</th>
                <th>Total</th>
                <th>Fecha de Venta</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php if (isset($filtrado) && $filtrado && isset($ventasFiltradas) && is_array($ventasFiltradas)): ?>
                    <?php foreach ($ventasFiltradas as $venta): ?>
                        <tr>
                            <td><?php echo $venta['id_venta']; ?></td>
                            <td><?php echo $venta['nombre_cliente']; ?></td>
                            <td><?php echo $venta['titulo_pelicula']; ?></td>
                            <td><?php echo $venta['cantidad_boletos']; ?></td>
                            <td><?php echo $venta['total']; ?></td>
                            <td><?php echo $venta['fecha_venta']; ?></td>
                            <td>
                                <a href="index.php?controller=VentasBoletosController&action=eliminar&id=<?php echo $venta['id_venta']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif(isset($ventas) && is_array($ventas)): ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?php echo $venta['id_venta']; ?></td>
                            <td><?php echo $venta['nombre_cliente']; ?></td>
                            <td><?php echo $venta['titulo_pelicula']; ?></td>
                            <td><?php echo $venta['cantidad_boletos']; ?></td>
                            <td><?php echo $venta['total']; ?></td>
                            <td><?php echo $venta['fecha_venta']; ?></td>
                            <td>
                                <a href="index.php?controller=VentasBoletosController&action=eliminar&id=<?php echo $venta['id_venta']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay ventas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Tabla para mostrar las películas más vendidas en el rango de fechas -->
    <?php if (isset($peliculasMasVendidas) && !empty($peliculasMasVendidas)): ?>
        <div class="peliculas-mas-vendidas">
            <h2>Películas Más Vendidas en el Rango de Fechas</h2>
            <table class="table">
                <thead>
                    <th>Película</th>
                    <th>Cantidad Vendida</th>
                </thead>
                <tbody>
                    <?php foreach ($peliculasMasVendidas as $pelicula): ?>
                        <tr>
                            <td><?php echo $pelicula['titulo_pelicula']; ?></td>
                            <td><?php echo $pelicula['cantidad_vendida']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Enlace para agregar nueva venta -->
    <a href="index.php?controller=VentasBoletosController&action=alta" class="btn btn-primary">Agregar Venta</a>
</div>
</body>
</html>
