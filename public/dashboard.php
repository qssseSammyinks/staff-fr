<?php
require_once '../src/config.php';
require_once '../src/auth.php';
require_once '../src/discord.php';

if (isStaff()) {
    header('Location: login.php');
    exit;
}

// Approve/Reject via GET
if (isset($_GET['action']) && isset ($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $status = $_GET['action'] === 'approve' ? 'approved' : 'reject';
    $collection->updateOne(['_id' => $id], ['$set' => ['status' => $status]]);
    sendDiscordWebhook ("Forms $status");
    header('Location: dashboard.php');
    exit;
}

$applications = $collection->find([], ['sort' => ['created_at' => -1]]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Admin Dashboard</h1>
<a href="logout.php">Logout</a>
<table>
    <tr>
        <th>Discord</th>
        <th>Experience</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($applications as $app): ?>
    <tr>
        <td><?= $app['discord'] ?></td>
        <td><?= $app['experience'] ?></td>
        <td><?= $app['status']?></td>
        <td>
            <a href="update.php?id=<?= $app['id'] ?>&actio=approve">Approve</a>
            <a href="update.php?id=<?= $app['id'] ?>&actio=reject">Reject</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>