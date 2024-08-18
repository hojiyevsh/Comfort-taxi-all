<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $origin = $_GET['origin'];
    $destination = $_GET['destination'];

    $stmt = $pdo->prepare('SELECT * FROM rides WHERE origin = ? AND destination = ? ORDER BY date, time');
    $stmt->execute([$origin, $destination]);
    $rides = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search for a Ride</title>
</head>
<body>
    <form method="GET">
        <input type="text" name="origin" placeholder="Origin" required>
        <input type="text" name="destination" placeholder="Destination" required>
        <button type="submit" name="search">Search Ride</button>
    </form>
    
    <?php if (!empty($rides)): ?>
        <h2>Available Rides</h2>
        <ul>
            <?php foreach ($rides as $ride): ?>
                <li>
                    <a href="ride_details.php?id=<?= $ride['id'] ?>">
                        <?= $ride['origin'] ?> to <?= $ride['destination'] ?> on <?= $ride['date'] ?> at <?= $ride['time'] ?> - <?= $ride['seats_available'] ?> seats available
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
