
<?php
require_once 'config/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Veterinary Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <div class="dashboard-header">
        <h1>Welcome to the Veterinary Management System</h1>
        <a href="logout.php" class="btn btn-delete">Logout</a>
    </div>
    <p>Select a module to manage:</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Veterinarians</h3>
            <p>Manage veterinarian records.</p>
            <a href="veterinarians/index.php" class="btn btn-view">Manage Veterinarians</a>
        </div>

        <div class="home-card">
            <h3>Pet Owners</h3>
            <p>Manage pet owner records.</p>
            <a href="petowners/index.php" class="btn btn-add">Manage Pet Owners</a>
        </div>

        <div class="home-card">
            <h3>Pets</h3>
            <p>Manage pet records.</p>
            <a href="pets/index.php" class="btn btn-edit">Manage Pets</a>
        </div>

        <div class="home-card">
            <h3>Consultations</h3>
            <p>Manage consultation transactions.</p>
            <a href="consultations/index.php" class="btn btn-edit">Manage Consultations</a>
        </div>

        <div class="home-card">
            <h3>Inquiries</h3>
            <p>Run consultation inquiries and aggregates.</p>
            <a href="inquiries/vets_by_specialization.php" class="btn btn-view">Run Inquiries</a>
        </div>
    </div>
</div>

</body>
</html>