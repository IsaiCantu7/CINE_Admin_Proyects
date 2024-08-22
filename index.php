<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Cinepolilla</a>
    </nav>

    <div class="container mt-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo((isset($_GET['controller']) && $_GET['controller'] == 'PeliculasController' || !isset($_GET['controller']))? 'active' : '') ?>" href="./index.php?controller=PeliculasController&action=index" style="color: black;">Peliculas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'ClientesController' ? 'active' : '') ?>" href="./index.php?controller=ClientesController&action=index" style="color: black;">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'TrabajadoresController' ? 'active' : '') ?>" href="./index.php?controller=TrabajadoresController&action=index" style="color: black;">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'VentasBoletosController' ? 'active' : '') ?>" href="./index.php?controller=VentasBoletosController&action=index" style="color: black;">Ventas de boletos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo(isset($_GET['controller']) && $_GET['controller'] == 'VentasSnackController' ? 'active' : '') ?>" href="./index.php?controller=VentasSnackController&action=index" style="color: black;">Ventas de snack</a>
            </li>
        </ul>

        <?php
            if (isset($_GET['controller']) && isset($_GET['action'])) {
                $controller = $_GET['controller'];
                $action = $_GET['action'];

                require_once "controllers/$controller.php";
                
                $controller = new $controller();

                $controller->$action();
            } else {
                require_once "controllers/PeliculasController.php";
                
                $peliculasController = new PeliculasController();

                $peliculasController->index();
            }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
