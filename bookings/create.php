<?php
include '../config/database.php';
$students = $conn->query("SELECT * FROM student ORDER BY stuFName, stuLName");
$workstations = $conn->query("SELECT * FROM workstation ORDER BY wsLabRoom, wsPCNum");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Booking</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Add Booking</h1>
    <form action="store.php" method="POST">
        <label>Student</label>
        <select name="stuID" required>
            <option value="">-- Select Student --</option>
            <?php while ($s = $students->fetch_assoc()) : ?>
                <option value="<?= $s['stuID']; ?>"><?= htmlspecialchars($s['stuFName'] . ' ' . $s['stuLName']); ?></option>
            <?php endwhile; ?>
        </select>

        <label>Workstation</label>
        <select name="wsID" required>
            <option value="">-- Select Workstation --</option>
            <?php while ($w = $workstations->fetch_assoc()) : ?>
                <option value="<?= $w['wsID']; ?>"><?= htmlspecialchars($w['wsLabRoom'] . ' / ' . $w['wsPCNum']); ?></option>
            <?php endwhile; ?>
        </select>

        <label>Start</label>
        <input type="datetime-local" name="bookStart" required>

        <label>End</label>
        <input type="datetime-local" name="bookEnd" required>

        <label>Purpose</label>
        <textarea name="purpose" rows="3"></textarea>

        <button type="submit" class="btn btn-add">Save Booking</button>
    </form>
</div>
</body>
</html>