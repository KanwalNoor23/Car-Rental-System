<?php
// File: php/add_car.php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data safely
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = $_POST['model'];
    $make = $_POST['make'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO cars (model, make, price_per_day, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $model, $make, $price, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Car successfully added!'); window.location.href = '../pages/add_car.php';</script>";
    } else {
        echo "<script>alert('Error: Could not add car.'); window.location.href = '../pages/add_car.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
