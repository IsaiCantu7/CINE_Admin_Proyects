<?php

// Se requiere el archivo que contiene la clase de conexión
require_once './models/Conexion.php';

// Definición de la clase VentasBoletos
class VentasBoletos {
    // Propiedad para almacenar la conexión a la base de datos
    private $conexion;

    // Constructor de la clase, inicializa la conexión
    public function __construct() {
        $this->conexion = new Conexion(); // Crear una nueva instancia de la clase Conexion para establecer la conexión
    }

    // Método para registrar una nueva venta de boletos en la base de datos
    public function registrarVenta($id_cliente, $id_pelicula, $cantidad_boletos, $total) {
        // Consulta SQL para insertar una nueva venta de boletos con los datos proporcionados
        $query = "INSERT INTO ventas_boletos (id_cliente, id_pelicula, cantidad_boletos, total) 
                  VALUES ('$id_cliente', '$id_pelicula', '$cantidad_boletos', '$total')";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para obtener todas las ventas de boletos de la base de datos
    public function obtenerVentas() {
        // Consulta SQL para seleccionar todas las ventas de boletos junto con los detalles del cliente y la película correspondientes
        $query = "SELECT v.id_venta, c.nombre AS nombre_cliente, p.titulo AS titulo_pelicula, v.cantidad_boletos, v.total, v.fecha_venta
                  FROM ventas_boletos v
                  INNER JOIN clientes c ON v.id_cliente = c.id_cliente
                  INNER JOIN peliculas p ON v.id_pelicula = p.id_pelicula";
        // Ejecutar la consulta en la base de datos y devolver todas las filas del resultado como un array asociativo
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obtener los detalles de una venta de boletos por su ID
    public function obtenerVentaPorId($id_venta) {
        // Consulta SQL para seleccionar una venta de boletos por su ID
        $query = "SELECT * FROM ventas_boletos WHERE id_venta = $id_venta";
        // Ejecutar la consulta en la base de datos y devolver la fila del resultado como un array asociativo
        $resultado = $this->conexion->conectar()->query($query);
        return $resultado->fetch_assoc();
    }

    // Método para eliminar una venta de boletos de la base de datos por su ID
    public function eliminarVenta($id_venta) {
        // Consulta SQL para eliminar una venta de boletos por su ID
        $query = "DELETE FROM ventas_boletos WHERE id_venta = $id_venta";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para obtener el total de ventas realizadas en un día específico
    public function obtenerVentasDiarias() {
        // Obtener la fecha actual en formato 'YYYY-MM-DD'
        $fecha_actual = date('Y-m-d');
        // Consulta SQL para obtener el total de ventas realizadas en la fecha actual
        $query = "SELECT SUM(total) AS total_ventas FROM ventas_boletos WHERE DATE(fecha_venta) = '$fecha_actual'";
        // Ejecutar la consulta en la base de datos
        $resultado = $this->conexion->conectar()->query($query);
        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Devolver la fila del resultado como un array asociativo
            return $resultado->fetch_assoc();
        } else {
            // Si no se obtienen resultados, devolver null o un array vacío según sea necesario
            return null;
        }
    }
    
    // Método para obtener las ventas de boletos dentro de un rango de fechas especificado
    public function obtenerVentasPorRangoFechas($fechaInicio, $fechaFin) {
        // Consulta SQL para obtener las ventas de boletos dentro del rango de fechas especificado
        $query = "SELECT v.id_venta, c.nombre AS nombre_cliente, p.titulo AS titulo_pelicula, v.cantidad_boletos, v.total, v.fecha_venta
                  FROM ventas_boletos v
                  INNER JOIN clientes c ON v.id_cliente = c.id_cliente
                  INNER JOIN peliculas p ON v.id_pelicula = p.id_pelicula
                  WHERE v.fecha_venta >= '$fechaInicio' AND v.fecha_venta < DATE_ADD('$fechaFin', INTERVAL 1 DAY)";
        // Ejecutar la consulta en la base de datos
        $resultado = $this->conexion->conectar()->query($query);
        // Verificar si se obtuvieron resultados
        if ($resultado) {
            // Convertir el resultado en un arreglo asociativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        // Si no se obtienen resultados, retornar un arreglo vacío
        return [];
    } 
    
    // Método para obtener las películas más vendidas en un rango de fechas especificado
    public function obtenerPeliculasMasVendidasEnRango($fechaInicio, $fechaFin) {
        // Consulta SQL para obtener las películas más vendidas en el rango de fechas especificado
        $query = "SELECT p.titulo AS titulo_pelicula, SUM(v.cantidad_boletos) AS cantidad_vendida
                  FROM ventas_boletos v
                  INNER JOIN peliculas p ON v.id_pelicula = p.id_pelicula
                  WHERE v.fecha_venta >= '$fechaInicio' AND v.fecha_venta < DATE_ADD('$fechaFin', INTERVAL 1 DAY)
                  GROUP BY p.titulo
                  ORDER BY SUM(v.cantidad_boletos) DESC
                  LIMIT 5";
        // Ejecutar la consulta en la base de datos
        $resultado = $this->conexion->conectar()->query($query);
        // Verificar si se obtuvieron resultados
        if ($resultado) {
            // Convertir el resultado en un arreglo asociativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        // Si no se obtienen resultados, retornar un arreglo vacío
        return [];
    }    
}

?>
