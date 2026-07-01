<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Pet Owner</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Add Pet Owner</h1>
    <form method="post" action="store.php">
        <label>First Name</label>
        <input type="text" name="petOwnerFName" required>
        <label>Last Name</label>
        <input type="text" name="petOwnerLName" required>
        <label>Birth Date</label>
        <input type="date" name="petOwnerBDate">
        <label>Telephone</label>
        <input type="text" name="petOwnerTelNo">
        <button type="submit" class="btn btn-add">Save</button>
    </form>
</div>
</body>
</html>
