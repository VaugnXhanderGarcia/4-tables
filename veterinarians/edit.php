<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php'); exit;
}

$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM veterinarian WHERE vetID = $id AND is_deleted = 0");
if (!$res || $res->num_rows === 0) {
    header('Location: index.php'); exit;
}
$vet = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Veterinarian</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Edit Veterinarian</h1>

    <form method="post" action="update.php">
        <input type="hidden" name="vetID" value="<?= $vet['vetID']; ?>">

        <label>First Name</label>
        <input type="text" name="vetFName" required value="<?= htmlspecialchars($vet['vetFName']); ?>">

        <label>Last Name</label>
        <input type="text" name="vetLName" required value="<?= htmlspecialchars($vet['vetLName']); ?>">

        <label>Address</label>
        <input type="text" name="vetAddress" value="<?= htmlspecialchars($vet['vetAddress']); ?>">

        <label>Specialization</label>
        <input type="text" name="vetSpecialization" value="<?= htmlspecialchars($vet['vetSpecialization']); ?>">

        <button type="submit" class="btn btn-edit">Update</button>
    </form>

</div>
</body>
</html>
