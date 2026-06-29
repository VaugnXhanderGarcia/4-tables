<?php
include '../config/database.php';
if (!isset($_GET['id'])) die("Booking ID missing.");
$id = intval($_GET['id']);
$sql = "DELETE FROM booking WHERE bookID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Delete failed: " . $stmt->error;
}
?>