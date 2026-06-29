<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$result = $conn->query("SELECT * FROM student ORDER BY stuID DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Student List</h1>

    <a href="create.php" class="btn btn-add">Add Student</a>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) : ?>

        <tr>
            <td><?= $row['stuID']; ?></td>
            <td><?= htmlspecialchars($row['stuFName']); ?></td>
            <td><?= htmlspecialchars($row['stuLName']); ?></td>
            <td><?= htmlspecialchars($row['stuCourse']); ?></td>
            <td><?= htmlspecialchars($row['stuYear']); ?></td>
            <td>
                <a href="view.php?id=<?= $row['stuID']; ?>" class="btn btn-view">View</a>

                <a href="edit.php?id=<?= $row['stuID']; ?>" class="btn btn-edit">Edit</a>

                <a href="delete.php?id=<?= $row['stuID']; ?>"
                   class="btn btn-delete"
                   onclick="return confirm('Are you sure you want to delete this student?')">
                   Delete
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>