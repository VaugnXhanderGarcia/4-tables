
<?php
require_once 'config/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <h1>Welcome to the Student Management System</h1>
    <p>Select a module to manage:</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Students</h3>
            <p>Store and manage student information.</p>
            <a href="students/index.php" class="btn btn-view">Add Students</a>
        </div>

        <div class="home-card">
            <h3>Workstations</h3>
            <p>Manage workstation information and availability.</p>
            <a href="workstations/index.php" class="btn btn-add">Manage Workstations</a>
        </div>

        <div class="home-card">
            <h3>Bookings</h3>
            <p>Manage booking records and details.</p>
            <a href="bookings/index.php" class="btn btn-edit">Manage Bookings</a>
        </div>
    </div>
</div>

</body>
</html>