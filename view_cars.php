<?php
// Start session if you need login checks later
session_start();

// Database connection details
$servername = "localhost";
$username = "root";     // change if needed
$password = "";         // change if needed
$dbname = "car_rental"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all cars
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>View Cars - Car Central Hub</title>
  <link rel="stylesheet" href="../css/style.css" />
  <style>
    .cars-container {
      display: flex;
      flex-wrap: wrap;
      gap: 25px;
      justify-content: center;
      padding: 30px;
    }
    .car-card {
      background: rgba(247, 226, 0, 0.1);
      border: 2px solid #f7e300;
      border-radius: 15px;
      width: 280px;
      padding: 15px;
      color: #222;
      box-shadow: 0 0 12px #f7e300aa;
      text-align: center;
      transition: transform 0.3s ease;
    }
    .car-card:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px #f7e300ff;
    }
    .car-image {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
    }
    .car-model {
      font-size: 1.5em;
      font-weight: 700;
      margin-bottom: 8px;
      color: #f7e300;
    }
    .car-make, .car-price, .car-status {
      font-size: 1.1em;
      margin-bottom: 6px;
    }
    .car-status.available {
      color: green;
      font-weight: bold;
    }
    .car-status.unavailable {
      color: red;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <header>
      <h1 style="color:#f7e300; text-align:center; padding: 20px;">Available Cars</h1>
    </header>

    <main class="cars-container">
      <?php
      if ($result->num_rows > 0) {
          while ($car = $result->fetch_assoc()) {
              $statusClass = strtolower($car['status']) === 'available' ? 'available' : 'unavailable';
              echo "<div class='car-card'>
                      <img src='../images/{$car['image']}' alt='{$car['model']}' class='car-image' />
                      <div class='car-model'>{$car['model']}</div>
                      <div class='car-make'>Make: {$car['make']}</div>
                      <div class='car-price'>Price per day: $" . number_format($car['price_per_day'], 2) . "</div>
                      <div class='car-status {$statusClass}'>Status: {$car['status']}</div>
                    </div>";
          }
      } else {
          echo "<p style='color: #f7e300;'>No cars available at the moment.</p>";
      }
      $conn->close();
      ?>
    </main>

    <footer>
      <p style="color:#aaa; text-align:center;">&copy; 2025 Car Central Hub | Designed by Noor</p>
    </footer>
  </div>
</body>
</html>
