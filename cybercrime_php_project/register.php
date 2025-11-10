<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = md5($_POST['password']);
    $role = $_POST['role'];

    // Check if user already exists
    $check = $conn->query("SELECT * FROM users WHERE username='$u'");
    if ($check->num_rows > 0) {
        $error = "Username already taken.";
    } else {
        $sql = "INSERT INTO users (username, password, role) VALUES ('$u', '$p', '$role')";
        if ($conn->query($sql)) {
            $success = "Registered successfully. <a href='login.php'>Login Now</a>";
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
    <title>Register - CyberCrime Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ffe259, #ffa751);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 320px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
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

        a {
            color: #ff7b00;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            background-color: #ffe0e0;
            color: #d8000c;
            padding: 10px;
            border: 1px solid #d8000c;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #e0ffe0;
            color: #007700;
            padding: 10px;
            border: 1px solid #00a000;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Signup Form</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="user">User</option>
                <option value="officer">Officer</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
