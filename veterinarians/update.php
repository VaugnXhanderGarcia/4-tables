<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vetID = intval($_POST['vetID'] ?? 0);
    $vetFName = $conn->real_escape_string($_POST['vetFName'] ?? '');
    $vetLName = $conn->real_escape_string($_POST['vetLName'] ?? '');
    $vetAddress = $conn->real_escape_string($_POST['vetAddress'] ?? '');
    $vetSpecialization = $conn->real_escape_string($_POST['vetSpecialization'] ?? '');

    $sql = "UPDATE veterinarian SET vetFName = '$vetFName', vetLName = '$vetLName', vetAddress = '$vetAddress', vetSpecialization = '$vetSpecialization' WHERE vetID = $vetID";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); exit;
    } else {
        die('Database error: ' . $conn->error);
    }
}

header('Location: index.php'); exit;
