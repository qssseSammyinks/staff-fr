<?php
require_once '../src/db.php';
require_once '../src/auth.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!verifyCsrfToken($_POST['csrf_token'] ?? '')) exit('Invalid CSRF');

    $data = [
        'name' => htmlspecialchars($_POST['name']),
        'age' => intval($_POST['age']),
        'discord_tag' => htmlspecialchars($_POST['discord_tag']),
        'reason' => htmlspecialchars($_POST['reason']),
        'status' => 'Pending',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];

    $formCollection->insertOne($data);
    header('Location: staff_form.php?success=1');
}
