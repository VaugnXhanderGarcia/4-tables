<?php
require_once 'config/auth.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (attemptLogin($username, $password)) {
        header('Location: /Garcia/index.php');
        exit;
    }

    $message = 'Invalid username or password.';
}

if (isLoggedIn()) {
    header('Location: /Garcia/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container" style="max-width: 420px; margin-top: 60px;">
    <h1>Admin Login</h1>
    <p>Sign in to access the dashboard.</p>
    <?php if ($message !== ''): ?>
        <p style="color: #dc3545; font-weight: bold;"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn btn-add">Login</button>
    </form>
    <p style="margin-top: 15px;">Default login: <strong>localadmin</strong> / <strong>Admin123!</strong></p>
</div>
</body>
</html>
