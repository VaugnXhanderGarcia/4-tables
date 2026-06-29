<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$min = isset($_GET['min']) ? intval($_GET['min']) : 0;
$max = isset($_GET['max']) ? intval($_GET['max']) : 0;

$res = null;
if (isset($_GET['min']) && isset($_GET['max'])) {
    $sql = "SELECT COUNT(*) as total, wsLabRoom FROM workstation WHERE wsAge BETWEEN ? AND ? GROUP BY wsLabRoom";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $min, $max);
    $stmt->execute();
    $res = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Workstations by Age</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Workstations by Age Range</h1>
    <form method="get">
        <input type="number" name="min" placeholder="Min age" value="<?= htmlspecialchars($min); ?>" min="0">
        <input type="number" name="max" placeholder="Max age" value="<?= htmlspecialchars($max); ?>" min="0">
        <button type="submit" class="btn btn-view">Search</button>
    </form>

    <?php if ($res): ?>
        <table>
            <tr><th>Lab Room</th><th>Count</th></tr>
            <?php while ($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['wsLabRoom']); ?></td>
                <td><?= $row['total']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
    <br>
    <a href="../index.php" class="btn btn-view">Back Home</a>
</div>
</body>
</html>
