<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Trabajadores disponibles</h1>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre completo</th>
                        <th>Puesto</th>
                        <th>Salario</th>
                        <th>Fecha de Contratación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trabajadores as $trabajador): ?>
                        <tr>
                            <td><?php echo $trabajador['nombre'] . ' ' . $trabajador['apellido']; ?></td>
                            <td><?php echo $trabajador['puesto']; ?></td>
                            <td><?php echo $trabajador['salario']; ?></td>
                            <td><?php echo $trabajador['fecha_contratacion']; ?></td>
                            <td>
                                <a href="index.php?controller=TrabajadoresController&action=editar&id=<?php echo $trabajador['id_empleado']; ?>" class="btn btn-primary">Editar</a>
                                <a href="index.php?controller=TrabajadoresController&action=eliminar&id=<?php echo $trabajador['id_empleado']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <a href="index.php?controller=TrabajadoresController&action=alta" class="btn btn-dark">Agregar Trabajador</a>
        </div>
    </div>
</body>
</html>
