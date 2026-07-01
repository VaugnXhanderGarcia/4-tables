<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$petID = isset($_GET['petID']) ? intval($_GET['petID']) : 0;
$count = 0;
if ($petID > 0) {
    $res = $conn->query("SELECT COUNT(*) AS total FROM consultation WHERE is_deleted = 0 AND petID = $petID");
    $row = $res->fetch_assoc(); $count = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consultations by Pet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Consultations by Pet</h1>
    <form method="get">
        <label>Pet ID</label>
        <input type="number" name="petID" value="<?= $petID; ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>
    <?php if ($petID>0): ?>
        <p><strong>Count:</strong> <?= $count; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
