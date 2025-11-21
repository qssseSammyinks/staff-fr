<?php
function sendDiscordWebhook($message) {
    if (empty($_ENV['DISCORD_WEBHOOK_URL'])) return;

    $data = ['content' => $message];
    $ch = curl_init($_ENV['DISCORD_WEBHOOK_URL']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, -1);
    curl_setopt($ch, CURLOPT_POSTDIELFS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANFER, true);
    curl_exec($ch);
    curl_close($ch);
}