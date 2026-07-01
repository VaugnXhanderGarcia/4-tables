<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = "WHERE is_deleted = 0";
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE is_deleted = 0 AND (petOwnerID LIKE '%$keyword%' OR petOwnerFName LIKE '%$keyword%' OR petOwnerLName LIKE '%$keyword%' OR petOwnerTelNo LIKE '%$keyword%')";
}

$result = $conn->query("SELECT * FROM pet_owner $searchSql ORDER BY petOwnerID ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pet Owners</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Pet Owner List</h1>

    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search pet owners..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn btn-delete search-reset">Clear</a>
        <?php endif; ?>
    </form>

    <a href="create.php" class="btn btn-add">Add Pet Owner</a>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Telephone</th>
            <th>Actions</th>
        </tr>

        <?php if ($result && $result->num_rows > 0) : ?>
            <?php while($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['petOwnerID']; ?></td>
                <td><?= htmlspecialchars($row['petOwnerFName']); ?></td>
                <td><?= htmlspecialchars($row['petOwnerLName']); ?></td>
                <td><?= htmlspecialchars($row['petOwnerTelNo']); ?></td>
                <td>
                    <a href="view.php?id=<?= $row['petOwnerID']; ?>" class="btn btn-view">View</a>
                    <a href="edit.php?id=<?= $row['petOwnerID']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?= $row['petOwnerID']; ?>"
                       class="btn btn-delete"
                       onclick="return confirm('Are you sure you want to delete this pet owner?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="no-results">No pet owners found.</td>
            </tr>
        <?php endif; ?>

    </table>

</div>
</body>
</html>
