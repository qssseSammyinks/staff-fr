<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Carrega .env somente se existir (local)
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

session_start();

// Ajusta timezone
date_default_timezone_set('America/Sao_Paulo');

// Define constantes do Mongo e uploads
define('MONGO_URI', $_ENV['MONGO_URI'] ?? 'mongodb://localhost:27017');
define('MONGO_DB', $_ENV['MONGO_DB'] ?? 'staffdb');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
