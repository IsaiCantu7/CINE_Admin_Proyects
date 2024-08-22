<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Listado de Clientes</h1>

        <div class="row mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente['nombre'] . ' ' . $cliente['apellido']; ?></td>
                            <td><?php echo $cliente['correo']; ?></td>
                            <td><?php echo $cliente['telefono'] ? $cliente['telefono'] : 'N/A'; ?></td>
                            <td><?php echo $cliente['fecha_nacimiento']; ?></td>
                            <td>
                                <a href="index.php?controller=ClientesController&action=editar&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-primary">Editar</a>
                                <a href="index.php?controller=ClientesController&action=eliminar&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="index.php?controller=ClientesController&action=alta" class="btn btn-dark">Agregar Cliente</a>
        </div>
    </div>
</body>
</html>
