<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = "WHERE is_deleted = 0";
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE is_deleted = 0 AND (vetID LIKE '%$keyword%' OR vetFName LIKE '%$keyword%' OR vetLName LIKE '%$keyword%' OR vetSpecialization LIKE '%$keyword%')";
}

$result = $conn->query("SELECT * FROM veterinarian $searchSql ORDER BY vetID ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Veterinarians</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Veterinarian List</h1>

    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search vets..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn btn-delete search-reset">Clear</a>
        <?php endif; ?>
    </form>

    <a href="create.php" class="btn btn-add">Add Veterinarian</a>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Specialization</th>
            <th>Actions</th>
        </tr>

        <?php if ($result && $result->num_rows > 0) : ?>
            <?php while($row = $result->fetch_assoc()) : ?>

            <tr>
                <td><?= $row['vetID']; ?></td>
                <td><?= htmlspecialchars($row['vetFName']); ?></td>
                <td><?= htmlspecialchars($row['vetLName']); ?></td>
                <td><?= htmlspecialchars($row['vetSpecialization']); ?></td>
                <td>
                    <a href="view.php?id=<?= $row['vetID']; ?>" class="btn btn-view">View</a>
                    <a href="edit.php?id=<?= $row['vetID']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?= $row['vetID']; ?>"
                       class="btn btn-delete"
                       onclick="return confirm('Are you sure you want to delete this veterinarian?')">
                       Delete
                    </a>
                </td>
            </tr>

            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="no-results">No veterinarians found.</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>
