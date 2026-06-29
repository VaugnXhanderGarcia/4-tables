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
    <title>Edit Workstation</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Edit Workstation</h1>

    <form action="update.php" method="POST">

        <input type="hidden" name="wsID" value="<?= $workstation['wsID']; ?>">

        <input type="text"
               name="wsLabRoom"
               value="<?= htmlspecialchars($workstation['wsLabRoom']); ?>"
               required>

        <input type="text"
               name="wsPCNum"
               value="<?= htmlspecialchars($workstation['wsPCNum']); ?>"
               required>

        <input type="text"
               name="wsSoftware"
               value="<?= htmlspecialchars($workstation['wsSoftware']); ?>"
               required>

        <input type="text"
               name="wsStatus"
               value="<?= htmlspecialchars($workstation['wsStatus']); ?>"
               required>

         <input type="number"
             name="wsAge"
             value="<?= htmlspecialchars($workstation['wsAge']); ?>"
             min="0"
             required>

        <button type="submit" class="btn btn-edit">Update Workstation</button>

    </form>

</div>

</body>
</html>
