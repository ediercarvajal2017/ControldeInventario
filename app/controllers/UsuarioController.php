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
            $error = "Todos los campos son obligatorios.";
            include __DIR__ . '/../views/usuarios/create.php';
            return;
        }

        // Intentar guardar
        $resultado = Usuario::create($data);
        if ($resultado === true) {
            session_start();
            $_SESSION['exito'] = '¡Usuario registrado exitosamente!';
            header('Location: /ControldeInventario/public/usuarios');
            exit;
        } elseif ($resultado instanceof \PDOException) {
            if (strpos($resultado->getMessage(), 'Duplicate entry') !== false) {
                $error = "Ya existe un usuario con el mismo documento o nombre de usuario.";
            } else {
                $error = "Ocurrió un error al registrar el usuario: " . $resultado->getMessage();
            }
            include __DIR__ . '/../views/usuarios/create.php';
        } else {
            $error = "Ocurrió un error al registrar el usuario.";
            include __DIR__ . '/../views/usuarios/create.php';
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
        $error = '';
        if (
            empty($data['documento']) ||
            empty($data['nombres']) ||
            empty($data['apellidos']) ||
            empty($data['cargo']) ||
            empty($data['username']) ||
            empty($data['rol']) ||
            !isset($data['activo'])
        ) {
            $usuario = Usuario::find($id);
            $error = "Todos los campos son obligatorios.";
            include __DIR__ . '/../views/usuarios/edit.php';
            return;
        }

        if (Usuario::update($id, $data)) {
            session_start();
            $_SESSION['exito'] = '¡Usuario actualizado exitosamente!';
            header('Location: /ControldeInventario/public/usuarios');
            exit;
        } else {
            $usuario = Usuario::find($id);
            $error = "Ocurrió un error al actualizar el usuario.";
            include __DIR__ . '/../views/usuarios/edit.php';
        }
    }

    public function delete($id) {
        if (Usuario::delete($id)) {
            session_start();
            $_SESSION['exito'] = '¡Usuario eliminado exitosamente!';
        }
        header('Location: /ControldeInventario/public/usuarios');
        exit;
    }
}
