<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/auth.php';

session_start();

if (!isset($_GET['code'])) {
    die("No code returned");
}

$token = exchangeCodeForToken($_GET['code']);
$user  = getDiscordUser($token);

$_SESSION['user'] = $user;

// Checar admin
if ($user['id'] === $_ENV['ADMIN_DISCORD_ID']) {
    $_SESSION['is_admin'] = true;
    header("Location: /dashboard.php");
    exit;
}

header("Location: /staff_form.php");
exit;
