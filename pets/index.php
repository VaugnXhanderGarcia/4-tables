<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = "WHERE p.is_deleted = 0";
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE p.is_deleted = 0 AND (p.petID LIKE '%$keyword%' OR p.petName LIKE '%$keyword%' OR p.petType LIKE '%$keyword%' OR o.petOwnerFName LIKE '%$keyword%' OR o.petOwnerLName LIKE '%$keyword%')";
}

$result = $conn->query("SELECT p.*, o.petOwnerFName, o.petOwnerLName FROM pet p LEFT JOIN pet_owner o ON p.petOwnerID = o.petOwnerID $searchSql ORDER BY p.petID ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pets</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Pet List</h1>
    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search pets..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?> <a href="index.php" class="btn btn-delete search-reset">Clear</a> <?php endif; ?>
    </form>
    <a href="create.php" class="btn btn-add">Add Pet</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Owner</th>
            <th>Type</th>
            <th>Breed</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['petID']; ?></td>
            <td><?= htmlspecialchars($row['petName']); ?></td>
            <td><?= htmlspecialchars($row['petOwnerFName'] . ' ' . $row['petOwnerLName']); ?></td>
            <td><?= htmlspecialchars($row['petType']); ?></td>
            <td><?= htmlspecialchars($row['petBreed']); ?></td>
            <td>
                <a href="view.php?id=<?= $row['petID']; ?>" class="btn btn-view">View</a>
                <a href="edit.php?id=<?= $row['petID']; ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $row['petID']; ?>" class="btn btn-delete" onclick="return confirm('Delete this pet?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="6" class="no-results">No pets found.</td></tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
