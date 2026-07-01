<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petID = intval($_POST['petID'] ?? 0);
    $vetID = intval($_POST['vetID'] ?? 0);
    $consultDate = $conn->real_escape_string($_POST['consultDate'] ?? '');
    $diagnoses = $conn->real_escape_string($_POST['diagnoses'] ?? '');
    $prescription = $conn->real_escape_string($_POST['prescription'] ?? '');

    $sql = "INSERT INTO consultation (petID, vetID, consultDate, diagnoses, prescription) VALUES ($petID, $vetID, '$consultDate', '$diagnoses', '$prescription')";
    if ($conn->query($sql) === TRUE) { header('Location: index.php'); exit; } else { die('Database error: ' . $conn->error); }
}
header('Location: index.php'); exit;
