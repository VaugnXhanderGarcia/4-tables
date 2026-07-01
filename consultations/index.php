<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = "WHERE c.is_deleted = 0";
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE c.is_deleted = 0 AND (c.consultID LIKE '%$keyword%' OR p.petName LIKE '%$keyword%' OR v.vetFName LIKE '%$keyword%' OR v.vetLName LIKE '%$keyword%')";
}

$result = $conn->query("SELECT c.*, p.petName, v.vetFName, v.vetLName FROM consultation c LEFT JOIN pet p ON c.petID = p.petID LEFT JOIN veterinarian v ON c.vetID = v.vetID $searchSql ORDER BY c.consultDate DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Consultations</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Consultations</h1>
    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search consultations..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?> <a href="index.php" class="btn btn-delete search-reset">Clear</a> <?php endif; ?>
    </form>
    <a href="create.php" class="btn btn-add">Add Consultation</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Pet</th>
            <th>Veterinarian</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['consultID']; ?></td>
            <td><?= htmlspecialchars($row['petName']); ?></td>
            <td><?= htmlspecialchars($row['vetFName'] . ' ' . $row['vetLName']); ?></td>
            <td><?= htmlspecialchars($row['consultDate']); ?></td>
            <td>
                <a href="view.php?id=<?= $row['consultID']; ?>" class="btn btn-view">View</a>
                <a href="edit.php?id=<?= $row['consultID']; ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $row['consultID']; ?>" class="btn btn-delete" onclick="return confirm('Delete this consultation?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="5" class="no-results">No consultations found.</td></tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
