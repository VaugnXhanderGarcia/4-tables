<?php
include '../config/database.php';
if (!isset($_GET['id'])) die("Booking ID missing.");
$id = intval($_GET['id']);
$sql = "SELECT b.*, s.stuFName, s.stuLName, w.wsLabRoom, w.wsPCNum
        FROM booking b
        JOIN student s ON b.stuID = s.stuID
        JOIN workstation w ON b.wsID = w.wsID
        WHERE b.bookID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$b = $res->fetch_assoc();
if (!$b) die("Booking not found.");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Booking</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Booking Details</h1>
    <div class="card">
        <p><strong>ID:</strong> <?= $b['bookID']; ?></p>
        <p><strong>Student:</strong> <?= htmlspecialchars($b['stuFName'] . ' ' . $b['stuLName']); ?></p>
        <p><strong>Workstation:</strong> <?= htmlspecialchars($b['wsLabRoom'] . ' / ' . $b['wsPCNum']); ?></p>
        <p><strong>Start:</strong> <?= htmlspecialchars($b['bookStart']); ?></p>
        <p><strong>End:</strong> <?= htmlspecialchars($b['bookEnd']); ?></p>
        <p><strong>Purpose:</strong> <?= htmlspecialchars($b['purpose']); ?></p>
    </div>
    <br>
    <a href="index.php" class="btn btn-view">Back</a>
</div>
</body>
</html>