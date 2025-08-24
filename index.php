

<?php
// Configuración para producción: ocultar errores al usuario
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Cargar el autoload de Composer si existe
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

// Punto de entrada principal
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/controllers/MainController.php';
session_start();





// Cálculo robusto de la ruta amigable
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$baseFolder = rtrim(dirname($scriptName), '/\\');
$route = $requestUri;
// Eliminar parámetros GET
if (($q = strpos($route, '?')) !== false) {
	$route = substr($route, 0, $q);
}
// Quitar el prefijo de subcarpeta si existe
if ($baseFolder && strpos($route, $baseFolder) === 0) {
	$route = substr($route, strlen($baseFolder));
	if ($route === '' || $route === false) {
		$route = '/';
	}
}
// Compatibilidad con ?url=...
if (isset($_GET['url']) && $_GET['url'] !== '') {
	$route = '/' . ltrim($_GET['url'], '/');
}

$controller = new MainController();
$controller->handleRequest($route);
