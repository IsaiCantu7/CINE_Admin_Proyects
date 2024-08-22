<?php

// Se requiere el archivo que contiene la clase de conexión
require_once './models/Conexion.php';

// Definición de la clase VentasSnacks
class VentasSnacks {
    // Propiedades para almacenar la conexión a la base de datos
    private $conexion;
    private $db;

    // Constructor de la clase, inicializa la conexión a la base de datos
    public function __construct() {
        $this->conexion = new Conexion(); // Crear una nueva instancia de la clase Conexion para establecer la conexión
        $this->db = new PDO('mysql:host=localhost;dbname=cinepolilla', 'root', ''); // Crear una nueva instancia de PDO para interactuar con la base de datos utilizando el controlador MySQL
    }
       
    // Método para registrar una nueva venta de snacks en la base de datos
    public function registrarVenta($id_cliente, $nombre_snack, $cantidad, $precio_unitario, $fecha_venta) {
        // Consulta SQL para insertar una nueva venta de snacks con los datos proporcionados
        $query = "INSERT INTO ventas_snacks (id_cliente, nombre_snack, cantidad, precio_unitario, fecha_venta) 
                  VALUES ('$id_cliente', '$nombre_snack', '$cantidad', '$precio_unitario', '$fecha_venta')";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para obtener todas las ventas de snacks de la base de datos
    public function obtenerVentas() {
        // Consulta SQL para seleccionar todas las ventas de snacks junto con los detalles del cliente correspondiente
        $query = "SELECT vs.id_venta, vs.nombre_snack, c.nombre AS nombre_cliente, vs.precio_unitario, vs.cantidad, vs.fecha_venta 
                  FROM ventas_snacks vs
                  INNER JOIN clientes c ON vs.id_cliente = c.id_cliente";
        // Ejecutar la consulta en la base de datos y devolver todas las filas del resultado como un array asociativo
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obtener los detalles de una venta de snacks por su ID
    public function obtenerVentaPorId($id_venta) {
        // Consulta SQL para seleccionar una venta de snacks por su ID
        $query = "SELECT * FROM ventas_snacks WHERE id_venta = $id_venta";
        // Ejecutar la consulta en la base de datos y devolver la fila del resultado como un array asociativo
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_assoc();
    }

    // Método para eliminar una venta de snacks de la base de datos por su ID
    public function eliminarVenta($id_venta) {
        // Consulta SQL para eliminar una venta de snacks por su ID
        $query = "DELETE FROM ventas_snacks WHERE id_venta = $id_venta";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para obtener las ventas de snacks dentro de un rango de fechas especificado
    public function obtenerVentasPorRangoFechas($fechaInicio, $fechaFin) {
        // Consulta SQL para obtener las ventas de snacks dentro del rango de fechas especificado
        $query = "SELECT vs.id_venta, vs.nombre_snack, c.nombre AS nombre_cliente, vs.precio_unitario, vs.cantidad, vs.fecha_venta 
                  FROM ventas_snacks vs
                  INNER JOIN clientes c ON vs.id_cliente = c.id_cliente
                  WHERE fecha_venta >= '$fechaInicio' AND fecha_venta <= '$fechaFin'";
        // Ejecutar la consulta en la base de datos y devolver todas las filas del resultado como un array asociativo
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    
    // Método para obtener los productos más vendidos en un rango de fechas especificado
    public function obtenerProductosMasVendidos($fechaInicio, $fechaFin) {
        // Consulta SQL para obtener los productos más vendidos en el rango de fechas especificado
        $query = "SELECT nombre_snack, SUM(cantidad) AS cantidad 
                  FROM ventas_snacks 
                  WHERE fecha_venta BETWEEN '$fechaInicio' AND '$fechaFin'
                  GROUP BY nombre_snack 
                  ORDER BY SUM(cantidad) DESC 
                  LIMIT 5";
        // Ejecutar la consulta en la base de datos y devolver todas las filas del resultado como un array asociativo
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}    
     
?>
