<?php

include '../config/database.php';

if (
    empty($_POST['stuID']) ||
    empty($_POST['stuFName']) ||
    empty($_POST['stuLName']) ||
    empty($_POST['stuCourse']) ||
    empty($_POST['stuYear'])
) {
    die("All fields are required.");
}

$stuID = $_POST['stuID'];
$stuFName = trim($_POST['stuFName']);
$stuLName = trim($_POST['stuLName']);
$stuCourse = trim($_POST['stuCourse']);
$stuYear = trim($_POST['stuYear']);

$sql = "UPDATE student
        SET stuFName = ?, stuLName = ?, stuCourse = ?, stuYear = ?
        WHERE stuID = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssi",
    $stuFName,
    $stuLName,
    $stuCourse,
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