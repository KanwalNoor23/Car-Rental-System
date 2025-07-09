<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = $_POST['username'];
    $admin_pass = $_POST['password'];

    if ($admin_user === "noor" && $admin_pass === "your_code123") {
        $_SESSION['admin'] = $admin_user;
        header("Location: ../pages/admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect Admin Credentials'); window.location.href='../index.php';</script>";
    }
}
?>
