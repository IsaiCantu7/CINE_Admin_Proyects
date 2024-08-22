<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ventas de Snacks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Lista de Ventas de Snacks</h1>

        <!-- Formulario para filtrar por rango de fechas -->
        <div class="form-group">
            <form action="index.php?controller=VentasSnackController&action=filtrar" method="GET">
                <input type="hidden" name="controller" value="VentasSnackController">
                <input type="hidden" name="action" value="filtrar">
                <div class="form-row">
                    <div class="col">
                        <label for="fecha_inicio">Fecha de inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="<?php echo $_GET['fecha_inicio'] ?? ''; ?>">
                    </div>
                    <div class="col">
                        <label for="fecha_fin">Fecha de fin:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="<?php echo $_GET['fecha_fin'] ?? ''; ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mt-4">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Botón para regresar a ver todas las ventas -->
        <?php if (isset($ventasFiltradas)): ?>
            <a href="index.php?controller=VentasSnackController&action=index" class="btn btn-secondary mb-3">Ver todas las ventas</a>
        <?php endif; ?>

        <!-- Mostrar lista de ventas -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Cliente</th>
                    <th>Snack</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Fecha de Venta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mostrar las ventas filtradas si las hay, si no, mostrar todas las ventas -->
                <?php if (isset($ventasFiltradas)): ?>
                    <?php foreach ($ventasFiltradas as $venta): ?>
                        <tr>
                            <td><?php echo $venta['id_venta']; ?></td>
                            <td><?php echo $venta['nombre_cliente']; ?></td> <!-- Actualizado para mostrar el nombre del cliente -->
                            <td><?php echo $venta['nombre_snack']; ?></td> <!-- Mantenido para mostrar el nombre del snack -->
                            <td><?php echo $venta['cantidad']; ?></td>
                            <td><?php echo $venta['precio_unitario']; ?></td>
                            <td><?php echo $venta['cantidad'] * $venta['precio_unitario']; ?></td>
                            <td><?php echo $venta['fecha_venta']; ?></td>
                            <td>
                                <a href="index.php?controller=VentasSnackController&action=eliminar&id=<?php echo $venta['id_venta']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?php echo $venta['id_venta']; ?></td>
                            <td><?php echo $venta['nombre_cliente']; ?></td> <!-- Actualizado para mostrar el nombre del cliente -->
                            <td><?php echo $venta['nombre_snack']; ?></td> <!-- Mantenido para mostrar el nombre del snack -->
                            <td><?php echo $venta['cantidad']; ?></td>
                            <td><?php echo $venta['precio_unitario']; ?></td>
                            <td><?php echo $venta['total'] = $venta['cantidad'] * $venta['precio_unitario']; ?></td>
                            <td><?php echo $venta['fecha_venta']; ?></td>
                            <td>
                                <a href="index.php?controller=VentasSnackController&action=eliminar&id=<?php echo $venta['id_venta']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Enlace para agregar nueva venta -->
        <a href="index.php?controller=VentasSnackController&action=alta" class="btn btn-primary">Agregar Venta</a>

        <!-- Mostrar los productos más vendidos en el rango de fechas -->
        <?php if (isset($productosTop)): ?>
            <div class="container mt-4">
                <h2>Productos más vendidos en el rango de fechas</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productosTop as $producto): ?>
                            <tr>
                                <td><?php echo $producto['nombre_snack']; ?></td>
                                <td><?php echo $producto['cantidad']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
