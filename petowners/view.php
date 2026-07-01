<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM pet_owner WHERE petOwnerID = $id AND is_deleted = 0");
if (!$res || $res->num_rows === 0) { header('Location: index.php'); exit; }
$owner = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Pet Owner</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Pet Owner Details</h1>
    <p><strong>ID:</strong> <?= $owner['petOwnerID']; ?></p>
    <p><strong>Name:</strong> <?= htmlspecialchars($owner['petOwnerFName'] . ' ' . $owner['petOwnerLName']); ?></p>
    <p><strong>Birth Date:</strong> <?= htmlspecialchars($owner['petOwnerBDate']); ?></p>
    <p><strong>Telephone:</strong> <?= htmlspecialchars($owner['petOwnerTelNo']); ?></p>
    <a href="index.php" class="btn btn-view">Back</a>
</div>
</body>
</html>
