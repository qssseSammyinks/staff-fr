<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $discord = htmlspecialchars($_POST['discord']);
    $experience = htmlspecialchars($_POST['experience']);

    $collection->insertOne([
        'discord' => $discord,
        'experience' => $experience,
        'status' => 'pending',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    $sucess = "Application sent!";
    sendDiscordWebhook("New Forms the $discord");
}