<?php
// Cargar variables de entorno

require_once __DIR__ . '/../vendor/autoload.php';
// Cargar .env.local si existe, si no .env
if (file_exists(__DIR__ . '/../.env.local')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.local');
} else {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
}
$dotenv->load();


// Definir BASE_URL robusto para VirtualHost o subcarpeta
if (isset($_SERVER['HTTP_HOST'])) {
    $host = $_SERVER['HTTP_HOST'];
    // Si es VirtualHost controldeinventario.local, BASE_URL es '/'
    if ($host === 'controldeinventario.local') {
        define('BASE_URL', '/');
    } else {
        // Si es subcarpeta, BASE_URL es '/ControldeInventario/'
        $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
        $baseFolder = trim(dirname($scriptName), '/');
        define('BASE_URL', $baseFolder ? '/' . $baseFolder . '/' : '/');
    }
} else {
    define('BASE_URL', '/');
}

$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];

try {
    $pdo = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}