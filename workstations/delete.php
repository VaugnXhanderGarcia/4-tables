<?php

include '../config/database.php';

if (!isset($_GET['id'])) {
    die("Workstation ID missing.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM workstation WHERE wsID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Delete failed: " . $stmt->error;
}

?>
