<?php

include '../config/database.php';

if (!isset($_GET['stuID'])) {
    die("Student ID is missing.");
}

$stuID = $_GET['stuID'];

$sql = "SELECT * FROM student WHERE stuID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $stuID);

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
    <title>View Student</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">

    <h1>Student Details</h1>

    <div class="card">
        <p><strong>ID:</strong> <?= $student['stuID']; ?></p>
        <p><strong>First Name:</strong> <?= htmlspecialchars($student['stuFName']); ?></p>
        <p><strong>Last Name:</strong> <?= htmlspecialchars($student['stuLName']); ?></p>
        <p><strong>Course:</strong> <?= htmlspecialchars($student['stuCourse']); ?></p>
        <p><strong>Year:</strong> <?= htmlspecialchars($student['stuYear']); ?></p> 
    </div>

    <br>

    <a href="index.php" class="btn btn-view">Back</a>

</div>

</body>
</html>