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
    <title>Edit Pet Owner</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Edit Pet Owner</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="petOwnerID" value="<?= $owner['petOwnerID']; ?>">
        <label>First Name</label>
        <input type="text" name="petOwnerFName" required value="<?= htmlspecialchars($owner['petOwnerFName']); ?>">
        <label>Last Name</label>
        <input type="text" name="petOwnerLName" required value="<?= htmlspecialchars($owner['petOwnerLName']); ?>">
        <label>Birth Date</label>
        <input type="date" name="petOwnerBDate" value="<?= htmlspecialchars($owner['petOwnerBDate']); ?>">
        <label>Telephone</label>
        <input type="text" name="petOwnerTelNo" value="<?= htmlspecialchars($owner['petOwnerTelNo']); ?>">
        <button type="submit" class="btn btn-edit">Update</button>
    </form>
</div>
</body>
</html>
