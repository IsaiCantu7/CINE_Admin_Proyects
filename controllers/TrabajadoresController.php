<?php

// Se requiere el archivo que contiene la clase Trabajadores
require_once './models/Trabajadores.php';

// Definición de la clase TrabajadoresController
class TrabajadoresController {
    private $trabajadoresModel;

    // Constructor de la clase, inicializa el modelo de trabajadores
    public function __construct() {
        $this->trabajadoresModel = new Trabajadores();
    }

    // Método para mostrar el listado de trabajadores
    public function index() {
        // Obtener la lista de trabajadores desde el modelo
        $trabajadores = $this->trabajadoresModel->obtenerTrabajadores();
        // Incluir la vista de listado de trabajadores
        include './views/trabajadores/index.php';
    }

    // Método para manejar la solicitud de alta de un nuevo trabajador
    public function alta() {
        // Verificar si la solicitud es de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $puesto = $_POST['puesto'];
            $salario = $_POST['salario'];
            $fechaContratacion = $_POST['fecha_contratacion'];
            // Insertar el nuevo trabajador utilizando el modelo
            $this->trabajadoresModel->insertarTrabajador($nombre, $apellido, $puesto, $salario, $fechaContratacion);
            // Redirigir al listado de trabajadores después de la inserción
            header("Location: index.php");
        } else {
            // Si la solicitud no es de tipo POST, mostrar el formulario de alta de trabajador
            include './views/trabajadores/alta.php';
        }
    }

    // Método para manejar la solicitud de edición de un trabajador
    public function editar() {
        // Verificar si la solicitud es de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario de edición
            $id = $_POST['id_trabajador'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $puesto = $_POST['puesto'];
            $salario = $_POST['salario'];
            $fechaContratacion = $_POST['fecha_contratacion'];
            // Actualizar el trabajador utilizando el modelo
            $this->trabajadoresModel->actualizarTrabajador($id, $nombre, $apellido, $puesto, $salario, $fechaContratacion);
            // Redirigir al listado de trabajadores después de la actualización
            header("Location: index.php");
        } else {
            // Si la solicitud no es de tipo POST, obtener el ID del trabajador de la URL y mostrar el formulario de edición con los datos del trabajador
            $id = $_GET['id'];
            $trabajador = $this->trabajadoresModel->obtenerTrabajadorPorId($id);
            include './views/trabajadores/editar.php';
        }
    }

    // Método para manejar la solicitud de eliminación de un trabajador
    public function eliminar() {
        // Obtener el ID del trabajador de la URL
        $id = $_GET['id'];
        // Eliminar el trabajador utilizando el modelo
        $this->trabajadoresModel->eliminarTrabajador($id);
        // Redirigir al listado de trabajadores después de la eliminación
        header("Location: index.php");
    }
}

?>
