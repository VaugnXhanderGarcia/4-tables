<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$course = isset($_GET['course']) ? trim($_GET['course']) : '';
$rows = [];
if ($course !== '') {
    $sql = "SELECT * FROM student WHERE stuCourse LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeCourse = "%$course%";
    $stmt->bind_param('s', $likeCourse);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }
}

function renderTable(array $rows): void {
    if (empty($rows)) {
        return;
    }
    echo '<table><tr>';
    foreach (array_keys($rows[0]) as $column) {
        echo '<th>' . htmlspecialchars($column) . '</th>';
    }
    echo '</tr>';
    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . htmlspecialchars((string)$value) . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
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

    <?php if ($course !== ''): ?>
        <p><strong>Count:</strong> <?= count($rows); ?></p>
        <?php if (!empty($rows)): ?>
            <?php renderTable($rows); ?>
        <?php else: ?>
            <p>No students found for that course.</p>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <a href="../index.php" class="btn btn-view">Back Home</a>
</div>
</body>
</html>
