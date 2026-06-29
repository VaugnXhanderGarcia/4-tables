<!DOCTYPE html>
<html>
<head>
    <title>Add Workstation</title>
    <link rel="stylesheet" href="../assets/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php include '../includes/nav.php'; ?>

<div class="container">

    <h1>Add Workstation</h1>

    <form action="store.php" method="POST">

        <input type="text" name="wsLabRoom" placeholder="Lab Room" required>

        <input type="text" name="wsPCNum" placeholder="PC Number" required>

        <input type="text" name="wsSoftware" placeholder="Software" required>

        <input type="text" name="wsStatus" placeholder="Status" required>

        <input type="number" name="wsAge" placeholder="Age (years)" min="0" required>

        <button type="submit" class="btn btn-add">Save Workstation</button>

    </form>

</div>

</body>
</html>
