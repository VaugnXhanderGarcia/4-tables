<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petOwnerID = intval($_POST['petOwnerID'] ?? 0);
    $petOwnerFName = $conn->real_escape_string($_POST['petOwnerFName'] ?? '');
    $petOwnerLName = $conn->real_escape_string($_POST['petOwnerLName'] ?? '');
    $petOwnerBDate = $conn->real_escape_string($_POST['petOwnerBDate'] ?? null);
    $petOwnerTelNo = $conn->real_escape_string($_POST['petOwnerTelNo'] ?? '');

    $sql = "UPDATE pet_owner SET petOwnerFName = '$petOwnerFName', petOwnerLName = '$petOwnerLName', petOwnerBDate = " . ($petOwnerBDate ? "'$petOwnerBDate'" : "NULL") . ", petOwnerTelNo = '$petOwnerTelNo' WHERE petOwnerID = $petOwnerID";
    if ($conn->query($sql) === TRUE) { header('Location: index.php'); exit; } else { die('Database error: ' . $conn->error); }
}

header('Location: index.php'); exit;
