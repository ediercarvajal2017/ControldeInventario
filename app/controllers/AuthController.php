<?php
namespace App\Controllers;
require_once __DIR__ . '/../models/Usuario.php';
use App\Models\Usuario;

class AuthController {
    public function showLogin() {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if (empty($username) || empty($password)) {
                $error = 'Usuario y contraseña son obligatorios.';
            } else {
                $user = Usuario::findByUsername($username);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['usuario'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'rol' => $user['rol'],
                        'nombres' => $user['nombres'] ?? ''
                    ];
                    header('Location: /ControldeInventario/');
                    exit;
                } else {
                    $error = 'Credenciales incorrectas.';
                }
            }
        }
        include __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    session_destroy();
    header('Location: /ControldeInventario/login');
    exit;
    }
}
