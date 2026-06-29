<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$specialization = isset($_GET['specialization']) ? trim($_GET['specialization']) : '';

if ($specialization !== '') {
    $sql = "SELECT COUNT(*) as total, stuCourse, stuSpecialization FROM student WHERE stuSpecialization = ? GROUP BY stuCourse, stuSpecialization";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $specialization);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Students by Specialization</title>
    <link rel="stylesheet" href="../assets/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Students by Specialization</h1>
    <form method="get">
        <input type="text" name="specialization" placeholder="Specialization" value="<?= htmlspecialchars($specialization); ?>">
        <button type="submit" class="btn btn-view">Search</button>
    </form>

    <?php if ($res): ?>
        <table>
            <tr><th>Course</th><th>Specialization</th><th>Count</th></tr>
            <?php while ($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['stuCourse']); ?></td>
                <td><?= htmlspecialchars($row['stuSpecialization']); ?></td>
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
