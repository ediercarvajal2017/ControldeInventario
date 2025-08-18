<?php
// Configuración de la base de datos y constantes
const DB_HOST = 'localhost';
const DB_NAME = 'controldeinventario';
const DB_USER = 'root';
const DB_PASS = '';

try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}