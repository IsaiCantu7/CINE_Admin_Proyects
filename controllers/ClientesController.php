<?php

// Se requiere el archivo que contiene la clase Clientes
require_once './models/Clientes.php';

// Definición de la clase ClientesController
class ClientesController {
    private $clientesModel;

    // Constructor de la clase, inicializa el modelo de clientes
    public function __construct() {
        $this->clientesModel = new Clientes();
    }

    // Método para mostrar el listado de clientes
    public function index() {
        // Obtener la lista de clientes desde el modelo
        $clientes = $this->clientesModel->obtenerClientes();
        // Incluir la vista de listado de clientes
        include './views/clientes/index.php';
    }

    // Método para manejar la solicitud de alta de un nuevo cliente
    public function alta() {
        // Verificar si la solicitud es de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            // Insertar el nuevo cliente utilizando el modelo
            $this->clientesModel->insertarCliente($nombre, $apellido, $correo, $telefono, $fechaNacimiento);
            // Redirigir al listado de clientes después de la inserción
            header("Location: index.php");
        } else {
            // Si la solicitud no es de tipo POST, mostrar el formulario de alta de cliente
            include './views/clientes/alta.php';
        }
    }

    // Método para manejar la solicitud de edición de un cliente
    public function editar() {
        // Verificar si la solicitud es de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario de edición
            $id = $_POST['id_cliente'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            // Actualizar el cliente utilizando el modelo
            $this->clientesModel->actualizarCliente($id, $nombre, $apellido, $correo, $telefono, $fechaNacimiento);
            // Redirigir al listado de clientes después de la actualización
            header("Location:  index.php?controller=CLientesController&action=index");
        } else {
            // Si la solicitud no es de tipo POST, obtener el ID del cliente de la URL y mostrar el formulario de edición con los datos del cliente
            $id = $_GET['id'];
            $cliente = $this->clientesModel->obtenerClientePorId($id);
            include './views/clientes/editar.php';
        }
    }

    // Método para manejar la solicitud de eliminación de un cliente
    public function eliminar() {
        // Obtener el ID del cliente de la URL
        $id = $_GET['id'];
        // Eliminar el cliente utilizando el modelo
        $this->clientesModel->eliminarCliente($id);
        // Redirigir al listado de clientes después de la eliminación
        header("Location: index.php");
    }
}

?>
