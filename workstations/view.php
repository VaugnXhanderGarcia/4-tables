<?php

include '../config/database.php';

if (!isset($_GET['id'])) {
    die("Workstation ID is missing.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM workstation WHERE wsID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$workstation = $result->fetch_assoc();

if (!$workstation) {
    die("Workstation not found.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Workstation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">

    <h1>Workstation Details</h1>

    <div class="card">
        <p><strong>ID:</strong> <?= $workstation['wsID']; ?></p>
        <p><strong>Lab Room:</strong> <?= htmlspecialchars($workstation['wsLabRoom']); ?></p>
        <p><strong>PC Number:</strong> <?= htmlspecialchars($workstation['wsPCNum']); ?></p>
        <p><strong>Software:</strong> <?= htmlspecialchars($workstation['wsSoftware']); ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($workstation['wsStatus']); ?></p>
    </div>

    <br>

    <a href="index.php" class="btn btn-view">Back</a>

</div>

</body>
</html>
