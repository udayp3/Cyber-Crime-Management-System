<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - CyberCrime Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ffe259, #ffa751);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        header h1 {
            margin: 0;
            color: #333;
        }

        nav {
            background: #fff;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 15px 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        nav a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            background: #ffa751;
            color: white;
            font-weight: 500;
            transition: background 0.3s ease;
        }
        nav a:hover {
            background: #ff7b00;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .container .card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        .card p {
            font-size: 18px;
            color: #333;
            margin: 0;
        }
    </style>
</head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <nav>
        <a href="../admin/manage_users.php">Manage Users</a>
        <a href="../admin/view_all_complaints.php">View All Complaints</a>
        <a href="../complaints/assign_case.php">Assign Complaints</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="container">
        <div class="card">
            <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
        </div>
    </div>

</body>
</html>
