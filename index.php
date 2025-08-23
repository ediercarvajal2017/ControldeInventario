<?php
// Puedes descomentar las siguientes líneas si necesitas depuración en desarrollo
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Punto de entrada principal
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/controllers/MainController.php';
session_start();


// Obtener la ruta solicitada directamente (para despliegue en la raíz)
$route = $_SERVER['REQUEST_URI'] ?? '/';
// Eliminar parámetros GET de la ruta
if (($q = strpos($route, '?')) !== false) {
	$route = substr($route, 0, $q);
}

// Para compatibilidad con ?url=...
if (isset($_GET['url']) && $_GET['url'] !== '') {
	$route = '/' . ltrim($_GET['url'], '/');
}

$controller = new MainController();
$controller->handleRequest($route);
