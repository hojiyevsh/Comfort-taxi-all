<?php
require 'db.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT rides.*, users.name, users.email FROM rides JOIN users ON rides.user_id = users.id WHERE rides.id = ?');
    $stmt->execute([$_GET['id']]);
    $ride = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ride Details</title>
</head>
<body>
    <?php if ($ride): ?>
        <h1>Ride from <?= $ride['origin'] ?> to <?= $ride['destination'] ?></h1>
        <p>Date: <?= $ride['date'] ?></p>
        <p>Time: <?= $ride['time'] ?></p>
        <p>Seats Available: <?= $ride['seats_available'] ?></p>
        <p>Price: <?= $ride['price'] ?></p>
        <p>Driver: <?= $ride['name'] ?> (<?= $ride['email'] ?>)</p>
    <?php else: ?>
        <p>Ride not found.</p>
    <?php endif; ?>
</body>
</html>
