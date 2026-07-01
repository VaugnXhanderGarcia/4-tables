<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petOwnerFName = $conn->real_escape_string($_POST['petOwnerFName'] ?? '');
    $petOwnerLName = $conn->real_escape_string($_POST['petOwnerLName'] ?? '');
    $petOwnerBDate = $conn->real_escape_string($_POST['petOwnerBDate'] ?? null);
    $petOwnerTelNo = $conn->real_escape_string($_POST['petOwnerTelNo'] ?? '');

    $sql = "INSERT INTO pet_owner (petOwnerFName, petOwnerLName, petOwnerBDate, petOwnerTelNo) VALUES ('$petOwnerFName', '$petOwnerLName', " . ($petOwnerBDate ? "'$petOwnerBDate'" : "NULL") . ", '$petOwnerTelNo')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); exit;
    } else {
        die('Database error: ' . $conn->error);
    }
}

header('Location: index.php'); exit;
