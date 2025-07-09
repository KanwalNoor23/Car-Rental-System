<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = $conn->real_escape_string($_POST['model']);
    $make = $conn->real_escape_string($_POST['make']);
    $price = floatval($_POST['price']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "INSERT INTO cars (model, make, price_per_day, status) VALUES ('$model', '$make', $price, '$status')";
    if ($conn->query($sql) === TRUE) {
        $message = "Car successfully added!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Car</title>
    <style>
        /* same styling as your form, or simpler for now */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            width: 400px;
        }
        input, select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            font-size: 16px;
        }
        button {
            background-color: #ffd700;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e0c200;
        }
        .message {
            margin-top: 10px;
            color: #90ee90; /* light green */
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Add a New Car</h2>
    <form method="POST" action="">
        <input type="text" name="model" placeholder="Car Model" required />
        <input type="text" name="make" placeholder="Car Make" required />
        <input type="number" step="0.01" name="price" placeholder="Price per Day" required />
        <select name="status" required>
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select>
        <button type="submit">Add Car</button>
    </form>
    <?php if ($message): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>
</div>
</body>
</html>
