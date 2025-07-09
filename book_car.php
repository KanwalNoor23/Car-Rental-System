<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user'])) {
    die("Please login to book a car.");
}

$user_email = $_SESSION['user'];
$sql = "SELECT id FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$user_id = $user['id'];

$car_id = $_POST['car_id'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$sql = "INSERT INTO bookings (user_id, car_id, start_date, end_date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $user_id, $car_id, $start_date, $end_date);
$stmt->execute();

$conn->query("UPDATE cars SET status='booked' WHERE id=$car_id");

echo "Booking successful. <a href='../pages/view_cars.php'>Go back</a>";
?>
