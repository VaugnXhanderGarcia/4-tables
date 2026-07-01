<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$min = isset($_GET['min']) ? intval($_GET['min']) : 0;
$max = isset($_GET['max']) ? intval($_GET['max']) : 0;
$rows = [];
if (isset($_GET['min']) && isset($_GET['max'])) {
    $sql = "SELECT * FROM workstation WHERE wsAge BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $min, $max);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }
}

function renderTable(array $rows): void {
    if (empty($rows)) {
        return;
    }
    echo '<table><tr>';
    foreach (array_keys($rows[0]) as $column) {
        echo '<th>' . htmlspecialchars($column) . '</th>';
    }
    echo '</tr>';
    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . htmlspecialchars((string)$value) . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
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

    <?php if (isset($_GET['min']) && isset($_GET['max'])): ?>
        <p><strong>Count:</strong> <?= count($rows); ?></p>
        <?php if (!empty($rows)): ?>
            <?php renderTable($rows); ?>
        <?php else: ?>
            <p>No workstations found in that age range.</p>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <a href="../index.php" class="btn btn-view">Back Home</a>
</div>
</body>
</html>
