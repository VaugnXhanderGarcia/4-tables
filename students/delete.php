<?php

include '../config/database.php';


if (isset($_GET['stuID'])) {
    $stuID = intval($_GET['stuID']);
} elseif (isset($_GET['id'])) {
    $stuID   = intval($_GET['id']);
} else {
    die("Student ID missing.");
}

$sql = "DELETE FROM student WHERE stuID = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $stuID);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Delete failed: " . $stmt->error;
}

?>