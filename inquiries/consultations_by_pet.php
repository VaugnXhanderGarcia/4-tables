<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$petID = isset($_GET['petID']) ? intval($_GET['petID']) : 0;
$rows = [];
if ($petID > 0) {
    $sql = "SELECT c.*, p.petName, p.petType, p.petBreed, v.vetFName, v.vetLName FROM consultation c JOIN pet p ON c.petID = p.petID JOIN veterinarian v ON c.vetID = v.vetID WHERE c.is_deleted = 0 AND c.petID = ? ORDER BY c.consultDate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $petID);
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
    <title>Consultations by Pet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Consultations by Pet</h1>
    <form method="get">
        <label>Pet ID</label>
        <input type="number" name="petID" value="<?= htmlspecialchars($petID); ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>
    <?php if ($petID > 0): ?>
        <p><strong>Count:</strong> <?= count($rows); ?></p>
        <?php if (!empty($rows)): ?>
            <table>
                <tr>
                    <th>Consult ID</th>
                    <th>Date</th>
                    <th>Pet Name</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Vet</th>
                    <th>Diagnoses</th>
                    <th>Prescription</th>
                </tr>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['consultID']); ?></td>
                    <td><?= htmlspecialchars($row['consultDate']); ?></td>
                    <td><?= htmlspecialchars($row['petName']); ?></td>
                    <td><?= htmlspecialchars($row['petType']); ?></td>
                    <td><?= htmlspecialchars($row['petBreed']); ?></td>
                    <td><?= htmlspecialchars($row['vetFName'] . ' ' . $row['vetLName']); ?></td>
                    <td><?= htmlspecialchars($row['diagnoses']); ?></td>
                    <td><?= htmlspecialchars($row['prescription']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No consultations found for this pet ID.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
