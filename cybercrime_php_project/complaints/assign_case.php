<?php
session_start();
include '../db.php';

// Admin-only access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cid = (int) $_POST['complaint_id'];
    $oid = trim($_POST['officer_id']);

    // Check officer exists
    $check = $conn->query("SELECT * FROM users WHERE username='$oid' AND role='officer'");
    if ($check->num_rows == 0) {
        $error = "Officer not found or not valid.";
    } else {
        $sql = "UPDATE complaints SET assigned_to='$oid', status='Assigned' WHERE id=$cid";
        if ($conn->query($sql)) {
            $success = "Complaint ID $cid assigned to Officer '$oid' successfully.";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Complaint - Admin</title>
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
            justify-content: center;
            align-items: center;
        }

        .form-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ffa751;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ff7b00;
        }

        .success, .error {
            text-align: center;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #e0ffe0;
            color: #007700;
            border: 1px solid #00a000;
        }

        .error {
            background-color: #ffe0e0;
            color: #d8000c;
            border: 1px solid #d8000c;
        }
    </style>
</head>
<body>

    <header>
        <h1>Assign Complaint</h1>
    </header>

    <nav>
        <a href="../dashboard/admin.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="container">
        <div class="form-card">
            <h2>Assign to Officer</h2>

            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php elseif ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <label>Complaint ID:</label>
                <input type="number" name="complaint_id" required>

                <label>Officer Username:</label>
                <input type="text" name="officer_id" required>

                <input type="submit" value="Assign">
            </form>
        </div>
    </div>

</body>
</html>
