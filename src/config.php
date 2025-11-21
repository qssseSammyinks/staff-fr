<?php
require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

session_start();

data_default_timezome_set('America/Sao_Paulo');

define('MONGO_URI', $_ENV['MONGO_URI']);
define('MONGO_DB', $_ENV['MONGO_DB']);
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
