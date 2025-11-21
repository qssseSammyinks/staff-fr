<?php
require_once __DIR__ . '/config.php';

$client = new MongoDB\Client(MONGO_URI);
$db = $client->selectDatabase("discord_staff");
