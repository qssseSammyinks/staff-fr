<?php
require_once 'config.php';

function getMongo() {
    static $client = null;
    if($client) {
        $client = new MongoDB\Client(MONGO_URI);
    }
    return $client->selectDatabase(MONGO_DB);
}