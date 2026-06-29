<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$wsID = isset($_GET['wsID']) ? intval($_GET['wsID']) : 0;
$stuID = isset($_GET['stuID']) ? intval($_GET['stuID']) : 0;
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';

$res = null;
if ($wsID > 0) {
    $sql = "SELECT COUNT(*) as total, wsID FROM booking WHERE wsID = ? GROUP BY wsID";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $wsID);
    $stmt->execute();
    $res = $stmt->get_result();
} elseif ($stuID > 0) {
    $sql = "SELECT COUNT(*) as total, stuID FROM booking WHERE stuID = ? GROUP BY stuID";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $stuID);
    $stmt->execute();
    $res = $stmt->get_result();
} elseif ($from !== '' && $to !== '') {
    $sql = "SELECT COUNT(*) as total FROM booking WHERE bookStart BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $from, $to);
    $stmt->execute();
    $res = $stmt->get_result();
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

    <?php if ($res): ?>
        <table>
            <tr><th>Query</th><th>Count</th></tr>
            <?php while ($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?php
                    if (isset($row['wsID'])) echo 'Workstation ID: ' . $row['wsID'];
                    elseif (isset($row['stuID'])) echo 'Student ID: ' . $row['stuID'];
                    else echo 'Date range';
                ?></td>
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
