<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$vetID = isset($_GET['vetID']) ? intval($_GET['vetID']) : 0;
$count = 0;
if ($vetID > 0) {
    $res = $conn->query("SELECT COUNT(*) AS total FROM consultation WHERE is_deleted = 0 AND vetID = $vetID");
    $row = $res->fetch_assoc(); $count = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consultations by Vet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Consultations by Vet</h1>
    <form method="get">
        <label>Vet ID</label>
        <input type="number" name="vetID" value="<?= $vetID; ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>
    <?php if ($vetID>0): ?>
        <p><strong>Count:</strong> <?= $count; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
