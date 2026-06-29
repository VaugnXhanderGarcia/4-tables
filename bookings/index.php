<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = '';
if ($search !== '') {
    $keyword = $conn->real_escape_string($search);
    $searchSql = "WHERE b.bookID LIKE '%$keyword%' OR s.stuFName LIKE '%$keyword%' OR s.stuLName LIKE '%$keyword%' OR w.wsLabRoom LIKE '%$keyword%' OR w.wsPCNum LIKE '%$keyword%' OR b.purpose LIKE '%$keyword%'";
}

$sql = "SELECT b.*, s.stuFName, s.stuLName, w.wsLabRoom, w.wsPCNum
        FROM booking b
        JOIN student s ON b.stuID = s.stuID
        JOIN workstation w ON b.wsID = w.wsID
        $searchSql
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
    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search bookings..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-view">Search</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn btn-delete search-reset">Clear</a>
        <?php endif; ?>
    </form>
    <div class="nav-links">
        <a href="../index.php" class="btn btn-view">Back Home</a>
        <a href="create.php" class="btn btn-add">Add Booking</a>
    </div>
    <table>
        <tr>
            <th>ID</th><th>Student</th><th>Workstation</th><th>Start</th><th>End</th><th>Purpose</th><th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0) : ?>
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
        <?php else: ?>
            <tr>
                <td colspan="7" class="no-results">No bookings match your search.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>