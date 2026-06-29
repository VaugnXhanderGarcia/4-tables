<?php
include '../config/database.php';
if (!isset($_GET['id'])) die("Booking ID missing.");
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM booking WHERE bookID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$bk = $res->fetch_assoc();
if (!$bk) die("Booking not found.");
$students = $conn->query("SELECT * FROM student ORDER BY stuFName, stuLName");
$workstations = $conn->query("SELECT * FROM workstation ORDER BY wsLabRoom, wsPCNum");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Booking</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include '../includes/nav.php'; ?>
<div class="container">
    <h1>Edit Booking</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="bookID" value="<?= $bk['bookID']; ?>">

        <label>Student</label>
        <select name="stuID" required>
            <option value="">-- Select Student --</option>
            <?php while ($s = $students->fetch_assoc()) : ?>
                <option value="<?= $s['stuID']; ?>" <?= $s['stuID'] == $bk['stuID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['stuFName'] . ' ' . $s['stuLName']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Workstation</label>
        <select name="wsID" required>
            <option value="">-- Select Workstation --</option>
            <?php while ($w = $workstations->fetch_assoc()) : ?>
                <option value="<?= $w['wsID']; ?>" <?= $w['wsID'] == $bk['wsID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($w['wsLabRoom'] . ' / ' . $w['wsPCNum']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Start</label>
        <input type="datetime-local" name="bookStart" value="<?= date('Y-m-d\TH:i', strtotime($bk['bookStart'])); ?>" required>

        <label>End</label>
        <input type="datetime-local" name="bookEnd" value="<?= date('Y-m-d\TH:i', strtotime($bk['bookEnd'])); ?>" required>

        <label>Purpose</label>
        <textarea name="purpose" rows="3"><?= htmlspecialchars($bk['purpose']); ?></textarea>

        <button type="submit" class="btn btn-edit">Update Booking</button>
    </form>
</div>
</body>
</html>