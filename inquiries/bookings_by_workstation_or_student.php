<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$wsID = isset($_GET['wsID']) ? intval($_GET['wsID']) : 0;
$stuID = isset($_GET['stuID']) ? intval($_GET['stuID']) : 0;
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';
$rows = [];
$searchLabel = '';

if ($wsID > 0) {
    $sql = "SELECT * FROM booking WHERE wsID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $wsID);
    $stmt->execute();
    $res = $stmt->get_result();
    $searchLabel = 'Workstation ID: ' . $wsID;
} elseif ($stuID > 0) {
    $sql = "SELECT * FROM booking WHERE stuID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $stuID);
    $stmt->execute();
    $res = $stmt->get_result();
    $searchLabel = 'Student ID: ' . $stuID;
} elseif ($from !== '' && $to !== '') {
    $sql = "SELECT * FROM booking WHERE bookStart BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $from, $to);
    $stmt->execute();
    $res = $stmt->get_result();
    $searchLabel = 'Date range';
} else {
    $res = null;
}

if ($res) {
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
    <title>Bookings Inquiry</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Bookings Inquiry</h1>
    <form method="get">
        <input type="number" name="wsID" placeholder="Workstation ID" value="<?= htmlspecialchars($wsID); ?>">
        <input type="number" name="stuID" placeholder="Student ID" value="<?= htmlspecialchars($stuID); ?>">
        <label>From</label>
        <input type="datetime-local" name="from" value="<?= htmlspecialchars($from); ?>">
        <label>To</label>
        <input type="datetime-local" name="to" value="<?= htmlspecialchars($to); ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>

    <?php if ($searchLabel !== ''): ?>
        <p><strong>Search:</strong> <?= htmlspecialchars($searchLabel); ?></p>
        <p><strong>Count:</strong> <?= count($rows); ?></p>
        <?php if (!empty($rows)): ?>
            <?php renderTable($rows); ?>
        <?php else: ?>
            <p>No bookings found for this query.</p>
        <?php endif; ?>
    <?php endif; ?>

    <br>
    <a href="../index.php" class="btn btn-view">Back Home</a>
</div>
</body>
</html>
