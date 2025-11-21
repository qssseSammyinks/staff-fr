<?php
require_once 'config.php';
if(!isset($_SESSION['admin_logged'])){
    header("Location: login.php");
    exit;
}

// Aprovar candidato
if(isset($_GET['approve'])){
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($_GET['approve'])],
        ['$set' => ['status'=>'aprovado']]
    );
    header("Location: dashboard.php");
    exit;
}

// Buscar candidaturas
$applications = $collection->find([], ['sort'=>['created_at'=>-1]]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Dashboard Admin</h1>
<a href="logout.php">Logout</a>
<table border="1">
<tr>
    <th>Nome</th><th>Discord</th><th>Idade</th><th>Motivo</th><th>Status</th><th>Ações</th>
</tr>
<?php foreach($applications as $a): ?>
<tr>
    <td><?= htmlspecialchars($a['nome']) ?></td>
    <td><?= htmlspecialchars($a['discord']) ?></td>
    <td><?= htmlspecialchars($a['idade']) ?></td>
    <td><?= htmlspecialchars($a['motivo']) ?></td>
    <td><?= htmlspecialchars($a['status']) ?></td>
    <td>
        <?php if($a['status']=='pendente'): ?>
        <a href="?approve=<?= $a['_id'] ?>">Aprovar</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
