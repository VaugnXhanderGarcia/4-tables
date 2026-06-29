<?php
include '../config/database.php';
if (empty($_POST['bookID']) || empty($_POST['stuID']) || empty($_POST['wsID']) || empty($_POST['bookStart']) || empty($_POST['bookEnd'])) {
    die("Required fields missing.");
}
$bookID = intval($_POST['bookID']);
$stuID = intval($_POST['stuID']);
$wsID = intval($_POST['wsID']);
$bookStart = date('Y-m-d H:i:s', strtotime($_POST['bookStart']));
$bookEnd = date('Y-m-d H:i:s', strtotime($_POST['bookEnd']));
$purpose = trim($_POST['purpose']);

$sql = "UPDATE booking SET stuID = ?, wsID = ?, bookStart = ?, bookEnd = ?, purpose = ? WHERE bookID = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) die("Prepare failed: " . $conn->error);
$stmt->bind_param("iisssi", $stuID, $wsID, $bookStart, $bookEnd, $purpose, $bookID);
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}
?>