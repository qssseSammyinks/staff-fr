<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define("MONGO_URI", $_ENV["MONGO_URI"]);
define("ADMIN_USER", $_ENV["ADMIN_USER"]);
define("ADMIN_PASS", $_ENV["ADMIN_PASS"]);

// ID DO DONO (ou admin) no Discord
define("ADMIN_DISCORD_ID", $_ENV["ADMIN_DISCORD_ID"]);

// Credenciais do Discord OAuth
define("DISCORD_CLIENT_ID", $_ENV["DISCORD_CLIENT_ID"]);
define("DISCORD_CLIENT_SECRET", $_ENV["DISCORD_CLIENT_SECRET"]);
define("DISCORD_REDIRECT_URI", $_ENV["DISCORD_REDIRECT_URI"]);
