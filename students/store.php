<?php

include '../config/database.php';

if (
    empty($_POST['stuFName']) ||
    empty($_POST['stuLName']) ||
    empty($_POST['stuCourse']) ||
    empty($_POST['stuYear'])
) {
    die("All fields are required.");
}

$stuFName = trim($_POST['stuFName']);
$stuLName = trim($_POST['stuLName']);
$stuCourse = trim($_POST['stuCourse']);
$stuYear = trim($_POST['stuYear']);

$sql = "INSERT INTO student (stuFName, stuLName, stuCourse, stuYear)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssss", $stuFName, $stuLName, $stuCourse, $stuYear);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

?>