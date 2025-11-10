<?php
session_start();
include '../db.php';

$res = $conn->query("SELECT * FROM complaints");

if (!$res) {
    die("Database query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Complaints</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            color: #0072ff;
        }

        nav {
            background: #fff;
            display: flex;
            justify-content: center;
            padding: 15px 0;
            gap: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        nav a {
            text-decoration: none;
            color: white;
            background: #0072ff;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        nav a:hover {
            background: #005dc1;
        }

        .container {
            padding: 40px;
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        th, td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0072ff;
            color: white;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<header>
    <h1>All Complaints</h1>
</header>

<nav>
    <a href="../dashboard/officer.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="container">
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $res->fetch_assoc()) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
