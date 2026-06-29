<?php

include '../config/database.php';

if (
    empty($_POST['stuFName']) ||
    empty($_POST['stuLName']) ||
    empty($_POST['stuCourse']) ||
    !isset($_POST['stuYear'])
) {
    die("Required fields are missing.");
}

$stuFName = trim($_POST['stuFName']);
$stuLName = trim($_POST['stuLName']);
$stuCourse = trim($_POST['stuCourse']);
$stuSpecialization = isset($_POST['stuSpecialization']) ? trim($_POST['stuSpecialization']) : null;
$stuYear = intval($_POST['stuYear']);

$sql = "INSERT INTO student (stuFName, stuLName, stuCourse, stuSpecialization, stuYear)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssi", $stuFName, $stuLName, $stuCourse, $stuSpecialization, $stuYear);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

?>