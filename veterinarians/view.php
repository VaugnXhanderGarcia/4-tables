<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM veterinarian WHERE vetID = $id AND is_deleted = 0");
if (!$res || $res->num_rows === 0) { header('Location: index.php'); exit; }
$vet = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Veterinarian</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Veterinarian Details</h1>

    <p><strong>ID:</strong> <?= $vet['vetID']; ?></p>
    <p><strong>Name:</strong> <?= htmlspecialchars($vet['vetFName'] . ' ' . $vet['vetLName']); ?></p>
    <p><strong>Address:</strong> <?= htmlspecialchars($vet['vetAddress']); ?></p>
    <p><strong>Specialization:</strong> <?= htmlspecialchars($vet['vetSpecialization']); ?></p>

    <a href="index.php" class="btn btn-view">Back</a>
</div>
</body>
</html>
