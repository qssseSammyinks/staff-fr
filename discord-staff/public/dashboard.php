<?php
require_once '../src/auth.php';
require_once '../src/db.php';
requireAdmin();

if(isset($_GET['approve']) || isset($_GET['reject'])){
    $id = new MongoDB\BSON\ObjectId($_GET['approve'] ?? $_GET['reject']);
    $formCollection->updateOne(['_id'=>$id], ['$set'=>['status'=>isset($_GET['approve'])?'Approved':'Rejected']]);
    header('Location: dashboard.php'); exit;
}

$forms = $formCollection->find([], ['sort'=>['created_at'=>-1]]);
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
<h1>Admin Dashboard</h1><a href="logout.php">Logout</a>
<table border="1" cellpadding="5">
<tr><th>Name</th><th>Age</th><th>Discord</th><th>Reason</th><th>Status</th><th>Date</th><th>Actions</th></tr>
<?php foreach($forms as $f): ?>
<tr>
<td><?= $f['name'] ?></td>
<td><?= $f['age'] ?></td>
<td><?= $f['discord_tag'] ?></td>
<td><?= $f['reason'] ?></td>
<td class="<?= strtolower($f['status']) ?>"><?= $f['status'] ?></td>
<td><?= $f['created_at']->toDateTime()->format('Y-m-d H:i') ?></td>
<td>
<?php if($f['status']=='Pending'): ?>
<a href="?approve=<?= $f['_id'] ?>">Approve</a> | <a href="?reject=<?= $f['_id'] ?>">Reject</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
