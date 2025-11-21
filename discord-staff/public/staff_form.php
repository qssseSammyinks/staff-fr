<?php
session_start();

require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/csrf.php';

// Check if logged in
$logged = isset($_SESSION['discord_user']);
$discordUser = $logged ? $_SESSION['discord_user'] : null;

// Create CSRF token
$token = generateCsrfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discord Staff Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<header style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;padding:10px;">
    <div>
        <h2 style="margin:0;">Discord Staff Application</h2>
    </div>

    <div>
        <?php if($logged): ?>
            <span style="margin-right:10px;">
                Logged in as <strong><?= htmlspecialchars($discordUser["username"]) ?></strong>
            </span>
            <a href="logout.php"
               style="padding:8px 12px;background:#ff5555;color:white;border-radius:6px;text-decoration:none;">
               Logout
            </a>
        <?php else: ?>
            <a href="index.php"
               style="padding:8px 12px;background:#5865F2;color:white;border-radius:6px;text-decoration:none;">
               Login with Discord
            </a>
        <?php endif; ?>
    </div>
</header>


<!-- BLOCK FORM IF NOT LOGGED -->
<?php if(!$logged): ?>
    <div style="padding:20px;background:#222;border-radius:10px;color:white;">
        <h3>You must login with Discord before applying.</h3>
        <a href="index.php"
           style="padding:10px 14px;background:#5865F2;color:white;border-radius:6px;text-decoration:none;">
           Login with Discord
        </a>
    </div>
    </body></html>
    <?php exit; ?>
<?php endif; ?>


<!-- STAFF FORM -->
<div style="max-width:600px;margin:auto;background:#111;padding:25px;border-radius:10px;color:white;">
    <h3>Submit Your Staff Application</h3>

    <form method="POST" action="submit.php">

        <input type="hidden" name="csrf_token" value="<?= $token ?>">

        <label>Discord Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($discordUser['username']) ?>" required>

        <label>Experience</label>
        <textarea name="experience" required></textarea>

        <label>Why do you want to join staff?</label>
        <textarea name="reason" required></textarea>

        <button type="submit" style="margin-top:10px;background:#00c853;color:white;padding:10px;border:none;border-radius:6px;">
            Apply
        </button>
    </form>
</div>

</body>
</html>
