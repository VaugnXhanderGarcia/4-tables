<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

$pets = $conn->query("SELECT * FROM pet WHERE is_deleted = 0 ORDER BY petName ASC");
$vets = $conn->query("SELECT * FROM veterinarian WHERE is_deleted = 0 ORDER BY vetLName ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Consultation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Add Consultation</h1>
    <form method="post" action="store.php">
        <label>Pet</label>
        <select name="petID" required>
            <option value="">-- Select Pet --</option>
            <?php while($p = $pets->fetch_assoc()): ?><option value="<?= $p['petID']; ?>"><?= htmlspecialchars($p['petName']); ?></option><?php endwhile; ?>
        </select>
        <label>Veterinarian</label>
        <select name="vetID" required>
            <option value="">-- Select Vet --</option>
            <?php while($v = $vets->fetch_assoc()): ?><option value="<?= $v['vetID']; ?>"><?= htmlspecialchars($v['vetFName'] . ' ' . $v['vetLName']); ?></option><?php endwhile; ?>
        </select>
        <label>Date/Time</label>
        <input type="datetime-local" name="consultDate" required>
        <label>Diagnoses</label>
        <textarea name="diagnoses"></textarea>
        <label>Prescription</label>
        <textarea name="prescription"></textarea>
        <button type="submit" class="btn btn-add">Save</button>
    </form>
</div>
</body>
</html>
