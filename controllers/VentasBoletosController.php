<?php

// Importar los modelos necesarios
require_once './models/VentasBoletos.php';
require_once './models/Clientes.php';
require_once './models/Peliculas.php';

// Definir la clase VentasBoletosController
class VentasBoletosController {
    private $ventasBoletosModel;

    // Constructor para inicializar el modelo de ventas de boletos
    public function __construct() {
        $this->ventasBoletosModel = new VentasBoletos();
    }

    // Método para mostrar el listado de ventas de boletos
    public function index() {
        // Obtener ventas diarias y todas las ventas de boletos
        $ventasDiarias = $this->ventasBoletosModel->obtenerVentasDiarias();
        $ventas = $this->ventasBoletosModel->obtenerVentas();
        
        // Incluir la vista de listado de ventas de boletos
        include './views/ventas_boletos/index.php';
    }
    
    // Método para manejar la solicitud de alta de una nueva venta de boletos
    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario de alta de venta de boletos
            $id_cliente = $_POST['id_cliente'];
            $id_pelicula = $_POST['id_pelicula'];
            $cantidad_boletos = $_POST['cantidad_boletos'];
            $total = $_POST['total'];
            $this->ventasBoletosModel->registrarVenta($id_cliente, $id_pelicula, $cantidad_boletos, $total);
            header("Location: index.php?controller=VentasBoletosController&action=index");
            exit();
        } else {
            // Obtener la lista de clientes y películas
            $clientesModel = new Clientes();
            $clientes = $clientesModel->obtenerClientes();

            $peliculasModel = new Peliculas();
            $peliculas = $peliculasModel->obtenerPeliculas();

            // Mostrar el formulario de alta de venta de boletos con la lista de clientes y películas
            include './views/ventas_boletos/alta.php';
        }
    }

    // Método para manejar la solicitud de eliminación de una venta de boletos
    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id_venta = $_GET['id'];
            $this->ventasBoletosModel->eliminarVenta($id_venta);
            header("Location: index.php?controller=VentasBoletosController&action=index");
            exit();
        }
    }

    // Método para obtener y mostrar las ventas diarias
    public function obtenerVentasDiarias() {
        $ventasDiarias = $this->ventasBoletosModel->obtenerVentasDiarias();
        include './views/ventas_boletos/ventas_diarias.php';
    }

    // Método para filtrar las ventas por un rango de fechas
    public function filtrar() {
        // Obtener las fechas de inicio y fin del filtro
        $fechaInicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
        $fechaFin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;
        
        // Verificar si se proporcionaron ambas fechas
        if ($fechaInicio && $fechaFin) {
            // Obtener ventas y películas más vendidas en el rango de fechas especificado
            $ventasFiltradas = $this->ventasBoletosModel->obtenerVentasPorRangoFechas($fechaInicio, $fechaFin);
            $peliculasMasVendidas = $this->ventasBoletosModel->obtenerPeliculasMasVendidasEnRango($fechaInicio, $fechaFin);
            
            // Incluir la vista con las ventas filtradas y las películas más vendidas
            include './views/ventas_boletos/index.php';
        } else {
            // Redirigir si no se proporcionaron ambas fechas
            header("Location: index.php?controller=VentasBoletosController&action=index");
            exit();
        }
    }
}

?>
