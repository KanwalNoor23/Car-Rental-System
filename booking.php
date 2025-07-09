<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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

// Fetch car data
$sql = "SELECT * FROM cars WHERE status='available'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Book Your Car - Car Central Hub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('images/bg.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: -1;
    }

    .container {
      max-width: 1100px;
      margin: 40px auto;
      background-color: rgba(20, 20, 20, 0.9);
      border-radius: 12px;
      padding: 30px;
    }

    h2 {
      color: #f0c419;
      text-align: center;
      font-size: 2.5rem;
      margin-bottom: 30px;
    }

    .car-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
    }

    .car-box {
      background: rgba(255, 255, 255, 0.05);
      border: 2px solid #f0c419;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 0 10px #000;
    }

    .car-box h3 {
      font-size: 1.5rem;
      margin-bottom: 10px;
      color: #fff176;
    }

    .car-box p {
      font-size: 1rem;
      margin: 5px 0;
    }

    .book-btn {
      display: inline-block;
      margin-top: 15px;
      background-color: #f0c419;
      color: #000;
      padding: 10px 20px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: bold;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      padding: 10px;
      color: #bbb;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! Book Your Car Below</h2>

    <div class="car-list">
      <?php
      if ($result->num_rows > 0) {
          while ($car = $result->fetch_assoc()) {
              echo "<div class='car-box'>
                      <h3>{$car['model']}</h3>
                      <p>Make: {$car['make']}</p>
                      <p>Price per day: $" . number_format($car['price_per_day'], 2) . "</p>
                      <p>Status: {$car['status']}</p>
                      <a href='book_car.php?id={$car['id']}' class='book-btn'>Book Now</a>
                    </div>";
          }
      } else {
          echo "<p style='text-align:center;'>No cars available right now.</p>";
      }
      ?>
    </div>

    <footer>
      <p>&copy; 2025 Car Central Hub | Designed by Noor</p>
    </footer>
  </div>
</body>
</html>
