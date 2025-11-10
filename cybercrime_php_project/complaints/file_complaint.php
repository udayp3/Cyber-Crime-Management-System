<?php
session_start();
include '../db.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $user = $_SESSION['username'];
    $sql = "INSERT INTO complaints (title, description, username, status) VALUES ('$title', '$desc', '$user', 'Pending')";
    if ($conn->query($sql)) {
        $message = "<p class='success'>Complaint filed successfully.</p>";
    } else {
        $message = "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Complaint</title>
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

        form {
            background: white;
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        form textarea {
            resize: vertical;
            height: 100px;
        }

        form input[type="submit"] {
            background: #0072ff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background: #005dc1;
        }

        .success {
            color: green;
            text-align: center;
            font-weight: bold;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <header>
        <h1>File a Complaint</h1>
    </header>

    <nav>
        <a href="../dashboard/user.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="container">
        <?php echo $message; ?>
        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>

            <input type="submit" value="Submit Complaint">
        </form>
    </div>

</body>
</html>
