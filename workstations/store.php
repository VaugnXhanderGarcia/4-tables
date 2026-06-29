<?php

include '../config/database.php';

if (
    empty($_POST['wsLabRoom']) ||
    empty($_POST['wsPCNum']) ||
    !isset($_POST['wsAge']) ||
    empty($_POST['wsSoftware']) ||
    empty($_POST['wsStatus'])
) {
    die("All fields are required.");
}

$wsLabRoom = trim($_POST['wsLabRoom']);
$wsPCNum = trim($_POST['wsPCNum']);
$wsSoftware = trim($_POST['wsSoftware']);
$wsStatus = trim($_POST['wsStatus']);
$wsAge = intval($_POST['wsAge']);

$sql = "INSERT INTO workstation (wsLabRoom, wsPCNum, wsSoftware, wsStatus, wsAge)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssi", $wsLabRoom, $wsPCNum, $wsSoftware, $wsStatus, $wsAge);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

?>
