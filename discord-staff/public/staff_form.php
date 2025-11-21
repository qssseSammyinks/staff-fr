<?php
require_once '../src/auth.php';
$csrf_token = generateCsrfToken();
?>
<!DOCTYPE html>
<html>
<head><title>Staff Form</title><link rel="stylesheet" href="style.css"></head>
<body>
<h1>Discord Staff Application</h1>
<?php if(isset($_GET['success'])) echo "<p class='success'>Form submitted!</p>"; ?>
<form method="POST" action="submit.php">
<input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
<label>Name:</label><input type="text" name="name" required>
<label>Age:</label><input type="number" name="age" required>
<label>Discord Tag:</label><input type="text" name="discord_tag" required>
<label>Why do you want to be staff?</label><textarea name="reason" required></textarea>
<button type="submit">Submit</button>
</form>
</body>
</html>
