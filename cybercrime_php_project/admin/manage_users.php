<?php
session_start();
include '../db.php';

// Admin access control
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Handle deletion
$success = "";
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    $success = "User deleted successfully.";
}

// Fetch all users
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Admin</title>
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
            width: 80%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 14px 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #ffa751;
            color: white;
        }

        tr:hover {
            background-color: #fff5e6;
        }

        .success {
            background-color: #e0ffe0;
            color: #007700;
            padding: 10px 20px;
            border: 1px solid #00a000;
            border-radius: 6px;
            margin-bottom: 20px;
            width: 80%;
            text-align: center;
        }

        .delete-link {
            color: #d8000c;
            text-decoration: none;
            font-weight: bold;
        }

        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <header>
        <h1>Manage Users</h1>
    </header>

    <nav>
        <a href="../dashboard/admin.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="container">
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><a class="delete-link" href="manage_users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>
</html>
