<?php
session_start();
include '../db.php';
$user = $_SESSION['username'];
$res = $conn->query("SELECT * FROM complaints WHERE username='$user'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        h2 {
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 20px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #0072ff;
            color: white;
        }

        tr:hover {
            background: #f2f2f2;
        }

        @media (max-width: 768px) {
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
                margin-bottom: 15px;
                border-bottom: 2px solid #ccc;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>User Dashboard</h1>
    </header>

    <nav>
        <a href="../complaints/file_complaint.php">File Complaint</a>
        <a href="../complaints/view_complaints.php">View My Complaints</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="container">
        <h2>My Complaints</h2>
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
