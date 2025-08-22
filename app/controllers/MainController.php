<?php
class MainController {
    public function handleRequest() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Rutas de autenticación
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = parse_url($uri, PHP_URL_PATH);
        $base = '/ControldeInventario/public';
        $route = $path;
        if (strpos($path, $base) === 0) {
            $route = substr($path, strlen($base));
            if ($route === '') { $route = '/'; }
        }
        // Si la ruta aún comienza con /public, eliminarlo también
        if (strpos($route, '/public') === 0) {
            $route = substr($route, 7); // elimina '/public'
            if ($route === '') { $route = '/'; }
        }
        // Normaliza barras duplicadas al inicio y barras finales: /foo y /foo/ serán iguales
        $route = preg_replace('#^/+#', '/', $route); // Solo una barra al inicio
        if ($route !== '/') {
            $route = rtrim($route, '/');
        }

        // Rutas públicas: login y logout
        if ($route === '/login' && $method === 'GET') {
            require_once __DIR__ . '/AuthController.php';
            $controller = new \App\Controllers\AuthController();
            $controller->showLogin();
            return;
        }
        if ($route === '/login' && $method === 'POST') {
            require_once __DIR__ . '/AuthController.php';
            $controller = new \App\Controllers\AuthController();
            $controller->login();
            return;
        }
        if ($route === '/logout' && $method === 'GET') {
            require_once __DIR__ . '/AuthController.php';
            $controller = new \App\Controllers\AuthController();
            $controller->logout();
            return;
        }

        // Proteger todas las rutas excepto login/logout
        $rutasPublicas = ['/login', '/logout'];
        if (!isset($_SESSION['usuario']) && !in_array($route, $rutasPublicas)) {
            header('Location: /ControldeInventario/public/login');
            exit;
        }

        // Normaliza la ruta (sin query string) y quita el prefijo base
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = parse_url($uri, PHP_URL_PATH);
        $base = '/ControldeInventario/public';
        $route = $path;
        if (strpos($path, $base) === 0) {
            $route = substr($path, strlen($base));
            if ($route === '') { $route = '/'; }
        }
        // Si la ruta aún comienza con /public, eliminarlo también
        if (strpos($route, '/public') === 0) {
            $route = substr($route, 7); // elimina '/public'
            if ($route === '') { $route = '/'; }
        }
        // Normaliza barras duplicadas al inicio y barras finales: /foo y /foo/ serán iguales
        $route = preg_replace('#^/+#', '/', $route); // Solo una barra al inicio
        if ($route !== '/') {
            $route = rtrim($route, '/');
        }
    // ...

        // Instituciones
        if (strpos($route, '/instituciones') === 0) {
            require_once __DIR__ . '/InstitucionController.php';
            $controller = new \App\Controllers\InstitucionController();
            // Permitir rutas con o sin barra final
            $routeSinBarra = rtrim($route, '/');
            if (($route === '/instituciones' || $route === '/instituciones/') && $method === 'GET') {
                $controller->index();
            } elseif (($route === '/instituciones/create' || $route === '/instituciones/create/') && $method === 'GET') {
                $controller->create();
            } elseif (($route === '/instituciones/store' || $route === '/instituciones/store/') && $method === 'POST') {
                $controller->store();
            } elseif ((strpos($routeSinBarra, '/instituciones/edit') === 0) && $method === 'GET') {
                $controller->edit();
            } elseif ((strpos($routeSinBarra, '/instituciones/update') === 0) && $method === 'POST') {
                $controller->update();
            } elseif ((strpos($routeSinBarra, '/instituciones/delete') === 0) && $method === 'GET') {
                $controller->delete();
            } elseif (strpos($route, '/instituciones') === 0 && $method === 'GET') {
                // Cualquier otra variante de /instituciones (GET) muestra el listado
                $controller->index();
            } else {
                http_response_code(404); echo 'Ruta de instituciones no encontrada.';
            }
            return;
        }
 

        // Espacios
        if (strpos($route, '/espacios') === 0) {
            require_once __DIR__ . '/EspacioController.php';
            $controller = new \App\Controllers\EspacioController();

            if ($route === '/espacios' && $method === 'GET') {
                $controller->index();
                return;
            }
            if ($route === '/espacios/create' && $method === 'GET') {
                $controller->create();
                return;
            }
            if ($route === '/espacios/store' && $method === 'POST') {
                $controller->store();
                return;
            } elseif (strpos($route, '/espacios/edit') === 0 && $method === 'GET') {
                $controller->edit($_GET['id']);
            } elseif (strpos($route, '/espacios/update') === 0 && $method === 'POST') {
                $controller->update($_GET['id']);
            } elseif (strpos($route, '/espacios/delete') === 0 && $method === 'GET') {
                $controller->delete($_GET['id']);
            } else {
                http_response_code(404); echo 'Ruta de espacios no encontrada.';
            }
            return;
        }

