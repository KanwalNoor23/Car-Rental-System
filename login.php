<?php
session_start();
include 'db_connect.php'; // Connect to DB

$email = $_POST['email'];
$password = $_POST['password'];

// Validate user
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if ($password === $user['password']) { // Plain-text check (update later to hashed)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // ✅ Redirect to booking page
        header("Location: ../pages/booking.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Incorrect password.";
        header("Location: ../pages/login.php");
        exit();
    }
} else {
    $_SESSION['login_error'] = "User not found.";
    header("Location: ../pages/login.php");
    exit();
}
?>
s