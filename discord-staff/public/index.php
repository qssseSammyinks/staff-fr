<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/auth.php';

session_start();

$provider = getDiscordProvider();
$authUrl = $provider->getAuthorizationUrl([
    'scope' => ['identify', 'email', 'guilds']
]);

$_SESSION['oauth2state'] = $provider->getState();

header("Location: $authUrl");
exit;
