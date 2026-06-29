<?php

include '../config/database.php';

if (
    empty($_POST['stuID']) ||
    empty($_POST['stuFName']) ||
    empty($_POST['stuLName']) ||
    empty($_POST['stuCourse']) ||
    !isset($_POST['stuYear'])
) {
    die("Required fields are missing.");
}

$stuID = intval($_POST['stuID']);
$stuFName = trim($_POST['stuFName']);
$stuLName = trim($_POST['stuLName']);
$stuCourse = trim($_POST['stuCourse']);
$stuSpecialization = isset($_POST['stuSpecialization']) ? trim($_POST['stuSpecialization']) : null;
$stuYear = intval($_POST['stuYear']);

$sql = "UPDATE student
        SET stuFName = ?, stuLName = ?, stuCourse = ?, stuSpecialization = ?, stuYear = ?
        WHERE stuID = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssii",
    $stuFName,
    $stuLName,
    $stuCourse,
    $stuSpecialization,
    $stuYear,
    $stuID
);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}

?>