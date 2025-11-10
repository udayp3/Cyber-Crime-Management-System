<?php
session_start();
include '../db.php';

// Protect page for officers only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'officer') {
    header('Location: ../login.php');
    exit();
}

$user = $_SESSION['username'];

$res = $conn->query("SELECT * FROM complaints WHERE assigned_to='$user'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Officer Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            color: #003366;
        }

        nav {
            background: #ffffff;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        nav a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            background: #0072ff;
            color: white;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        nav a:hover {
            background: #005bd8;
        }

        .container {
            flex: 1;
            padding: 40px;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        th, td {
            padding: 14px 20px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #0072ff;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            th, td {
                padding: 10px;
                text-align: right;
                position: relative;
            }

            th::before, td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                color: #333;
            }

            tr {
                margin-bottom: 20px;
                border-bottom: 2px solid #ccc;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Officer Dashboard</h1>
    </header>

    <nav>
        <a href="../complaints/view_complaints.php">View All Complaints</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="container">
        <h2>Complaints Assigned to You</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $res->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
