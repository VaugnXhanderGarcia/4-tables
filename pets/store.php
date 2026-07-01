<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petOwnerID = intval($_POST['petOwnerID'] ?? 0);
    $petName = $conn->real_escape_string($_POST['petName'] ?? '');
    $petType = $conn->real_escape_string($_POST['petType'] ?? '');
    $petBreed = $conn->real_escape_string($_POST['petBreed'] ?? '');
    $petBDate = $conn->real_escape_string($_POST['petBDate'] ?? null);

    $sql = "INSERT INTO pet (petOwnerID, petName, petType, petBreed, petBDate) VALUES ($petOwnerID, '$petName', '$petType', '$petBreed', " . ($petBDate ? "'$petBDate'" : "NULL") . ")";
    if ($conn->query($sql) === TRUE) { header('Location: index.php'); exit; } else { die('Database error: ' . $conn->error); }
}
header('Location: index.php'); exit;
