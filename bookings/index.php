<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';
$sql = "SELECT b.*, s.stuFName, s.stuLName, w.wsLabRoom, w.wsPCNum
        FROM booking b
        JOIN student s ON b.stuID = s.stuID
        JOIN workstation w ON b.wsID = w.wsID
        ORDER BY b.bookID DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookings</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Bookings</h1>
    <div class="nav-links">
        <a href="../index.php" class="btn btn-view">Back Home</a>
        <a href="create.php" class="btn btn-add">Add Booking</a>
    </div>
    <table>
        <tr>
            <th>ID</th><th>Student</th><th>Workstation</th><th>Start</th><th>End</th><th>Purpose</th><th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['bookID']; ?></td>
            <td><?= htmlspecialchars($row['stuFName'] . ' ' . $row['stuLName']); ?></td>
            <td><?= htmlspecialchars($row['wsLabRoom'] . ' / ' . $row['wsPCNum']); ?></td>
            <td><?= htmlspecialchars($row['bookStart']); ?></td>
            <td><?= htmlspecialchars($row['bookEnd']); ?></td>
            <td><?= htmlspecialchars($row['purpose']); ?></td>
            <td>
                <a href="view.php?id=<?= $row['bookID']; ?>" class="btn btn-view">View</a>
                <a href="edit.php?id=<?= $row['bookID']; ?>" class="btn btn-edit">Edit</a>
                <a href="delete.php?id=<?= $row['bookID']; ?>" class="btn btn-delete" onclick="return confirm('Delete this booking?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>