        // Elementos
        if (strpos($route, '/elementos') === 0) {
            require_once __DIR__ . '/ElementoController.php';
            $controller = new \App\Controllers\ElementoController();
            if ($route === '/elementos' && $method === 'GET') {
                $controller->index();
            } elseif ($route === '/elementos/create' && $method === 'GET') {
                $controller->create();
            } elseif ($route === '/elementos/store' && $method === 'POST') {
                $controller->store($_POST);
            } elseif ($route === '/elementos/edit' && $method === 'GET') {
                $controller->edit($_GET['id']);
            } elseif ($route === '/elementos/update' && $method === 'POST') {
                $controller->update($_GET['id'], $_POST);
            } elseif ($route === '/elementos/delete' && $method === 'GET') {
                $controller->delete($_GET['id']);
            } else {
                http_response_code(404); echo 'Ruta de elementos no encontrada.';
            }
            return;
        }

        // Asignaciones
        if (strpos($route, '/asignaciones') === 0) {
            require_once __DIR__ . '/AsignacionController.php';
            $controller = new \App\Controllers\AsignacionController();
            if (($route === '/asignaciones' || $route === '/asignaciones/index') && $method === 'GET') {
                $controller->index();
            } elseif ($route === '/asignaciones/create' && $method === 'GET') {
                $controller->create();
            } elseif (($route === '/asignaciones/store' || $route === '/asignaciones/store/') && $method === 'POST') {
                $controller->store();
            } elseif ($route === '/asignaciones/edit' && $method === 'GET') {
                $controller->edit($_GET['id']);
            } elseif ($route === '/asignaciones/update' && $method === 'POST') {
                $controller->update($_GET['id'], $_POST);
            } elseif ($route === '/asignaciones/delete' && $method === 'GET') {
                $controller->delete($_GET['id']);
            } else {
                http_response_code(404); echo 'Ruta de asignaciones no encontrada.';
            }
            return;
        }

        // Movimientos
        if (strpos($route, '/movimientos') === 0) {
            require_once __DIR__ . '/MovimientoController.php';
            $controller = new \App\Controllers\MovimientoController();

            if ($route === '/movimientos' && $method === 'GET') {
                $controller->index(); return;
            } elseif ($route === '/movimientos/create' && $method === 'GET') {
                $controller->create(); return;
            } elseif ($route === '/movimientos/store' && $method === 'POST') {
                $controller->store(); return;
            } elseif ($method === 'GET' && ( $route === '/movimientos/edit' || preg_match('#^/movimientos/edit/(\d+)$#', $route, $m) )) {
                $id = $_GET['id'] ?? ($m[1] ?? null);
                if ($id) { $controller->edit($id); return; }
            } elseif ($method === 'POST' && ( $route === '/movimientos/update' || preg_match('#^/movimientos/update/(\d+)$#', $route, $m) )) {
                $id = $_POST['id'] ?? ($m[1] ?? null);
                if ($id) { $controller->update($id); return; }
            } elseif ($method === 'GET' && ( $route === '/movimientos/delete' || preg_match('#^/movimientos/delete/(\d+)$#', $route, $m) )) {
                $id = $_GET['id'] ?? ($m[1] ?? null);
                if ($id) { $controller->delete($id); return; }
            }

            http_response_code(404);
            echo 'Ruta de movimientos no encontrada.';
            return;
        }

        // Usuarios
        if (strpos($route, '/usuarios') === 0) {
            require_once __DIR__ . '/UsuarioController.php';
            $controller = new \App\Controllers\UsuarioController();
            $routeSinBarra = rtrim($route, '/');

            if (($route === '/usuarios' || $route === '/usuarios/') && $method === 'GET') {
                $controller->index();
                return;
            }
            if (($route === '/usuarios/create' || $route === '/usuarios/create/') && $method === 'GET') {
                $controller->create();
                return;
            }
            if (($route === '/usuarios/store' || $route === '/usuarios/store/') && $method === 'POST') {
                $controller->store($_POST);
                return;
            }
            if ((($route === '/usuarios/edit' || $route === '/usuarios/edit/') && $method === 'GET' && isset($_GET['id'])) || (strpos($routeSinBarra, '/usuarios/edit') === 0 && $method === 'GET')) {
                $controller->edit($_GET['id'] ?? null);
                return;
            }
            if ((($route === '/usuarios/update' || $route === '/usuarios/update/') && $method === 'POST' && isset($_POST['id'])) || (strpos($routeSinBarra, '/usuarios/update') === 0 && $method === 'POST')) {
                $controller->update($_POST['id'] ?? null, $_POST);
                return;
            }
            if ((($route === '/usuarios/delete' || $route === '/usuarios/delete/') && $method === 'GET' && isset($_GET['id'])) || (strpos($routeSinBarra, '/usuarios/delete') === 0 && $method === 'GET')) {
                $controller->delete($_GET['id'] ?? null);
                return;
            }
            // Cualquier otra variante de /usuarios (GET) muestra el listado
            if (strpos($route, '/usuarios') === 0 && $method === 'GET') {
                $controller->index();
                return;
            }
            // Si ninguna ruta coincide
            echo "Ruta de usuarios no encontrada.";
            return;
        }

        // Página de inicio
        include __DIR__ . '/../views/layout.php';
    }
}
