<?php
require_once '../src/config.php';
require_once '../src/form.php';
require_once '../src/discord.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Staff Application</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Discord Staff Application</h1>

<?php if(isset($sucess)) echo "<p>$sucess</p>" ?>

<form action="" method="POST">
    <label>Discord Username</label>
    <input type="text" name="discord" required>

    <label>Experience</label>
    <textarea name="experience" required></textarea>

    <label>Why do you want to join staff?</label>
    <textarea name="reason" required></textarea>

    <button type="submit" name="submit">Aplly</button>
</form>
</body>
</html>