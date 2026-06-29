<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$course = isset($_GET['course']) ? trim($_GET['course']) : '';

if ($course !== '') {
    $sql = "SELECT COUNT(*) as total, stuCourse FROM student WHERE stuCourse = ? GROUP BY stuCourse";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $course);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Students by Course</title>
    <link rel="stylesheet" href="../assets/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Students by Course</h1>
    <form method="get">
        <input type="text" name="course" placeholder="Course" value="<?= htmlspecialchars($course); ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>

    <?php if ($res): ?>
        <table>
            <tr><th>Course</th><th>Count</th></tr>
            <?php while ($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['stuCourse']); ?></td>
                <td><?= $row['total']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
    <br>
    <a href="../index.php" class="btn btn-view">Back Home</a>
</div>
</body>
</html>
