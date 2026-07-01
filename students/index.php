<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = '';
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE stuID LIKE '%$keyword%' OR stuFName LIKE '%$keyword%' OR stuLName LIKE '%$keyword%' OR stuCourse LIKE '%$keyword%' OR stuYear LIKE '%$keyword%'";
}

$result = $conn->query("SELECT * FROM student $searchSql ORDER BY stuID ASC");
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

    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search students..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn btn-delete search-reset">Clear</a>
        <?php endif; ?>
    </form>

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

        <?php if ($result && $result->num_rows > 0) : ?>
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
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-results">No students match your search.</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>