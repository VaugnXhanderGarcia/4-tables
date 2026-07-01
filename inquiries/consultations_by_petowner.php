<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$petOwnerID = isset($_GET['petOwnerID']) ? intval($_GET['petOwnerID']) : 0;
$count = 0;
if ($petOwnerID > 0) {
    $res = $conn->query("SELECT COUNT(*) AS total FROM consultation c JOIN pet p ON c.petID = p.petID WHERE c.is_deleted = 0 AND p.petOwnerID = $petOwnerID");
    $row = $res->fetch_assoc(); $count = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consultations by Pet Owner</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Consultations by Pet Owner</h1>
    <form method="get">
        <label>Pet Owner ID</label>
        <input type="number" name="petOwnerID" value="<?= $petOwnerID; ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>
    <?php if ($petOwnerID>0): ?>
        <p><strong>Count:</strong> <?= $count; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
