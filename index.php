<?php
session_start();
require 'db.php';

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']);

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
    <title>Comfort Taxi</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header>
        <h1>Welcome to Comfort taxi</h1>
        <nav>
            <ul>
                <?php if ($is_logged_in): ?>
                    <li><a href="post_ride.php">Post a Ride</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Search for a Ride</h2>
            <form method="GET" action="index.php">
                <input type="text" name="origin" placeholder="Origin" required>
                <input type="text" name="destination" placeholder="Destination" required>
                <button type="submit" name="search">Search</button>
            </form>

            <?php if (isset($rides) && count($rides) > 0): ?>
                <h3>Available Rides</h3>
                <ul>
                    <?php foreach ($rides as $ride): ?>
                        <li>
                            <a href="ride_details.php?id=<?= $ride['id'] ?>">
                                <?= $ride['origin'] ?> to <?= $ride['destination'] ?> on <?= $ride['date'] ?> at <?= $ride['time'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif (isset($rides)): ?>
                <p>No rides found.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Comfort taxi.</p>
    </footer>

</body>

<script src="assets/js/script.js"></script>
</html>
