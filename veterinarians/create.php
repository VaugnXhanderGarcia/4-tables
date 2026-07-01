<?php
require_once '../config/auth.php';
requireLogin();
include '../config/database.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Veterinarian</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Add Veterinarian</h1>

    <form method="post" action="store.php">
        <label>First Name</label>
        <input type="text" name="vetFName" required>

        <label>Last Name</label>
        <input type="text" name="vetLName" required>

        <label>Address</label>
        <input type="text" name="vetAddress">

        <label>Specialization</label>
        <input type="text" name="vetSpecialization">

        <button type="submit" class="btn btn-add">Save</button>
    </form>

</div>
</body>
</html>
