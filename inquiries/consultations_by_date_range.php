<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$from = isset($_GET['from']) ? trim($_GET['from']) : '';
$to = isset($_GET['to']) ? trim($_GET['to']) : '';
$rows = [];
if ($from !== '' && $to !== '') {
    $sql = "SELECT c.*, p.petName, v.vetFName, v.vetLName FROM consultation c LEFT JOIN pet p ON c.petID = p.petID LEFT JOIN veterinarian v ON c.vetID = v.vetID WHERE c.is_deleted = 0 AND c.consultDate BETWEEN ? AND ? ORDER BY c.consultDate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $from, $to);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }
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
    <?php if ($from !== '' && $to !== ''): ?>
        <p><strong>Count:</strong> <?= count($rows); ?></p>
        <?php if (!empty($rows)): ?>
            <table>
                <tr>
                    <th>Consult ID</th>
                    <th>Date</th>
                    <th>Pet Name</th>
                    <th>Vet</th>
                    <th>Diagnoses</th>
                    <th>Prescription</th>
                </tr>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['consultID']); ?></td>
                    <td><?= htmlspecialchars($row['consultDate']); ?></td>
                    <td><?= htmlspecialchars($row['petName']); ?></td>
                    <td><?= htmlspecialchars($row['vetFName'] . ' ' . $row['vetLName']); ?></td>
                    <td><?= htmlspecialchars($row['diagnoses']); ?></td>
                    <td><?= htmlspecialchars($row['prescription']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No consultations found in that date range.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
