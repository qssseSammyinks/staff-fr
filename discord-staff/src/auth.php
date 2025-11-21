<?php
require __DIR__ . '/../vendor/autoload.php';

use Wohali\OAuth2\Client\Provider\Discord;

function getDiscordProvider() {
    return new Discord([
        'clientId'     => $_ENV['DISCORD_CLIENT_ID'],
        'clientSecret' => $_ENV['DISCORD_CLIENT_SECRET'],
        'redirectUri'  => $_ENV['DISCORD_REDIRECT_URI'],
    ]);
}

function exchangeCodeForToken($code) {
    $provider = getDiscordProvider();
    return $provider->getAccessToken('authorization_code', [
        'code' => $code
    ]);
}

function getDiscordUser($token) {
    $provider = getDiscordProvider();
    return $provider->getResourceOwner($token)->toArray();
}
