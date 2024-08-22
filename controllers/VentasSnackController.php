<?php

// Importar los modelos necesarios
require_once './models/VentasSnacks.php';
require_once './models/Clientes.php';

// Definir la clase VentasSnackController
class VentasSnackController {
    private $ventasSnacksModel;

    // Constructor para inicializar el modelo de ventas de snacks
    public function __construct() {
        $this->ventasSnacksModel = new VentasSnacks();
    }

    // Método para mostrar el listado de ventas de snacks
    public function index() {
        // Obtener todas las ventas de snacks
        $ventas = $this->ventasSnacksModel->obtenerVentas();
        
        // Incluir la vista de listado de ventas de snacks
        include './views/ventas_snack/index.php';
    }
    
    // Método para manejar la solicitud de alta de una nueva venta de snacks
    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario de alta de venta de snacks
            $id_cliente = $_POST['id_cliente'];
            $nombre_snack = $_POST['nombre_snack'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];
            $fecha_venta = $_POST['fecha_venta'];
            $this->ventasSnacksModel->registrarVenta($id_cliente, $nombre_snack, $cantidad, $precio_unitario, $fecha_venta);
            header("Location: index.php?controller=VentasSnackController&action=index");
            exit();
        } else {
            // Obtener la lista de clientes
            $clientesModel = new Clientes();
            $clientes = $clientesModel->obtenerClientes();

            // Mostrar el formulario de alta de venta de snacks con la lista de clientes
            include './views/ventas_snack/alta.php';
        }
    }

    // Método para manejar la solicitud de eliminación de una venta de snacks
    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id_venta = $_GET['id'];
            $this->ventasSnacksModel->eliminarVenta($id_venta);
            header("Location: index.php?controller=VentasSnackController&action=index");
            exit();
        }
    }

    // Método para filtrar las ventas por un rango de fechas
    public function filtrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])) {
            // Obtener las fechas de inicio y fin del filtro
            $fechaInicio = $_GET['fecha_inicio'];
            $fechaFin = $_GET['fecha_fin'];
            
            // Obtener las ventas filtradas y los productos más vendidos en el rango de fechas especificado
            $ventasFiltradas = $this->ventasSnacksModel->obtenerVentasPorRangoFechas($fechaInicio, $fechaFin);
            $productosTop = $this->ventasSnacksModel->obtenerProductosMasVendidos($fechaInicio, $fechaFin);
            
            // Incluir la vista con las ventas filtradas y los productos más vendidos
            include './views/ventas_snack/index.php';
            exit();
        }
    
        // Incluir la vista de listado de ventas de snacks si no se proporcionaron las fechas
        include './views/ventas_snack/index.php';
    }
}

?>
