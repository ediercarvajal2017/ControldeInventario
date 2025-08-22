<?php
// Mostrar errores para depuración temporal
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Punto de entrada principal
require_once '../config/config.php';

require_once '../app/controllers/MainController.php';

session_start();

// Obtener la ruta solicitada desde el parámetro 'url'
$url = isset($_GET['url']) ? $_GET['url'] : '';

$controller = new MainController();
$controller->handleRequest();
