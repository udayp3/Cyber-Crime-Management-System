<?php
session_start();
include '../db.php';
$user = $_SESSION['username'];

echo "<header><h1>Officer Dashboard</h1></header>";
echo "<nav>
<a href='../complaints/view_complaints.php'>View All Complaints</a>
<a href='../logout.php'>Logout</a>
</nav><div class='container'>";

$res = $conn->query("SELECT * FROM complaints WHERE assigned_to='$user'");
echo "<h2>Assigned Complaints</h2><table><tr><th>ID</th><th>Title</th><th>Description</th><th>Status</th></tr>";
while ($row = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['title']}</td>
        <td>{$row['description']}</td>
        <td>{$row['status']}</td>
    </tr>";
}
echo "</table></div>";
?>
<link rel='stylesheet' href='../assets/style.css'>
