<?php
namespace App\Controllers;

class MainController {
    public function handleRequest() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Elementos
        if (strpos($uri, '/elementos') === 0) {
            require_once __DIR__ . '/ElementoController.php';
            $controller = new ElementoController();
            if ($uri === '/elementos' && $method === 'GET') {
                $controller->index();
            } elseif ($uri === '/elementos/create' && $method === 'GET') {
                $controller->create();
            } elseif ($uri === '/elementos/store' && $method === 'POST') {
                $controller->store($_POST);
            } elseif ($uri === '/elementos/edit' && $method === 'GET') {
                $controller->edit($_GET['id']);
            } elseif ($uri === '/elementos/update' && $method === 'POST') {
                $controller->update($_GET['id'], $_POST);
            } elseif ($uri === '/elementos/delete' && $method === 'GET') {
                $controller->delete($_GET['id']);
            } else {
                http_response_code(404); echo 'Ruta de elementos no encontrada.';
            }
            return;
        }

        // Asignaciones
        if (strpos($uri, '/asignaciones') === 0) {
            require_once __DIR__ . '/AsignacionController.php';
            $controller = new AsignacionController();
            if ($uri === '/asignaciones' && $method === 'GET') {
                $controller->index();
            } elseif ($uri === '/asignaciones/create' && $method === 'GET') {
                $controller->create();
            } elseif ($uri === '/asignaciones/store' && $method === 'POST') {
                $controller->store($_POST);
            } elseif ($uri === '/asignaciones/edit' && $method === 'GET') {
                $controller->edit($_GET['id']);
            } elseif ($uri === '/asignaciones/update' && $method === 'POST') {
                $controller->update($_GET['id'], $_POST);
            } elseif ($uri === '/asignaciones/delete' && $method === 'GET') {
                $controller->delete($_GET['id']);
            } else {
                http_response_code(404); echo 'Ruta de asignaciones no encontrada.';
            }
            return;
        }

        // Movimientos
        if (strpos($uri, '/movimientos') === 0) {
            require_once __DIR__ . '/MovimientoController.php';
            $controller = new MovimientoController();
            if ($uri === '/movimientos' && $method === 'GET') {
                $controller->index();
            } elseif ($uri === '/movimientos/create' && $method === 'GET') {
                $controller->create();
            } elseif ($uri === '/movimientos/store' && $method === 'POST') {
                $controller->store($_POST);
            } elseif ($uri === '/movimientos/edit' && $method === 'GET') {
                $controller->edit($_GET['id']);
            } elseif ($uri === '/movimientos/update' && $method === 'POST') {
                $controller->update($_GET['id'], $_POST);
            } elseif ($uri === '/movimientos/delete' && $method === 'GET') {
                $controller->delete($_GET['id']);
            } else {
                http_response_code(404); echo 'Ruta de movimientos no encontrada.';
            }
            return;
        }

        // Usuarios
        if (strpos($uri, '/usuarios') === 0) {
            require_once __DIR__ . '/UsuarioController.php';
            $controller = new UsuarioController();
            if ($uri === '/usuarios' && $method === 'GET') {
                $controller->index();
            } elseif ($uri === '/usuarios/create' && $method === 'GET') {
                $controller->create();
            } elseif ($uri === '/usuarios/store' && $method === 'POST') {
                $controller->store($_POST);
            } elseif ($uri === '/usuarios/edit' && $method === 'GET') {
                $controller->edit($_GET['id']);
            } elseif ($uri === '/usuarios/update' && $method === 'POST') {
                $controller->update($_GET['id'], $_POST);
            } elseif ($uri === '/usuarios/delete' && $method === 'GET') {
                $controller->delete($_GET['id']);
            } else {
                http_response_code(404); echo 'Ruta de usuarios no encontrada.';
            }
            return;
        }

        // Página de inicio
        include __DIR__ . '/../views/layout.php';
    }
}
