<?php
session_start();
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $user = $_SESSION['username'];
    $sql = "INSERT INTO complaints (title, description, username, status) VALUES ('$title', '$desc', '$user', 'Pending')";
    if ($conn->query($sql)) echo "Complaint Filed";
    else echo "Error: " . $conn->error;
}
?>
<form method="POST">
    Title: <input type="text" name="title"><br>
    Description: <textarea name="description"></textarea><br>
    <input type="submit" value="Submit Complaint">
</form>