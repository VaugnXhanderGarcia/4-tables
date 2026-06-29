<?php
include '../config/database.php';
if (empty($_POST['stuID']) || empty($_POST['wsID']) || empty($_POST['bookStart']) || empty($_POST['bookEnd'])) {
    die("Required fields missing.");
}
$stuID = intval($_POST['stuID']);
$wsID = intval($_POST['wsID']);
$bookStart = date('Y-m-d H:i:s', strtotime($_POST['bookStart']));
$bookEnd = date('Y-m-d H:i:s', strtotime($_POST['bookEnd']));
$purpose = trim($_POST['purpose']);

$sql = "INSERT INTO booking (stuID, wsID, bookStart, bookEnd, purpose) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) die("Prepare failed: " . $conn->error);
$stmt->bind_param("iisss", $stuID, $wsID, $bookStart, $bookEnd, $purpose);
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>