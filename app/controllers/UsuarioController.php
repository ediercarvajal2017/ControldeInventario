<?php
namespace App\Controllers;

// Controlador para la gestión de usuarios
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Institucion.php';

use App\Models\Usuario;
use App\Models\Institucion;

class UsuarioController {
    public function index() {
        $usuarios = Usuario::all();
        include __DIR__ . '/../views/usuarios/index.php';
    }

    public function create() {
        include __DIR__ . '/../views/usuarios/create.php';
    }

    public function store($data) {
        require_once __DIR__ . '/../../config/config.php';
        if (session_status() === PHP_SESSION_NONE) session_start();
        $error = '';
        // Validación básica
        if (
            empty($data['documento']) ||
            empty($data['nombres']) ||
            empty($data['apellidos']) ||
            empty($data['cargo']) ||
            empty($data['username']) ||
            empty($data['password']) ||
            empty($data['rol']) ||
            !isset($data['activo'])
        ) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            header('Location: ' . BASE_URL . 'usuarios/create');
            exit;
        }

        // Intentar guardar
        $resultado = Usuario::create($data);
        if ($resultado === true) {
            $_SESSION['exito'] = '¡Usuario registrado exitosamente!';
            header('Location: ' . BASE_URL . 'usuarios');
            exit;
        } elseif ($resultado instanceof \PDOException) {
            if (strpos($resultado->getMessage(), 'Duplicate entry') !== false) {
                $_SESSION['error'] = "Ya existe un usuario con el mismo documento o nombre de usuario.";
            } else {
                $_SESSION['error'] = "Ocurrió un error al registrar el usuario: " . $resultado->getMessage();
            }
            header('Location: ' . BASE_URL . 'usuarios/create');
            exit;
        } else {
            $_SESSION['error'] = "Ocurrió un error al registrar el usuario.";
            header('Location: ' . BASE_URL . 'usuarios/create');
            exit;
        }
    }

    public function edit($id) {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            echo "Usuario no encontrado.";
            return;
        }
        include __DIR__ . '/../views/usuarios/edit.php';
    }

    public function update($id, $data) {
        require_once __DIR__ . '/../../config/config.php';
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (
            empty($data['documento']) ||
            empty($data['nombres']) ||
            empty($data['apellidos']) ||
            empty($data['cargo']) ||
            empty($data['username']) ||
            empty($data['rol']) ||
            !isset($data['activo'])
        ) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            header('Location: ' . BASE_URL . 'usuarios/edit?id=' . urlencode($id));
            exit;
        }

        if (Usuario::update($id, $data)) {
            $_SESSION['exito'] = '¡Usuario actualizado exitosamente!';
            header('Location: ' . BASE_URL . 'usuarios');
            exit;
        } else {
            $_SESSION['error'] = "Ocurrió un error al actualizar el usuario.";
            header('Location: ' . BASE_URL . 'usuarios/edit?id=' . urlencode($id));
            exit;
        }
    }

    public function delete($id) {
        require_once __DIR__ . '/../../config/config.php';
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (Usuario::delete($id)) {
            $_SESSION['exito'] = '¡Usuario eliminado exitosamente!';
        } else {
            $_SESSION['error'] = 'Ocurrió un error al eliminar el usuario.';
        }
        header('Location: ' . BASE_URL . 'usuarios');
        exit;
    }
}
