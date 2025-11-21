<?php
require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

session_start();

try {
    $client = new MongoDB\Client($_ENV['MONGO_URI']);
    $db = $client->{$_ENV['MONGO_DB']};
    $collection = $db->{$_ENV['MONGO_COLLECTION']};
} catch (Exception $e) {
    die("Erro ao conectar no MongoDB: ".$e->getMessage());
}
