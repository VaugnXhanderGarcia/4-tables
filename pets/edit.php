<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM pet WHERE petID = $id AND is_deleted = 0");
if (!$res || $res->num_rows === 0) { header('Location: index.php'); exit; }
$pet = $res->fetch_assoc();
$owners = $conn->query("SELECT * FROM pet_owner WHERE is_deleted = 0 ORDER BY petOwnerLName ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Edit Pet</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="petID" value="<?= $pet['petID']; ?>">
        <label>Owner</label>
        <select name="petOwnerID" required>
            <?php while($o = $owners->fetch_assoc()): ?>
                <option value="<?= $o['petOwnerID']; ?>" <?= $o['petOwnerID'] == $pet['petOwnerID'] ? 'selected' : ''; ?>><?= htmlspecialchars($o['petOwnerFName'] . ' ' . $o['petOwnerLName']); ?></option>
            <?php endwhile; ?>
        </select>
        <label>Pet Name</label>
        <input type="text" name="petName" required value="<?= htmlspecialchars($pet['petName']); ?>">
        <label>Type</label>
        <input type="text" name="petType" value="<?= htmlspecialchars($pet['petType']); ?>">
        <label>Breed</label>
        <input type="text" name="petBreed" value="<?= htmlspecialchars($pet['petBreed']); ?>">
        <label>Birth Date</label>
        <input type="date" name="petBDate" value="<?= htmlspecialchars($pet['petBDate']); ?>">
        <button type="submit" class="btn btn-edit">Update</button>
    </form>
</div>
</body>
</html>
