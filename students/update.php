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
$stuYear = intval($_POST['stuYear']);

$sql = "UPDATE student
        SET stuFName = ?, stuLName = ?, stuCourse = ?, stuYear = ?
        WHERE stuID = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "sssii",
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