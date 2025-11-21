<?php
require_once 'config.php';
require_once 'discord.php'; // caso você tenha a função sendDiscordWebhook()

use MongoDB\Client;

if (isset($_POST['submit'])) {

    // Conecta no MongoDB
    $client = new Client(MONGO_URI);
    $db = $client->{MONGO_DB};
    
    // Seleciona a collection correta
    $collection = $db->staff_forms; // troque 'staff_forms' pelo nome da sua collection

    // Sanitiza inputs
    $discord = htmlspecialchars($_POST['discord']);
    $experience = htmlspecialchars($_POST['experience']);

    // Insere documento
    $collection->insertOne([
        'discord' => $discord,
        'experience' => $experience,
        'status' => 'pending',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    $success = "Application sent!";
    sendDiscordWebhook("New form submitted by $discord");
}
