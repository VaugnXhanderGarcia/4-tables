<?php

include '../config/database.php';

if (!isset($_GET['id'])) {
    die("Student ID is missing.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM student WHERE stuID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Edit Student</h1>

    <form action="update.php" method="POST">

        <input type="hidden" name="stuID" value="<?= $student['stuID']; ?>">

        <input type="text"
               name="stuFName"
               value="<?= htmlspecialchars($student['stuFName']); ?>"
               required>

        <input type="text"
               name="stuLName"
               value="<?= htmlspecialchars($student['stuLName']); ?>"
               required>

        <input type="text"
               name="stuCourse"
               value="<?= htmlspecialchars($student['stuCourse']); ?>"
               required>

        <input type="number"
               name="stuYear"
               value="<?= htmlspecialchars($student['stuYear']); ?>"
               required>

        <button type="submit" class="btn btn-edit">Update Student</button>

    </form>

</div>

</body>
</html>