<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $consultID = intval($_POST['consultID'] ?? 0);
    $petID = intval($_POST['petID'] ?? 0);
    $vetID = intval($_POST['vetID'] ?? 0);
    $consultDate = $conn->real_escape_string($_POST['consultDate'] ?? '');
    $diagnoses = $conn->real_escape_string($_POST['diagnoses'] ?? '');
    $prescription = $conn->real_escape_string($_POST['prescription'] ?? '');

    $sql = "UPDATE consultation SET petID=$petID, vetID=$vetID, consultDate='$consultDate', diagnoses='$diagnoses', prescription='$prescription' WHERE consultID = $consultID";
    if ($conn->query($sql) === TRUE) { header('Location: index.php'); exit; } else { die('Database error: ' . $conn->error); }
}
header('Location: index.php'); exit;
