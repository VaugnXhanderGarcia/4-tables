<?php

include '../config/database.php';

if (
    empty($_POST['wsID']) ||
    empty($_POST['wsLabRoom']) ||
    empty($_POST['wsPCNum']) ||
    empty($_POST['wsSoftware']) ||
    empty($_POST['wsStatus'])
) {
    die("All fields are required.");
}

$wsID = $_POST['wsID'];
$wsLabRoom = trim($_POST['wsLabRoom']);
$wsPCNum = trim($_POST['wsPCNum']);
$wsSoftware = trim($_POST['wsSoftware']);
$wsStatus = trim($_POST['wsStatus']);

$sql = "UPDATE workstation
        SET wsLabRoom = ?, wsPCNum = ?, wsSoftware = ?, wsStatus = ?
        WHERE wsID = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssi", $wsLabRoom, $wsPCNum, $wsSoftware, $wsStatus, $wsID);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}

?>
    