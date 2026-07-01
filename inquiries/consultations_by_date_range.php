<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$from = isset($_GET['from']) ? $conn->real_escape_string($_GET['from']) : '';
$to = isset($_GET['to']) ? $conn->real_escape_string($_GET['to']) : '';
$count = 0;
if ($from !== '' && $to !== '') {
    $res = $conn->query("SELECT COUNT(*) AS total FROM consultation WHERE is_deleted = 0 AND consultDate BETWEEN '$from' AND '$to'");
    $row = $res->fetch_assoc(); $count = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consultations by Date Range</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Consultations by Date Range</h1>
    <form method="get">
        <label>From</label>
        <input type="datetime-local" name="from" value="<?= htmlspecialchars($from); ?>">
        <label>To</label>
        <input type="datetime-local" name="to" value="<?= htmlspecialchars($to); ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>
    <?php if ($from!=='' && $to!==''): ?>
        <p><strong>Count:</strong> <?= $count; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
