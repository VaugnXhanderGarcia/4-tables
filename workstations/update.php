<?php

include '../config/database.php';

if (
    empty($_POST['wsID']) ||
    empty($_POST['wsLabRoom']) ||
    empty($_POST['wsPCNum']) ||
    empty($_POST['wsSoftware']) ||
    empty($_POST['wsStatus']) ||
    !isset($_POST['wsAge'])
) {
    die("All fields are required.");
}

$wsID = intval($_POST['wsID']);
$wsLabRoom = trim($_POST['wsLabRoom']);
$wsPCNum = trim($_POST['wsPCNum']);
$wsSoftware = trim($_POST['wsSoftware']);
$wsStatus = trim($_POST['wsStatus']);
$wsAge = intval($_POST['wsAge']);

$sql = "UPDATE workstation
        SET wsLabRoom = ?, wsPCNum = ?, wsSoftware = ?, wsStatus = ?, wsAge = ?
        WHERE wsID = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssiii", $wsLabRoom, $wsPCNum, $wsSoftware, $wsStatus, $wsAge, $wsID);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}

?>
    