<?php
include '../db.php';
$res = $conn->query("SELECT * FROM complaints");
while($row = $res->fetch_assoc()) {
    echo "ID: " . $row['id'] . " | " . $row['title'] . " | " . $row['status'] . "<br>";
}
?>