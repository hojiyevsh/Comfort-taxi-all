<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $seats_available = $_POST['seats_available'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare('INSERT INTO rides (user_id, origin, destination, date, time, seats_available, price) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $origin, $destination, $date, $time, $seats_available, $price]);

    echo "Ride posted successfully";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Ride</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="origin" placeholder="Origin" required>
        <input type="text" name="destination" placeholder="Destination" required>
        <input type="date" name="date" required>
        <input type="time" name="time" required>
        <input type="number" name="seats_available" placeholder="Seats Available" required>
        <input type="text" name="price" placeholder="Price" required>
        <button type="submit">Post Ride</button>
    </form>
</body>
</html>
