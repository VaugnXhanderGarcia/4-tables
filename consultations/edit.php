<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM consultation WHERE consultID = $id AND is_deleted = 0");
if (!$res || $res->num_rows === 0) { header('Location: index.php'); exit; }
$c = $res->fetch_assoc();
$pets = $conn->query("SELECT * FROM pet WHERE is_deleted = 0 ORDER BY petName ASC");
$vets = $conn->query("SELECT * FROM veterinarian WHERE is_deleted = 0 ORDER BY vetLName ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Consultation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Edit Consultation</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="consultID" value="<?= $c['consultID']; ?>">
        <label>Pet</label>
        <select name="petID" required>
            <?php while($p = $pets->fetch_assoc()): ?><option value="<?= $p['petID']; ?>" <?= $p['petID']==$c['petID']? 'selected':''; ?>><?= htmlspecialchars($p['petName']); ?></option><?php endwhile; ?>
        </select>
        <label>Veterinarian</label>
        <select name="vetID" required>
            <?php while($v = $vets->fetch_assoc()): ?><option value="<?= $v['vetID']; ?>" <?= $v['vetID']==$c['vetID']? 'selected':''; ?>><?= htmlspecialchars($v['vetFName'].' '.$v['vetLName']); ?></option><?php endwhile; ?>
        </select>
        <label>Date/Time</label>
        <input type="datetime-local" name="consultDate" value="<?= date('Y-m-d\TH:i', strtotime($c['consultDate'])); ?>" required>
        <label>Diagnoses</label>
        <textarea name="diagnoses"><?= htmlspecialchars($c['diagnoses']); ?></textarea>
        <label>Prescription</label>
        <textarea name="prescription"><?= htmlspecialchars($c['prescription']); ?></textarea>
        <button type="submit" class="btn btn-edit">Update</button>
    </form>
</div>
</body>
</html>
