<?php
session_start();
include '../db.php';

// Admin-only access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Fetch all complaints
$result = $conn->query("SELECT * FROM complaints");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Complaints - Admin</title>
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
            background: rgba(255, 255, 255, 0.95);
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
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            width: 95%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            word-break: break-word;
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #ffa751;
            color: white;
        }

        tr:hover {
            background-color: #fff5e6;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                padding-left: 50%;
                position: relative;
            }

            td::before {
                position: absolute;
                left: 15px;
                top: 14px;
                white-space: nowrap;
                font-weight: bold;
            }

            td:nth-child(1)::before { content: "ID"; }
            td:nth-child(2)::before { content: "Title"; }
            td:nth-child(3)::before { content: "Description"; }
            td:nth-child(4)::before { content: "Filed By"; }
            td:nth-child(5)::before { content: "Assigned To"; }
            td:nth-child(6)::before { content: "Status"; }
        }
    </style>
</head>
<body>

    <header>
        <h1>All Complaints</h1>
    </header>

    <nav>
        <a href="../dashboard/admin.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Filed By</th>
                <th>Assigned To</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['assigned_to']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
