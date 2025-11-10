<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = md5($_POST['password']);
    $role = $_POST['role'];

    // Check if user already exists
    $check = $conn->query("SELECT * FROM users WHERE username='$u'");
    if ($check->num_rows > 0) {
        echo "Username already taken.";
    } else {
        $sql = "INSERT INTO users (username, password, role) VALUES ('$u', '$p', '$role')";
        if ($conn->query($sql)) {
            echo "Registered successfully. <a href='login.php'>Login Now</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
<h2>Signup Form</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role:
    <select name="role">
        <option value="user">User</option>
        <option value="officer">Officer</option>
        <option value="admin">admin</option>
    </select><br>
    <input type="submit" value="Register">
</form>
<p>Already have an account? <a href="login.php">Login here</a></p>