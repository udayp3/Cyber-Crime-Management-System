<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = md5($_POST['password']);
    $role = $_POST['role'];
    $q = "SELECT * FROM users WHERE username='$u' AND password='$p' AND role='$role'";
    $res = $conn->query($q);
    if ($res->num_rows == 1) {
        $_SESSION['username'] = $u;
        $_SESSION['role'] = $role;
        header("Location: dashboard/{$role}.php");
    } else {
        echo "Invalid credentials.";
    }
}
?>
<h2>Login Form</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role:
    <select name="role">
        <option value="admin">Admin</option>
        <option value="officer">Officer</option>
        <option value="user">User</option>
    </select><br>
    <input type="submit" value="Login">
</form>
<p>Don't have an account? <a href="register.php">Register here</a></p>