
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            background: url('../images/bg.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dashboard-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            color: white;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            max-width: 500px;
            width: 90%;
        }
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #ffd700;
        }
        nav {
            margin: 20px 0;
        }
        nav a {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            background-color: rgba(255, 215, 0, 0.9);
            color: #000;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        nav a:hover {
            background-color: #e0c200;
            transform: scale(1.05);
        }
        p {
            margin-top: 15px;
            font-size: 16px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .dashboard-container {
                padding: 25px;
            }
            h1 {
                font-size: 24px;
            }
            nav a {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, Admin</h1>
        <nav>
            <a href="add_cars.php">Add Car</a>
            <a href="view_cars.php">View Cars</a>
              <a href="view_users.php">View Users</a>          
          <a href="view_bookings.php">View Bookings</a> 
            <a href="logout.php">Logout</a>
        </nav>
        <p>Use the navigation links above to manage your car rental system.</p>
    </div>
    <a href="#" onclick="confirmLogout()">Logout</a>

<script>
function confirmLogout() {
    const confirmAction = confirm("Are you sure you want to logout?\nAll changes will be saved.");
    if (confirmAction) {
        window.location.href = "logout.php";
    }
}
</script>
</body>
</html>
