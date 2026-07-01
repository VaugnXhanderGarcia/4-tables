<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id']);
$sql = "UPDATE pet SET is_deleted = 1 WHERE petID = $id";
if ($conn->query($sql) === TRUE) { header('Location: index.php'); exit; } else { die('Database error: ' . $conn->error); }
