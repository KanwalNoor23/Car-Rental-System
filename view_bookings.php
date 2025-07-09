<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "car_rental");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Bookings</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
     background: url('../images/rl.jpeg') no-repeat center center fixed;
      background-size: cover;
      padding: 40px;
      color: white;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(0, 0, 0, 0.7);
      color: white;
    }
    th, td {
      padding: 12px;
      text-align: center;
      border: 1px solid #ffd700;
    }
    th {
      background-color: #ffd700;
      color: black;
    }
    .btn {
      padding: 8px 15px;
      margin: 2px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }
    .edit { background-color: #1abc9c; color: white; }
    .delete { background-color: #e74c3c; color: white; }
  </style>
</head>
<body>
  <h1>All Bookings</h1>
  <table>
    <tr>
      <th>ID</th>
      <th>User ID</th>
      <th>Car ID</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id']; ?></td>
      <td><?= $row['id']; ?></td>
      <td><?= $row['car_id']; ?></td>
      <td><?= $row['start_date']; ?></td>
      <td><?= $row['end_date']; ?></td>
     
      <td>
        <a href="edit_booking.php?id=<?= $row['id']; ?>"><button class="btn edit">Edit</button></a>
        <a href="delete_booking.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure to delete?');"><button class="btn delete">Delete</button></a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
