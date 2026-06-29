<!DOCTYPE html>
<html>
<head>
    <title>Add Studnet</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Add Student</h1>

    <form action="store.php" method="POST">

        <input type="text" name="stuFName" placeholder="Student First Name" required>

        <input type="text" name="stuLName" placeholder="Student Last Name" required>

        <input type="text" name="stuCourse" placeholder="Course" required>

        <input type="text" name="stuSpecialization" placeholder="Specialization (optional)">

        <input type="number" name="stuYear" placeholder="Year Level" required>

        <button type="submit" class="btn btn-add">Save Student</button>

    </form>

</div>

</body>
</html>