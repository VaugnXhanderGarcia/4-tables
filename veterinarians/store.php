<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vetFName = $conn->real_escape_string($_POST['vetFName'] ?? '');
    $vetLName = $conn->real_escape_string($_POST['vetLName'] ?? '');
    $vetAddress = $conn->real_escape_string($_POST['vetAddress'] ?? '');
    $vetSpecialization = $conn->real_escape_string($_POST['vetSpecialization'] ?? '');

    $sql = "INSERT INTO veterinarian (vetFName, vetLName, vetAddress, vetSpecialization) VALUES ('$vetFName', '$vetLName', '$vetAddress', '$vetSpecialization')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit;
    } else {
        die('Database error: ' . $conn->error);
    }
}

header('Location: index.php');
exit;
