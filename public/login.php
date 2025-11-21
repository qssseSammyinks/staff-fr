<?php
require_once 'config.php';

if(isset($_POST['login'])){
    if($_POST['username'] === ADMIN_USER && $_POST['password'] === ADMIN_PASS){
        $_SESSION['admin_logged'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Login Admin</h1>
<?php if(isset($msg)) echo "<p>$msg</p>"; ?>
<form method="POST">
    <input name="username" placeholder="Usuário" required>
    <input name="password" type="password" placeholder="Senha" required>
    <button name="login">Entrar</button>
</form>
</body>
</html>
