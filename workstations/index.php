<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$result = $conn->query("SELECT * FROM workstation ORDER BY wsID DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Workstation List </title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Workstation List</h1>

    <div class="nav-links">
        <a href="../index.php" class="btn btn-view">Back Home</a>
        <a href="create.php" class="btn btn-add">Add Workstation</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Lab Room</th>
            <th>PC Number</th>
            <th>Software</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) : ?>

        <tr>
            <td><?= $row['wsID']; ?></td>
            <td><?= htmlspecialchars($row['wsLabRoom']); ?></td>
            <td><?= htmlspecialchars($row['wsPCNum']); ?></td>
            <td><?= htmlspecialchars($row['wsSoftware']); ?></td>
            <td><?= htmlspecialchars($row['wsStatus']); ?></td>
            <td>
                <a href="view.php?id=<?= $row['wsID']; ?>" class="btn btn-view">View</a>
                <a href="edit.php?id=<?= $row['wsID']; ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $row['wsID']; ?>"
                   class="btn btn-delete"
                   onclick="return confirm('Are you sure you want to delete this workstation?')">
                   Delete
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>
