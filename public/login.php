<?php
require_once '../src/config.php';
require_once '../src/auth.php';
require_once '../src/discord.php';

session_start();

// Logout
if (isset($_GET['logout'])){
    logout();
    header('Location: login.php');
    exit;
}

// Discord OAuth callback
if (isset($_GET['code'])){
    $tokenData = getDiscordAcessToken($_GET['code']);

    if(isset($tokenData['acess_token'])){
        $acessToken = $tokenData['acess_token'];
        $user = getDiscordUser($acessToken);

        // Verified if Role Admin in Discord
        if (isDiscordAdmin($acessToken)){
            $_SESSION['admin_logged'] = true;
            $_SESSION['discord_user'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "You are not autorized";
        }
    } else {
        $error = "Failed to get acess token!";
    }
}

// Fallback admin login
if (isset($_POST['submit'])){
    if(login($_POST['user'], $_POST['pass'])){
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid Crendetials";
    }
}

// URL login OAth
$discordLoginUrl = getDiscordOAuthURl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>

    <?php if(isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <!-- Button Discord Login -->
     <a href="<?= $discordLoginUrl ?>" class="discord-btn">Login with Discord</a>

     <hr>
     <p>Or user fallback Admin login</p>

     <form method="POST">
        <input type="text" name="user" placeholder="User" required>
        <input type="password" name="pass" placeholder="Passowrd" required>
        <button type="submit" name="submit">Login</button>
     </form>
</body>
</html>