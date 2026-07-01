<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$spec = isset($_GET['spec']) ? trim($_GET['spec']) : '';
$rows = [];
if ($spec !== '') {
    $sql = "SELECT * FROM veterinarian WHERE is_deleted = 0 AND vetSpecialization LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeSpec = "%$spec%";
    $stmt->bind_param('s', $likeSpec);
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
        <p><strong>Count:</strong> <?= count($rows); ?></p>
        <?php if (count($rows) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Specialization</th>
                </tr>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['vetID']); ?></td>
                    <td><?= htmlspecialchars($row['vetFName']); ?></td>
                    <td><?= htmlspecialchars($row['vetLName']); ?></td>
                    <td><?= htmlspecialchars($row['vetAddress']); ?></td>
                    <td><?= htmlspecialchars($row['vetSpecialization']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No veterinarians found for that specialization.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
