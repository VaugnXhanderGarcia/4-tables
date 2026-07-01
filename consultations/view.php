<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id']);
$res = $conn->query("SELECT c.*, p.petName, v.vetFName, v.vetLName FROM consultation c LEFT JOIN pet p ON c.petID = p.petID LEFT JOIN veterinarian v ON c.vetID = v.vetID WHERE c.consultID = $id AND c.is_deleted = 0");
if (!$res || $res->num_rows === 0) { header('Location: index.php'); exit; }
$c = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Consultation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Consultation Details</h1>
    <p><strong>ID:</strong> <?= $c['consultID']; ?></p>
    <p><strong>Pet:</strong> <?= htmlspecialchars($c['petName']); ?></p>
    <p><strong>Veterinarian:</strong> <?= htmlspecialchars($c['vetFName'].' '.$c['vetLName']); ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($c['consultDate']); ?></p>
    <p><strong>Diagnoses:</strong><br><?= nl2br(htmlspecialchars($c['diagnoses'])); ?></p>
    <p><strong>Prescription:</strong><br><?= nl2br(htmlspecialchars($c['prescription'])); ?></p>
    <a href="index.php" class="btn btn-view">Back</a>
</div>
</body>
</html>
