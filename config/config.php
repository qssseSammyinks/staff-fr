<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;
use Dotenv\Dotenv;

session_start();

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $mongoUri = $_ENV['MONGO_URI'];
    $mongoDbName = $_ENV['MONGO_DB'];

    $client = new Client($mongoUri);
    $db = $client->{$mongoDbName};
    $collection = $db->applications;
} catch (Exception $e) {
    die("Erro ao conectar no MongoDB: " . $e->getMessage());
}

// Admin
define('ADMIN_USER', $_ENV['ADMIN_USER']);
define('ADMIN_PASS', $_ENV['ADMIN_PASS']);
