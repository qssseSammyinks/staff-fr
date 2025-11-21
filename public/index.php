<?php
require_once 'config.php';

if(isset($_POST['submit'])){
    $collection->insertOne([
        'nome' => $_POST['nome'],
        'discord' => $_POST['discord'],
        'idade' => $_POST['idade'],
        'motivo' => $_POST['motivo'],
        'status' => 'pendente',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);
    $msg = "Candidatura enviada!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Discord Staff Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Formulário de Staff</h1>
<?php if(isset($msg)) echo "<p>$msg</p>"; ?>
<form method="POST">
    <input name="nome" placeholder="Nome" required>
    <input name="discord" placeholder="Discord#0000" required>
    <input name="idade" type="number" placeholder="Idade" required>
    <textarea name="motivo" placeholder="Por que deseja ser staff?" required></textarea>
    <button name="submit">Enviar</button>
</form>
</body>
</html>
