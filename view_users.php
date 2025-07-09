<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>View Users - Car Central Hub</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }
        body, html {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('../images/rl.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #ddd;
            overflow-x: hidden;
        }
        .overlay {
            max-width: 1100px;
            margin: 40px auto;
            background-color: rgba(32, 21, 21, 0.8);
            border-radius: 15px;
            padding: 30px 25px;
            box-shadow: 0 0 25px rgba(0,0,0,0.9);
            min-height: 80vh;
            display: flex;
            flex-direction: column;
        }

        header.center-header {
            text-align: center;
            border-bottom: 3px solid #f0c419;
            padding-bottom: 20px;
            margin-bottom: 35px;
        }
        .center-logo {
            width: 90px;
            filter: drop-shadow(0 0 4px #f0c419);
        }
        .site-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #f0c419;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
        }

        h2.user-heading {
            text-align: center;
            font-size: 2rem;
            margin: 30px 0 20px;
            color: #fff176;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(240, 196, 25, 0.5);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 15px 10px;
            text-align: center;
            color: #fff;
        }

        th {
            background-color: #f0c419;
            color: #111;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        tr:hover {
            background-color: rgba(255, 241, 118, 0.2);
        }

        footer {
            text-align: center;
            padding: 15px;
            margin-top: 30px;
            font-size: 0.9rem;
            background-color: rgba(0,0,0,0.8);
            color: #bbb;
            border-top: 2px solid #f0c419;
            border-radius: 0 0 15px 15px;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <header class="center-header">
            <img src="../images/logo.png" alt="Car Logo" class="center-logo" />
            <h1 class="site-title">Car Central Hub</h1>
        </header>

        <h2 class="user-heading">Registered Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }
            ?>
        </table>

        <footer>
            <p>&copy; 2025 Car Rental System | All rights reserved | Designed by Noor</p>
        </footer>
    </div>
</body>
</html>

<?php $conn->close(); ?>
