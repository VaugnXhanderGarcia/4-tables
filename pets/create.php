<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$owners = $conn->query("SELECT * FROM pet_owner WHERE is_deleted = 0 ORDER BY petOwnerLName ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Pet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Add Pet</h1>
    <form method="post" action="store.php">
        <label>Owner</label>
        <select name="petOwnerID" required>
            <option value="">-- Select Owner --</option>
            <?php while($o = $owners->fetch_assoc()): ?>
                <option value="<?= $o['petOwnerID']; ?>"><?= htmlspecialchars($o['petOwnerFName'] . ' ' . $o['petOwnerLName']); ?></option>
            <?php endwhile; ?>
        </select>
        <label>Pet Name</label>
        <input type="text" name="petName" required>
        <label>Type</label>
        <input type="text" name="petType">
        <label>Breed</label>
        <input type="text" name="petBreed">
        <label>Birth Date</label>
        <input type="date" name="petBDate">
        <button type="submit" class="btn btn-add">Save</button>
    </form>
</div>
</body>
</html>
