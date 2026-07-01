<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$spec = isset($_GET['spec']) ? $conn->real_escape_string(trim($_GET['spec'])) : '';
$count = 0;
if ($spec !== '') {
    $res = $conn->query("SELECT COUNT(*) AS total FROM veterinarian WHERE is_deleted = 0 AND vetSpecialization LIKE '%$spec%'");
    $row = $res->fetch_assoc();
    $count = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vets by Specialization</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Vets by Specialization</h1>
    <form method="get">
        <label>Specialization</label>
        <input type="text" name="spec" value="<?= htmlspecialchars($spec); ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>
    <?php if ($spec !== ''): ?>
        <p><strong>Count:</strong> <?= $count; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
