<?php
// Punto de entrada principal
require_once '../config/config.php';

require_once '../app/controllers/MainController.php';

session_start();

// Obtener la ruta solicitada desde el parámetro 'url'
$url = isset($_GET['url']) ? $_GET['url'] : '';

$controller = new MainController();
$controller->handleRequest();
