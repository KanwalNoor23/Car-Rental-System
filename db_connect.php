<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";  // use your actual database name here

$conn = new mysqli($servername, $username, $password, $dbname);
$conn = new mysqli("localhost", "root", "", "car_rental");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
