<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id']);
$res = $conn->query("SELECT p.*, o.petOwnerFName, o.petOwnerLName FROM pet p LEFT JOIN pet_owner o ON p.petOwnerID = o.petOwnerID WHERE p.petID = $id AND p.is_deleted = 0");
if (!$res || $res->num_rows === 0) { header('Location: index.php'); exit; }
$pet = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Pet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Pet Details</h1>
    <p><strong>ID:</strong> <?= $pet['petID']; ?></p>
    <p><strong>Name:</strong> <?= htmlspecialchars($pet['petName']); ?></p>
    <p><strong>Owner:</strong> <?= htmlspecialchars($pet['petOwnerFName'] . ' ' . $pet['petOwnerLName']); ?></p>
    <p><strong>Type:</strong> <?= htmlspecialchars($pet['petType']); ?></p>
    <p><strong>Breed:</strong> <?= htmlspecialchars($pet['petBreed']); ?></p>
    <p><strong>Birth Date:</strong> <?= htmlspecialchars($pet['petBDate']); ?></p>
    <a href="index.php" class="btn btn-view">Back</a>
</div>
</body>
</html>
